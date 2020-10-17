<?php
  namespace App\services;

  use App\Models\Registration;
  use App\Models\Family;
  use App\Http\Resources\UserResource;
  use Carbon\Carbon;

  class RegistrationService {

    protected $registrants;
    protected $family;

    public function __construct(Registration $registrants, Family $family) {
      $this->registrants = $registrants;
      $this->family = $family;
    }

    public function store($request) {
      $check = $this->registrants->where('email', $request->email)->count();
      if($check >= 1) {
        return response()->json([
          'status' => false, 
          'message' => 'Seems you have an existing account. Check and try again'
        ], 200);
      }

      $save = $this->registrants->create([
        "name" => $request->name,
        'email' => $request->email,
        'dob' => $request->dob,
        'age' => $request->age,
        'passport' => $this->passportUpload($request)
      ]);
        
      
      if($save) {
        foreach ($request->relatives as $family_member) {
          $this->family->create([
            'user_id' => $save->id,
            'name' => $family_member['relatives_name'],
            'relationship' => $family_member['relationship'],
            'age' => $family_member['relatives_age']
          ]);
        }
        return response()->json([
          'status' => true, 
          'message' => 'Data submitted successfully', 
          'data' => new UserResource($save) 
        ], 201);
      }

      return response()->json([
        'status' => false, 
        'message' => 'Could not submit your data, try again'
      ], 200);
    }

    public function show($id) {
      $data = $this->registrants->find($id);
      if($data) {
        return response()->json([
          'status' => true,
          'data' => new UserResource($data)
        ]);
      }

      return response()->json([
        'status' => false,
        'message' => "Not found"
      ]);
    }

    public function update($request, $id) {
      $user = $this->registrants->find($id);
      $user->update($request->all());

      if($user) {
        return response()->json([
          'status' => true,
          'data' => new UserResource($user)
        ]);
      }

      return response()->json([
        'status' => false,
        'message' => "Could not update record"
      ]);
    }

    public function delete($id) {
      $user = $this->registrants->find($id);
      if($user) {
        $user->family_members()->delete();
        $user->delete();
        return response()->json([
          'status' => true,
          'data' => new UserResource($user)
        ]);
      }

      return response()->json([
        'status' => false,
        'message' => "Could not delete record"
      ]);

    }

    public function passportUpload($request) {
      if($file = $request->file('passport')) {
          $fileName = time().time().'.'.$request->file->getClientOriginalExtension();
          $target_dir = public_path('/imgs');

          if($file->move($target_dir, $fileName)) {
              $fileNameToStore = $fileName;
          } else {
              $fileNameToStore = "no-image.jpg";
          }
          return $fileNameToStore;
      }
    }
    
  }
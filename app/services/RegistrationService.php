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
      //return $request->all();
      $check = $this->registrants->where('email', $request->email)->count();
      if($check >= 1) {
        return response()->json([
          'status' => false, 
          'message' => 'Seems you have an existing account. Check and try again'
        ], 422);
      }

      $save = $this->registrants->create([
        "name" => $request->name,
        'email' => $request->email,
        'dob' => $request->dob,
        'age' => $request->age,
        'passport' => $this->passportUpload($request->passport)
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
      ], 422);
    }

    public function show($id) {
      return $this->registrants->find($id);
    }

    public function update($request) {
      $user = $this->registrants->find($request->id);
      $user->update($request->all());
      if($user) {
        return true;
      }
      return false;
    }

    public function delete($id) {
      $user = $this->registrants->find($id);
      if($user) {
        $user->delete();
        return true;
      }
      return false;

    }

    public function passportUpload($image) {
      return 'no-image.jpg';
    }
  }
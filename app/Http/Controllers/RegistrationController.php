<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegistrationService;

class RegistrationController extends Controller
{
    protected $regservice;

    public function __construct(RegistrationService $regservice) {
        $this->regservice = $regservice;
    }

    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
            'name' => 'string|required',
            'age' =>  'required|integer|between:18,65',
            'dob' => 'required|date',
            'email' => 'required|email',
            'passport' => 'sometimes|image|mimes:jpeg,JPG,png,gif|max:1024',
            'relatives' => 'required|array',
            'relationship' => 'in_array|relatives|requiured|string',
            'relatives_age' => 'in_array|relatives|requiured|integer',
            'relatives_name' => 'in_array|relatives|requiured|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'error',
                'error' => $validator->errors()
            ], 200);
        }
        return $this->regservice->store($request);
    }

    public function show($id) {
        return $this->regservice->show($id);
    }

    public function update(Request $request, $id) {
        return $this->regservice->update($request, $id);
    }

    public function delete($id) {
       return $this->regservice->delete($id);
    }
}

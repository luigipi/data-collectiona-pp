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
        return $this->regservice->store($request);
    }

    public function index() {
        $page_status = null; 
        return view('index')->withPageStatus($page_status);
    }

    public function show($id) {
        return $this->regservice->show($id);
    }

    public function create($id) {
        $user = $this->regservice->show($id);
        return view('admin.edit')->withUser($user);
    }

    public function edit(Request $request, $id) {
     $update = $this->regservice->update($request, $id);
     if($update) {
        return back()->withMessage('Update successful');
     }

     return back()->withErrors("Could not update details");
    }

    public function delete($id) {
        $status = $this->regservice->delete($id);
        if($status) {
            return back()->withMessage("Record deleted");
        }

        return back()->withErrors("Could not delete record");
    }


}

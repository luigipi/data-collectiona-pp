<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iborseminar;

class CustomController extends Controller
{
    public function index() {
        $addReg = new Iborseminar;
        
        return dd($addReg->codeGenerator());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
  // return view('home', ['data' => $data_view]);
  
    //
    public function index(){
      return view('dashboard', []);

    }
}

<?php

namespace Gecx\Http\Controllers;

use Illuminate\Http\Request;
use Gecx\Http\Requests;

class HomeController extends Controller{

    public function index(){
      return view('home');
    }
}

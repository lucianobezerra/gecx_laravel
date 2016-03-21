<?php

namespace Gecx\Http\Controllers;

use Illuminate\Http\Request;
use Gecx\Http\Requests;

class SystemController extends Controller{

    public function index(){
      return view('system');
    }
}

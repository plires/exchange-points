<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterPendingController extends Controller
{

  public function userPendingVerification() {

    return view('register-pending');

  }
  
}

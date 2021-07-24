<?php

namespace App\Http\Controllers\App;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\EditUserRequest;

class UserController extends Controller
{
  
  public function update(EditUserRequest $request, User $user)
    {

      $user = $user->fill( $request->validated() );

      if ($user->password == null) {
      	unset($user->password); 
      } else {
      	$user->password = Hash::make( $request->validated()['password'] );
      }

      $user->save();

      return response()->json( ['user_created' => $user], 201);
          
  }

}

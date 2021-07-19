<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;
    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('login');
    }

    public function authenticated($request, $user) {
        $role = $user->role->name; 

        if ($user->confirmed) { // Si el usuario esta aprobado por el administrador
            
            switch ($role) {
              case 'Administrador':
                 return redirect('/admin/users');
                 break;
              case 'Usuario':
                 return redirect('/');
                 break; 

              default:
                 return redirect('/'); 
                 break;
            }

        }
        
        $this->performLogout($request); // Provocamos el logout
        return redirect()->route('login', ['user_confirmed' => false]); //Redirigimos con la variable

    }

}

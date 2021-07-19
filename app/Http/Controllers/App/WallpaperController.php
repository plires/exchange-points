<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WallpaperController extends Controller
{

	public function __construct()
  {
    $this->middleware('auth');
  }
  
  public function wallpapers()
  {
    $current = 'catalogo_background';
    return view('app.wallpapers')->with('current', $current);
  }

}

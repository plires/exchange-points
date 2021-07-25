<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

	public function downloadWallpaper($file)
	{

		$file = Storage::disk('public')->path('wallpapers/' . $file . '.jpg');
		$headers = ['Content-Type: image/jpeg'];
		$newName = 'wallpaper-monster-'.time().'.jpg';

		return response()->download($file, $newName, $headers);
		
	}	

}

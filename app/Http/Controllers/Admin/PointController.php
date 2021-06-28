<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Point;
use App\PointAssigned;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class PointController extends Controller
{

    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.points');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
        dd($request);
        try {

            $data = $request->validate([
                'id'                    => 'required|integer',
                'user_id'               => 'required|integer',
                'points'                => 'required|integer',
                'pointsToOperation'     => 'required|integer'
            ]);

            DB::transaction(function () use($data, $point) {

                $point = $point->fill( $data ); // llenamos la fila con los datos validados

                $point->points = $point->points + (int)$point->pointsToOperation; // actualizamos la posicion "points" con los puntos enviados

                unset($point->pointsToOperation); // Elimino la posicion pointsToOperation para actualizar la fila

                $savedPoints = $point->update();

                if ($savedPoints) {

                    PointAssigned::create([
                        'user_id'   => $data['user_id'],
                        'quantity'  => $data['pointsToOperation'],
                        'author'    => Auth::user()->name,
                    ]);

                }

            });

            return response()->json( ['points_created' => $point], 201);
            
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json( ['server_out' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        //
    }

    public function getPoints()
    {   
        $users = User::where('role_id', 2)->with('points')->get();
        return $users;
    }

    public function showExportTemplate()
    {
        return view('admin.export-template');
    }

    public function showImportTemplate()
    {
        return view('admin.import-template');
    }

    public function exportTemplate()
    {

        $points = Point::all();
        $users = User::all();

        dd($users[0]->points);
        dd($points[0]->user);


        foreach ($users as $user) {
            dd($user->role); // VER PORQUE NO LO DEVUELVE
            # code...
        }


        $users = User::where('role_id', '=', 1)->get(); // Lograr una coleccion con la relacion de puntos incluidas para exportar en excell

        return (new UsersExport($users))->download('ussser.xlsx');

        // return Excel::download(new UsersExport, 'users.xlsx');

    }

    public function importTemplate(Request $request)
    {

        $data = $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ( $request->hasFile('file-template') ) {
            
            // Guardar imagen
            $file = $request->file('file-template')->store('files', 'public');

            // Importar Excel
            Excel::import(new UsersImport, $file);

            // Eliminar Excel
            Storage::delete($file);

            return response()->json( ['file-template' => $file], 201);
            
        }

    }

}

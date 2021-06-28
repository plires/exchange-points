<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\PointAssigned;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller
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
        return view('admin.users');
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
    public function store(CreateUserRequest $request)
    {

        try {

            $user = new User( $request->validated() );

            $user->password = Hash::make( $request->validated()['password'] );

            $user->save();

            return response()->json( ['user_created' => $user], 201);
            
        } catch (Exception $e) {
            return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserRequest $request, User $user)
    {

        if ( isset($request->validated()['points_old']) || isset($request->validated()['points_old']) != 0 ) { // Si viene de la vista "puntos"

            $data = $request->validated();

            DB::transaction(function () use($data, $user) {

                $user = $user->fill( $data );

                $user->points = $user->points + (int)$user->points_old; // actualizamos la posicion "points" con los puntos enviados

                $user->points < 0 ? $user->points = 0 : $user->points;

                unset($user->points_old); // Elimino la posicion points_old para actualizar la fila

                $userUpdated = $user->update();

                if ($userUpdated) {

                    PointAssigned::create([
                        'user_id'   => $data['id'],
                        'quantity'  => $data['points'],
                        'author'    => Auth::user()->name,
                    ]);

                }

            });
            
            return response()->json( ['user_points_updated' => $user], 201);



        } else { // si viene de la vista de usuarios

            $user = $user->fill( $request->validated() );

            $user->password = Hash::make( $request->validated()['password'] );

            $user->save();

            return response()->json( ['user_created' => $user], 201);

        }
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        try {
            $user->delete(); 
            return response()->json( ['user_deleted' => $user], 201);
        }

        catch (Exception $e) {
            return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
        }
        
    }

    public function getUsers()
    {   
        return User::where('id', '!=', Auth::user()->id)->get();
    }

    public function getUserAuth()
    {
        return Auth::user();
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

        $users = User::select( 'id', 'name', 'email', 'points')
            ->whereRole_id(2)
            ->get();

        return (new UsersExport($users))->download('user.xlsx');
        
    }

    public function importTemplate(Request $request)
    {

        $file = $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ( $file == [] ) {
            return response()->json( ['error_import' => 'Falta subir la plantilla'], 404);
        }

        $file =$request->file('file-template');
        
        // Importar Excel a una coleccion
        $rows = (new UsersImport)->toCollection($file);

        foreach ($rows[0] as $row) { // Recorrer el excel subido
            
            DB::transaction(function () use($row) { //Si falla alguna ejecucion de la base de datos se retrotrae al punto original
                $user = User::findOrFail($row[0]); // Cargamos el usuario con cada id del excel

                $user->points = $user->points + (int)$row[3]; // actualizamos la posicion "points" sumando los puntos del excel
                $userUpdated = $user->update();

                if ($userUpdated) {

                    PointAssigned::create([
                        'user_id'   => $user['id'],
                        'quantity'  => $row[3],
                        'author'    => Auth::user()->name,
                    ]);

                }

            });

        }

        return response()->json( ['file-template' => $file], 201);
            

    }

    
}

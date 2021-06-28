<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\PointAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PointAssignedController extends Controller
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
        return view('admin.points-assigned');
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
     * @param  \App\PointAssigned  $pointAssigned
     * @return \Illuminate\Http\Response
     */
    public function show(PointAssigned $pointAssigned)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PointAssigned  $pointAssigned
     * @return \Illuminate\Http\Response
     */
    public function edit(PointAssigned $pointAssigned)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PointAssigned  $pointAssigned
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PointAssigned $pointAssigned)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PointAssigned  $pointAssigned
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $pointAssigned = PointAssigned::findOrFail($id);

        $user = User::findOrFail($pointAssigned->user_id);

        if ($user->points < $pointAssigned->quantity) {
            $user->points = 0;
        } else {
            $user->points = $user->points - $pointAssigned->quantity;
        }

        try {

            DB::transaction(function () use($pointAssigned, $user) {
                
                // Eliminar la operacion de puntos asignados
                $pointsDeleted = $pointAssigned->delete();

                // Editar los puntos del usuario
                $user->update();

            });

            return response()->json( ['points_deleted' => $pointAssigned], 201);
            
        } catch (Exception $e) {
            return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
        }

    }

    public function getPointsAssigned() 
    {
        return PointAssigned::all();
    }
}

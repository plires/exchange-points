<?php

namespace App\Http\Controllers\Admin;

use App\ExchangeDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExchangeDetailController extends Controller
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
        //
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
     * @param  \App\ExchangeDetail  $exchangeDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ExchangeDetail $exchangeDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExchangeDetail  $exchangeDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ExchangeDetail $exchangeDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExchangeDetail  $exchangeDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExchangeDetail $exchangeDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExchangeDetail  $exchangeDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExchangeDetail $exchangeDetail)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use App\Events\ProductSaved;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
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
    return view('admin.products');
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
  public function store(CreateProductRequest $request)
  {

    try {

      $product = new Product( $request->validated() );

      if ( $request->hasFile('image') ) {

        // Guardar imagen
        $product->image = $request->file('image')->store('images', 'public');

        // Optimizar imagen
        ProductSaved::dispatch($product);
      }

      $product->save();

      return response()->json( ['product_created' => $product], 201);

    } catch (Exception $e) {
      return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
    }

  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(CreateProductRequest $request, Product $product)
  {

    try {

      if ( $request->hasFile('image') ) {

        Storage::delete($product->image);

        $product = $product->fill( $request->validated() );

        $product->image = $request->file('image')->store('images', 'public');

        $product->save();

        // Optimizar imagen
        ProductSaved::dispatch($product);

      } else {
        $product->update( $request->validated() );
      }         


      return response()->json( ['product_created' => $product], 201);

    } catch (Exception $e) {
      return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
    }

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product)
  {

    try {
      $product->delete(); 

      return response()->json( ['product_deleted' => $product], 201);
    }

    catch (Exception $e) {
      return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
    }

  }

  public function getProducts()
  {   
    return Product::get();
  }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
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
        return view('admin.categories');
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
    public function store(CreateCategoryRequest $request)
    {
        
        try {

            $category = new Category( $request->validated() );

            $category->save();

            return response()->json( ['category_created' => $category], 201);
            
        } catch (Exception $e) {
            return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, Category $category)
    {
        try {
            
            $category = $category->fill( $request->validated() );

            $category->update();
            
            return response()->json( ['category_created' => $category], 201);

        } catch (Exception $e) {

            return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);

        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        if ($category->name == "Sin Categoría") {
            return response()->json( ['other_errors' => 'Esta categoría no se puede eliminar'], 403);
        }

        $uncategorized = Category::findOrFail(1); // La categoria 1 siempre debe ser "Sin Categoria"

        $products_id = $category->products->pluck('id');

        if ($products_id->isEmpty()) {
            
            $category->delete(); 
            return response()->json( ['category_deleted' => $category], 201);

        } else {

            try {

                DB::transaction(function () use($products_id, $uncategorized, $category) {

                    Product::whereIn('id', $products_id)
                    ->update([
                        'category_id' => $uncategorized->id,
                    ]);

                    $category->delete();

                });

                return response()->json( ['category_deleted' => $category], 201);
                
            } catch (Exception $e) {
                return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
            }

        }

    }

    public function getCategories()
    {
        return Category::get();
    }
}

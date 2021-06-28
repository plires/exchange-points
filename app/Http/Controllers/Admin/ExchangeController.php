<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Product;
use App\Exchange;
use App\ExchangeDetail;
use Illuminate\Http\Request;
use App\Mail\NewExchangeManual;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ExchangeController extends Controller
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
        return view('admin.points-exchanged');
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

        $errors = [];

        $userValidated = request()->validate([ // Usuario Validado
            'user_id'  => 'required|numeric',
            'total'    => 'required|numeric',
        ]);

        $user_id    = $userValidated['user_id']; // Sacamos estas dos posiciones del request
        $total      = $userValidated['total'];

        $rules = [
            "products.*.id"           => "required|integer|numeric",
            "products.*.name"         => "required|string",
            "products.*.quantity"     => "required|integer|numeric",
            "products.*.price"        => "required|integer|numeric",
        ];

        if (!isset($request->products)) { // Verificamos que vengan productos
            $errors['products_empty'] = 'No hay productos cargados';
            return response()->json( ['errors' => $errors], 500);
        }

        foreach ($request->products as $key => $product) {
            $data['products'][$key] = json_decode($product, true); // Convertimos el string de Json de cada producto en array
        }

        $validator = Validator::make($data, $rules); // validamos productos

        if (!$validator->passes()) {
            $errors['products_not_valid'] = 'Error al validar productos...';
            return response()->json( ['errors' => $errors], 500);
        }

        $productsValidates = $validator->valid(); // Productos validados

        $totalPointsExchange = 0;

        // Grabar el EXCHANGE con el user_id y el total
        $exchange                   = new Exchange();
        $exchange->user_id          = $user_id;
        $exchange->points_quantity  = $total;

        // Grabar el EXCHANGE_DETAIL con el exchange_id, los product_id, los quantitys y el price (se podria grabar en un foreach de los productos)
        foreach ($productsValidates['products'] as $key => $product) {

            $exchangeDetail[$key]                 = new ExchangeDetail();
            $exchangeDetail[$key]->product_id     = $product['id'];
            $exchangeDetail[$key]->quantity       = $product['quantity'];
            $exchangeDetail[$key]->price          = $product['price'];
                                    
            // actualizar el stock en cada producto
            $productToUpdate[$key]                 = Product::findOrFail($product['id']);
            
            // Si el precio del Producto que viene del front es igual al de la BDD
            if ($productToUpdate[$key]->price == $product['price']) { 
                $totalPointsExchange += $product['quantity'] * $product['price'];
            } else {
                $errors['products_not_valid'] = 'Error al cargar productos...';
                return response()->json( ['errors' => $errors], 500);
            }

            // Si no hay suficiente stock
            if ($productToUpdate[$key]->availability < $product['quantity']) { 
                $errors['points_product_not_equals'] = 'El producto ' . $product['name'] . ' no tiene suficiente stock';
                return response()->json( ['errors' => $errors], 500);
            } else {
                $productToUpdate[$key]->availability  -= $product['quantity'];
            }

        }

        // Restarle los puntos totales a este usuario (verificar previamente si tiene os puntos suficientes para este canje)
        if ($totalPointsExchange != 0) {
            
            $pointsUserToUpdate = User::findOrFail($user_id);

            if ($totalPointsExchange < $pointsUserToUpdate->points) {
                $pointsUserToUpdate->points  -= $totalPointsExchange;
                
            } else {
                $errors['products_not_valid'] = 'El usuario ' . $pointsUserToUpdate->name . ' no tiene la cantidad de puntos suficientes.';
                return response()->json( ['errors' => $errors], 500);
            }

        }

        try {

            DB::transaction(function () use($exchange, $exchangeDetail, $productToUpdate, $pointsUserToUpdate) { 
                $exchange->save();

                foreach ($exchangeDetail as $key => $exchangeDetailValue) {
                    $exchangeDetailValue->exchange_id    = $exchange->id;
                    $exchangeDetailValue->save();
                }

                foreach ($productToUpdate as $key => $productToUpdateValue) {
                    $productToUpdateValue->update();
                }

                $pointsUserToUpdate->update();

            });

            // Enviar email
            $to_name = 'Carlos Castro';
            $to_email = 'carlos.castro.1975.2@gmail.com';
            
            $data = array(
                'name'      => $pointsUserToUpdate->name, 
                'points'    => $pointsUserToUpdate->points, 
            );

            Mail::send('emails.new-exchange-manual', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Laravel Test Mail');
            $message->from('pepe@algo.com','Test Mail');
            });

            // Mail::to('pablo@librecomunicacion.net')->queue(new NewExchangeManual($pointsUserToUpdate));

            return response()->json( ['exchanged_created' => 'Canje de puntos realizado exitosamente para el usuario: ' . $pointsUserToUpdate->name], 201);  

        } catch (Exception $e) {

            $errors['server'] = 'Error en el servidor... intente mas tarde';
            return response()->json( ['errors' => $errors], 500);  

        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function show(Exchange $exchange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function edit(Exchange $exchange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exchange $exchange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $exchange = Exchange::findOrFail($id);

        try {

            DB::transaction(function () use($exchange) {
                
                // Editar los puntos del usuario
                $user = User::findOrFail($exchange->user_id);
                $user->points = $user->points + $exchange->points_quantity;
                $user->update();

                // subir el stock de cada producto
                $exchange_details = $exchange->exchangeDetails;

                foreach ($exchange_details as $key => $exchange_detail) {
                    $product = Product::findOrFail($exchange_detail->product_id); 
                    $product->availability = $product->availability + $exchange_detail->quantity;
                    $product->update();
                }
                                        
                // Eliminar la operacion de canje de puntos
                $exchange->delete();

            });

            return response()->json( ['exchanged_deleted' => $exchange], 201);
            
        } catch (Exception $e) {
            return response()->json( ['other_errors' => 'Servidor momentaneamente inaccesible. Intente mas tarde por favor.'], 500);
        }

    }

    public function getPointsExchanged() 
    {
        return Exchange::all();
    }

}

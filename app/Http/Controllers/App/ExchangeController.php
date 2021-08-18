<?php

namespace App\Http\Controllers\App;

use App\User;
use App\Product;
use App\Exchange;
use App\ExchangeDetail;
use App\Mail\MessageToUser;
use Illuminate\Http\Request;
use App\Mail\MessageToClient;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Loader\Configurator\env;

class ExchangeController extends Controller
{

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

      $user_id    = $userValidated['user_id'];
      $total      = $userValidated['total'];

      if ($user_id != Auth::user()->id) {
    		$errors['user_not_valid'] = 'Hubo un problema al cargar los datos del usuario. Actualice la página e intente nuevamente';
        return response()->json( ['errors' => $errors], 500);
    	}

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
          $productToUpdate[$key]                = Product::findOrFail($product['id']);

          // Si el precio del Producto que viene del front es igual al de la BDD
          if ($productToUpdate[$key]->price == $product['price']) { 
              $totalPointsExchange += $product['quantity'] * $product['price'];
          } else {
              $errors['products_not_valid'] = 'Error al cargar productos. Elimine los productos del carrito, actualice la página e intente nuevamente';
              return response()->json( ['errors' => $errors], 500);
          }

          // Si no hay suficiente stock
          if ($productToUpdate[$key]->availability < $product['quantity']) { 
              $errors['points_product_not_equals'] = 'El producto ' . $product['name'] . ' tiene disponibles sólo ' . $productToUpdate[$key]->availability . ' unidades' ;
              return response()->json( ['errors' => $errors], 500);
          } else {
              $productToUpdate[$key]->availability  -= $product['quantity'];
          }

      }

      // Si el total que viene del front no coincide con la sumatoria de puntos de productos canjeados
      if ($totalPointsExchange != $exchange->points_quantity) { 
      	$errors['total_not_valid'] = 'Error al calcular los totales de productos, actualice la página e intente nuevamente';
          return response()->json( ['errors' => $errors], 500);
      }

      // Restarle los puntos totales a este usuario (verificar previamente si tiene los puntos suficientes para este canje)
      if ($totalPointsExchange != 0) {
          
          $pointsUserToUpdate = User::findOrFail($user_id);

          if ($totalPointsExchange < $pointsUserToUpdate->points) {
              $pointsUserToUpdate->points  -= $totalPointsExchange;
          } else {
              $errors['products_not_valid'] = 'El usuario ' . $pointsUserToUpdate->name . ' no tiene la cantidad de puntos suficientes.';
              return response()->json( ['errors' => $errors], 500);
          }

      }

      foreach ($exchangeDetail as $key => $detail) {
        $product = Product::findOrFail($detail['product_id']);
        $productTemplateEmail[$key]['name']       = $product->name;
        $productTemplateEmail[$key]['quantity']   = $detail->quantity;
        $productTemplateEmail[$key]['price']      = number_format($detail->price,0, ',', '.');
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

          Mail::to(env('MAIL_FROM_ADDRESS'))->queue(new MessageToClient($exchange, $pointsUserToUpdate, $productTemplateEmail));
          Mail::to($pointsUserToUpdate->email)->queue(new MessageToUser($exchange, $pointsUserToUpdate, $productTemplateEmail));

          return response()->json( ['exchanged_created' => 'Felicitaciones '. $pointsUserToUpdate->name .', el canje se realizó exitosamente, recibirás detalles de la operación a tu casilla de email. No olvides revisar la bandeja de SPAM ;) '], 201);  

      } catch (Exception $e) {

          $errors['server'] = 'Error en el servidor... intente mas tarde';
          return response()->json( ['errors' => $errors], 500);  

      }
     
  }
    
}

<?php

namespace App;

use App\Product;
use App\Exchange;
use Illuminate\Database\Eloquent\Model;

class ExchangeDetail extends Model
{

	use \Illuminate\Database\Eloquent\SoftDeletes;
  use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

	//ExchangeDetail->Exchange
  public function exchange(){
    return $this->belongsTo(Exchange::class);
  }

  //ExchangeDetail->Product
  public function product(){
    return $this->belongsTo(Product::class);
  }

}

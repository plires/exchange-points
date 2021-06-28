<?php

namespace App;

use App\Image;
use App\Category;
use App\ProductImage;
use App\ExchangeDetail;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  use \Illuminate\Database\Eloquent\SoftDeletes;
  use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

  protected $guarded = [];
  // protected $softCascade = ['images'];
  
  //Product->category
  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  //Product->images
  // public function images(){
  //   return $this->hasMany(ProductImage::class);
  // }

  //Product->ExchangeDetail
  public function exchangeDetails(){
    return $this->hasMany(ExchangeDetail::class);
  }

}

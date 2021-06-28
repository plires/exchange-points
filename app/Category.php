<?php

namespace App;

use App\Product;
use App\CategoryImage;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	use \Illuminate\Database\Eloquent\SoftDeletes;
  use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

  protected $guarded = [];
  
  //Category->products
  public function products(){
    return $this->hasMany(Product::class);
  }

}

<?php

namespace App;

use App\User;
use App\ExchangeDetail;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{

	use \Illuminate\Database\Eloquent\SoftDeletes;
  use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

  protected $guarded = [];
  protected $softCascade = ['exchangeDetails'];

	//Exchange->user
  public function user(){
    return $this->belongsTo(User::class);
  }

  //Exchange->ExchangeDetail
  public function exchangeDetails(){
    return $this->hasMany(ExchangeDetail::class);
  }

}

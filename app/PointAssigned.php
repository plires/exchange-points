<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PointAssigned extends Model
{

	use \Illuminate\Database\Eloquent\SoftDeletes;
  use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

  protected $guarded = [];

	//PointsAssigned->user
  public function user(){
      return $this->belongsTo(User::class);
  }

}

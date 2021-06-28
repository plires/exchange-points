<?php

namespace App;

use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	use \Illuminate\Database\Eloquent\SoftDeletes;
  use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

	//Role->users
  public function users(){
    return $this->hasMany(User::class);
  }

}

<?php

namespace App;

use App\Role;
use App\Point;
use App\Exchange;
use App\PointAssigned;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $guarded = [];
    protected $softCascade = ['exchanges', 'pointsAssigned'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //User->Role
    public function role(){
        return $this->belongsTo(Role::class);
    }

    //User->exchange
    public function exchanges(){
        return $this->hasMany(Exchange::class);
    }

    //User->pointsAssigned
    public function pointsAssigned(){
        return $this->hasMany(PointAssigned::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
}

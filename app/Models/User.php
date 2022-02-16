<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = "users";
    protected $guarded = [];

    protected $hidden = [
        'id',
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'json',
    ];

    public function orders() {
        return $this->hasMany('App\Models\Order', 'user_id', 'id');
    }
}

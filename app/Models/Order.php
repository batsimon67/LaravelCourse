<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'orders';
    protected $guarded = [];

    public function users() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function products() {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}

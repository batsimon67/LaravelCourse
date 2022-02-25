<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $guarded = [];

    public function orders() {
        return $this->belongsTo('App\Models\Order', 'id', 'product_id');
    }

    public function seller() {
        return $this->belongsTo('App\Models\Seller', 'seller_id', 'id');
    }
}

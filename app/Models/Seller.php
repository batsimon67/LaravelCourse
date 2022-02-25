<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sellers';
    protected $guarded = array();

    public function products() {
        return $this->hasMany('App\Models\Product', 'seller_id', 'id');
    }
}

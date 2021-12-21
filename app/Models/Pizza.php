<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pizza extends Model
{
    use SoftDeletes;

    protected $dates = ["created_at", "updated_at", "deleted_at"];
    protected $table = "pizza";
    protected $guarded = [];
}

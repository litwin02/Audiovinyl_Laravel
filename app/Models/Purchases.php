<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    // use HasFactory;
    protected $table = 'purchases';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id',
        'city',
        'post_code',
        'address',
        'total_price',
        'created_at',
        'updated_at'
    ];
}

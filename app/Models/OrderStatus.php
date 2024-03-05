<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    // use HasFactory;
    protected $table = 'order_status';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'purchase_id',
        'status'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases_Details extends Model
{
    // use HasFactory;
    protected $table = 'purchases_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'purchase_id',
        'vinyl_id',
        'quantity',
    ];
}

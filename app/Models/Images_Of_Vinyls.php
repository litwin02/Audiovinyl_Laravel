<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images_Of_Vinyls extends Model
{
    // use HasFactory;
    protected $table = 'images_of_vinyls';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'vinyl_id',
        'path',
    ];
}

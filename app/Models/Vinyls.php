<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinyls extends Model
{
    // use HasFactory;
    protected $table = 'vinyls';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'artist_id',
        'genre_id',
        'quantity',
        'price',
    ];

    public function artist()
    {
        return $this->belongsTo(Artists::class, 'artist_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genres::class, 'genre_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Genre extends Model
{
    use HasFactory;
    protected $table = 'genres';
    protected $guared = [];
    public $timestamps = false;
    // public function movie(){
    //     return $this->belongsTo(Movie::class);
    // }
}

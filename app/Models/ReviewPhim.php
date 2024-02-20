<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewPhim extends Model
{
    use HasFactory;
    protected $table ='review_phims';
    protected $guarded =[];
}

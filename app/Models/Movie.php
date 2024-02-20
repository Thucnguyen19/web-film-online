<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie_Genre;


class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';
    protected $guarded = [];
    public $timestamps = true;
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');

    }
    // public function genre(){
    //     return $this->belongsTo(Genre::class,'genre_id');
    // }
    public function genres(){
        return $this->belongsToMany(related: Genre::class, table: 'movie_genres', foreignPivotKey: 'movie_id', relatedPivotKey: 'genre_id')->withTimestamps(); //(Model, table name, primary key, foreign key)
    }
    public function episode(){
        return $this->hasMany(Episode::class);
    }
}
// phương thức belongsToMany(), tham số thứ hai và thứ ba là tên của các cột khóa ngoại trên bảng trung gian. Tham số thứ hai nên là tên của cột khóa ngoại của model hiện tại (Movie), và tham số thứ ba nên là tên của cột khóa ngoại của model bạn muốn kết nối (Movie_Genre).


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie_Genre;

use Illuminate\Support\Str;
// use Carbon\Carbon;
use File;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category','country','genres')->withCount('episode')->get();
        $path  =public_path()."/json/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        File::put($path.'movies.json',json_encode($list));
        //Nếu chưa tồn tại file có $path thì sẽ tạo folder theo đường dẫn của path và tạo một file json
        return view('movie.index',compact('list'));
    }

    public function update_year(Request $request){
        $data=$request->all();
        $movie=Movie::find($data['id_phim']);
        $movie->year_movie =$data['year_movie'];
        // dd($movie);
        $movie->save();

    }
    public function update_season(Request $request){
        $data=$request->all();
        $movie=Movie::find($data['id_phim']);
        $movie->season =$data['season'];
        // dd($movie);
        $movie->save();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $category = Category::pluck('title','id');//pluck(key,value)=> key= title, value =id
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list_genre =Genre::orderBy('id','DESC')->get();
        return view('movie.form',compact('category','genre','country','list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie -> title = $data['title'];
        $movie -> title_en = $data['title_en'];
        $movie -> description = $data['description'];
        $movie -> status = $data['status'];
        $movie -> tag_movie = $data['tag_movie'];
        $movie -> all_episode = $data['all_episode'];
        $movie -> category_id = $data['category_id'];
        foreach($data['genre'] as $key => $value){
            $movie->genre_id=$value[0];
        }
        $movie -> country_id = $data['country_id'];
        $movie -> phim_hot = $data['phim_hot'];
        $movie -> quality = $data['quality'];
        $movie -> phu_de = $data['phu_de'];
        $movie -> time_movie = $data['time_movie'];
        $movie->slug = Str::slug($data['title']);
        $movie -> trailer = $data['trailer'];
        $movie -> director = $data['director'];
        $movie -> actor = $data['actor'];
        $movie->view = 0;
        //Add Image
        $get_image = $request->file('image');
        $path ='uploads/movie/';
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $movie->image = $new_image;
        }
        
        // $data['slug'] = Str::slug($data['title']);
        // $movie =Movie::create($data);
        $movie ->save($data);//phương thức này dùng cho câu lệnh insert, into nên các trường created_at và updated_at sẽ ko tự động thêm dữ liệu
        $movie->genres()->attach($data['genre']);
        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = Category::pluck('title','id');//pluck(key,value)=> key= title, value =id
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list_genre =Genre::orderBy('id','DESC')->get();
        $movie = Movie::find($id);
        $movie_genre = $movie->genres;
        return view('movie.form',compact('category','genre','country','movie','list_genre','movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //Add Image
        // try {
            $data = $request->all();
            // dd($data);
            $movie =  Movie::find($id);
            $movie -> title = $data['title'];
            $movie -> title_en = $data['title_en'];
            $movie -> description = $data['description'];
            $movie -> status = $data['status'];
            $movie -> tag_movie = $data['tag_movie'];
            $movie -> category_id = $data['category_id'];
            $movie -> country_id = $data['country_id'];
            $movie -> phim_hot = $data['phim_hot'];
            $movie -> quality = $data['quality'];
            $movie -> phu_de = $data['phu_de'];
            $movie -> all_episode = $data['all_episode'];
            $movie -> time_movie = $data['time_movie'];
            $movie->slug = Str::slug($data['title']);
            $movie -> trailer = $data['trailer'];
            $movie -> director = $data['director'];
            $movie -> actor = $data['actor'];
          // Xử lý tải lên hình ảnh
    $get_image = $request->file('image');
    $path ='uploads/movie/';
    if($get_image){
        if(!empty($movie->image) && file_exists('uploads/movie/'.$movie->image)){
            unlink('uploads/movie/'.$movie->image);
        }
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $data['image'] = $new_image;  // Sử dụng tên hình ảnh mới
    }
            $movie->increment('view');
        // dd($movie);
            // Cập nhật dữ liệu
            foreach($data['genre'] as $value){
                $movie->genre_id = $value[0];
            }
            $movie->genres()->sync($data['genre']);
            unset($data['genre']);
           
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
        
        $movie->update($data);
        return redirect()->route('movie.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete image
        $movie = Movie::find($id);
        if(!empty($movie->image) && file_exists('uploads/movie/'.$movie->image)){
            unlink('uploads/movie/'.$movie->image);
        }
        Movie_Genre::whereIn('movie_id',[$movie->id])->delete();//delete genres
        Episode::whereIn('movie_id',[$movie->id])->delete();//delete genres
        $movie->delete();
        return redirect()->back();
    }
//     Phương thức sync() sẽ nhận mảng này làm đầu vào, sau đó nó sẽ thực hiện hai bước:
// Xóa các mục trong bảng trung gian mà không tồn tại trong mảng đầu vào.
// Thêm các mục mới từ mảng đầu vào vào bảng trung gian.
// Vì vậy, sau khi thực hiện câu lệnh này, bảng trung gian sẽ chứa chính xác các ID thể loại phim (genre) mà bạn đã cung cấp trong mảng $data['genre'], và tất cả các ID thể loại phim khác liên quan đến phim (movie) hiện tại sẽ bị xóa.
}

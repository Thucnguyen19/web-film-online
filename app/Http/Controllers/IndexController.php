<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\ReviewPhim;
use App\Models\Rating;
use App\Models\Movie_Genre;
use DB;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{
    private $day;
private $week;
private $month;
private $year;
private $now;


function __construct(){
    $this->now = Carbon::now();
    $this->day = $this->now->day;
    $this->week = $this->now->weekOfYear;
    $this->month = $this->now->month;
    $this->year = $this->now->year;
}
    public function index(Request $request){
      $url_canonical = $request->url();
        $category = Category::orderBy('id','ASC')->get();
        $reviewphim=ReviewPhim::where('status',1)->paginate(24);
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::with('category','country','genres')->where('category_id',$cate_slug->id)->paginate(24);
        $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
        $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
          // Lấy bộ phim được truy cập nhiều nhất trong ngày
          $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
          ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tuần
      $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
      ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tháng
      $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
      $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
         return view('pages.result_search', compact('url_canonical','reviewphim','category','country','genre','cate_slug','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
    }

    public function home(Request $request){
      $url_canonical = $request->url();
        $highlight_movie =Movie::latest()->where('phim_hot',1)->get();
        $category = Category::orderBy('id','ASC')->get();
        $reviewphim=ReviewPhim::where('status',1)->paginate(24);
        $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
        $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
        $category_home = Category::with('movie')->orderBy('id','ASC')->where('status',1)->get();
        // dd($highlight_movie);
       $genre = Genre::orderBy('id','DESC')->get();
       $country = Country::orderBy('id','DESC')->get();

        // Lấy bộ phim được truy cập nhiều nhất trong ngày
        $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
            ->orderBy('view', 'desc')->take(4)->get();
        // Lấy bộ phim được truy cập nhiều nhất trong tuần
        $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
        ->orderBy('view', 'desc')->take(4)->get();
        // Lấy bộ phim được truy cập nhiều nhất trong tháng
        $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
        $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();

        return view('pages.home', compact('url_canonical','reviewphim','category','country','genre','category_home','highlight_movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
    }
    public function category($slug,Request $request){
      $url_canonical = $request->url();
        $category = Category::orderBy('id','ASC')->get();
        $reviewphim=ReviewPhim::where('status',1)->paginate(24);
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cate_slug->id)->paginate(24);
        $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
        $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
          // Lấy bộ phim được truy cập nhiều nhất trong ngày
          $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
          ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tuần
      $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
      ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tháng
      $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
      $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
         return view('pages.category', compact('url_canonical','reviewphim','category','country','genre','cate_slug','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
    }
    public function year($year,Request $request){
      $url_canonical = $request->url();
       $category = Category::orderBy('id','ASC')->get();
       $reviewphim=ReviewPhim::where('status',1)->paginate(24);
       $genre = Genre::orderBy('id','DESC')->get();
       $country = Country::orderBy('id','DESC')->get();
       $year =$year; 
       $movie = Movie::where('year_movie',$year)->paginate(24);
       $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
       $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
         // Lấy bộ phim được truy cập nhiều nhất trong ngày
         $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
         ->orderBy('view', 'desc')->take(4)->get();
     // Lấy bộ phim được truy cập nhiều nhất trong tuần
     $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
     ->orderBy('view', 'desc')->take(4)->get();
     // Lấy bộ phim được truy cập nhiều nhất trong tháng
     $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
     $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
        return view('pages.year', compact('url_canonical','reviewphim','category','country','genre','year','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
    }
    public function tag($tag, Request $request){
      $url_canonical = $request->url();
        $category = Category::orderBy('id','ASC')->get();
        $reviewphim=ReviewPhim::where('status',1)->paginate(24);
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $tag =$tag; 
        $movies =Movie::all();
        foreach($movies as $value){
            $title= $value->title ;
            $movie = Movie::where('tag_movie','like','%'.$tag.'%')->orWhere('title','like','%'.$tag)->paginate(24);

        }
        $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
        $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
          // Lấy bộ phim được truy cập nhiều nhất trong ngày
          $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
          ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tuần
      $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
      ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tháng
      $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
      $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
         return view('pages.tag', compact('url_canonical','reviewphim','category','country','genre','tag','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
     }
     public function director($director, Request $request){
      $url_canonical = $request->url();
      $category = Category::orderBy('id','ASC')->get();
      $reviewphim=ReviewPhim::where('status',1)->paginate(24);
      $genre = Genre::orderBy('id','DESC')->get();
      $country = Country::orderBy('id','DESC')->get();
      $director =$director; 
      $movies =Movie::all();
     
      foreach($movies as $value){
          $title= $value->title ;
          $movie = Movie::where('director','like','%'.$director.'%')->orWhere('title','like','%'.$director)->paginate(24);

      }
      $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
      $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
        // Lấy bộ phim được truy cập nhiều nhất trong ngày
        $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
        ->orderBy('view', 'desc')->take(4)->get();
    // Lấy bộ phim được truy cập nhiều nhất trong tuần
    $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
    ->orderBy('view', 'desc')->take(4)->get();
    // Lấy bộ phim được truy cập nhiều nhất trong tháng
    $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
    $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
       return view('pages.director', compact('url_canonical','reviewphim','category','country','genre','director','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
   }
   public function actor($actor, Request $request){
    $url_canonical = $request->url();
    $category = Category::orderBy('id','ASC')->get();
    $reviewphim=ReviewPhim::where('status',1)->paginate(24);
    $genre = Genre::orderBy('id','DESC')->get();
    $country = Country::orderBy('id','DESC')->get();
    $actor =$actor; 
    $movies =Movie::all();
    foreach($movies as $value){
        $title= $value->title ;
        $movie = Movie::where('actor','like','%'.$actor.'%')->orWhere('title','like','%'.$actor)->paginate(24);

    }
    $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
    $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong ngày
      $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
      ->orderBy('view', 'desc')->take(4)->get();
  // Lấy bộ phim được truy cập nhiều nhất trong tuần
  $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
  ->orderBy('view', 'desc')->take(4)->get();
  // Lấy bộ phim được truy cập nhiều nhất trong tháng
  $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
  $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
     return view('pages.actor', compact('url_canonical','reviewphim','category','country','genre','actor','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
 }

    public function genre($slug,Request $request){
      $url_canonical = $request->url();
       $category = Category::orderBy('id','ASC')->get();
       $reviewphim=ReviewPhim::where('status',1)->paginate(24);
       $genre = Genre::orderBy('id','DESC')->get();
       $country = Country::orderBy('id','DESC')->get();
       $genre_slug = Genre::where('slug',$slug)->first();
       //phim chua nhieu the loai 
       $movie_genre =Movie_Genre::where('genre_id',$genre_slug->id)->get();
      //khoi tạo mảng dểd lưu trữ 
       $many_genres= array();
     
       foreach( $movie_genre as $genValue){
        $many_genres[]= $genValue->movie_id;
       };
       $movie = Movie::whereIn('id',$many_genres)->latest()->paginate(24);
       $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
       $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
         // Lấy bộ phim được truy cập nhiều nhất trong ngày
         $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
         ->orderBy('view', 'desc')->take(4)->get();
     // Lấy bộ phim được truy cập nhiều nhất trong tuần
     $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
     ->orderBy('view', 'desc')->take(4)->get();
     // Lấy bộ phim được truy cập nhiều nhất trong tháng
     $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
     $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
        return view('pages.genre', compact('url_canonical','reviewphim','many_genres','category','country','genre','genre_slug','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
    }
    public function country($slug,Request $request){
      $url_canonical = $request->url();
       $category = Category::orderBy('id','ASC')->get();
       $reviewphim=ReviewPhim::where('status',1)->paginate(24);
       $genre = Genre::orderBy('id','DESC')->get();
       $country = Country::orderBy('id','DESC')->get();
       $country_slug = Country::where('slug',$slug)->first();
       $movie = Movie::where('country_id',$country_slug->id)->paginate(24);
       $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
       $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
         // Lấy bộ phim được truy cập nhiều nhất trong ngày
         $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
         ->orderBy('view', 'desc')->take(4)->get();
     // Lấy bộ phim được truy cập nhiều nhất trong tuần
     $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
     ->orderBy('view', 'desc')->take(4)->get();
     // Lấy bộ phim được truy cập nhiều nhất trong tháng
     $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
     $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
        return view('pages.country', compact('url_canonical','reviewphim','category','country','genre','country_slug','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
    }
    public function movie($slug, Request $request){
      $url_canonical = $request->url();
        $url_canonical = $request->url();
        $category = Category::orderBy('id','ASC')->get();
        $reviewphim=ReviewPhim::where('status',1)->paginate(24);
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $movie= Movie::with('category','country','genres','episode')->where('slug',$slug)->where('status',1)->first();
        // dd($movie->episode);
        if(isset($movie->episode)){
          $episode = Episode::with('movie')->where('movie_id',$movie->id)->latest()->first();
        }else{
          $episode=Null;
        }
        // dd($movie);
       $episode_tapdau =  Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->first();
       $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
       $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
       $movie_simila =Movie::where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
         // Lấy bộ phim được truy cập nhiều nhất trong ngày
         $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
         ->orderBy('view', 'desc')->take(4)->get();
     // Lấy bộ phim được truy cập nhiều nhất trong tuần
     $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
     ->orderBy('view', 'desc')->take(4)->get();
     // Lấy bộ phim được truy cập nhiều nhất trong tháng
     $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
     $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
     $movie->increment('view');
     //rating Movie 
     $rating = Rating::where('movie_id',$movie->id)->avg('rating');//average ;
     $rating =round($rating);
     $count_total = Rating::where('movie_id',$movie->id)->count();
        return view('pages.movie',compact('url_canonical','rating','count_total','reviewphim','url_canonical','category','genre','country','movie','movie_simila','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie','episode','episode_tapdau'));
    }
    function add_rating( Request $request){
      $url_canonical = $request->url();
      $data=$request->all();
      $ip_address= $request->ip();
      $rating_count= Rating::where('movie_id',$data['movie_id'])->where('ip_address',$ip_address)->count();
      if($rating_count>0){
        echo 'exist';
      }else{
        $rating =new Rating();
        $rating->movie_id=$data['movie_id'];
        $rating->rating=$data['index'];
        $rating->ip_address =$ip_address;
        $rating->save();
        echo 'done';
      }
    }
    public function watch($slug,$tap,Request $request){
      $url_canonical = $request->url();
      $movie= Movie::with('category','country','genres','episode')->where('slug',$slug)->where('status',1)->first();
      if(isset($tap)){
        $tapphim =$tap;
        $tapphim =substr($tap,4,11);
        // dd($tapphim);
        $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
      }else{
        $tapphim =1;
      }
      // dd($tapphim);
        $category = Category::orderBy('id','ASC')->get();
        $reviewphim=ReviewPhim::where('status',1)->paginate(24);
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
        $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
        $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
          // Lấy bộ phim được truy cập nhiều nhất trong ngày
          $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
          ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tuần
      $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
      ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tháng
      $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
      $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
    //   return response()->json($movie); 
      return view('pages.watch',compact('url_canonical','reviewphim','category','genre','country','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie','episode','tapphim'));
    }
    public function reviewphim( Request $request){
      // $url_canonical = $request->url();
      $url_canonical = $request->url();
      $category = Category::orderBy('id','ASC')->get();
      // $reviewphim=ReviewPhim::where('status',1)->paginate(24);
      // dd($reviewphim);
      $genre = Genre::orderBy('id','DESC')->get();
      $country = Country::orderBy('id','DESC')->get();
      $reviewphim=ReviewPhim::where('status',1)->paginate(24);
      // $reviewphim->increment('view');
      return view('pages.reviewphim',compact('url_canonical','category','genre','country','reviewphim'));
    }
    public function watch_reviewphim($slug){
      // $url_canonical = $request->url();
      $reviewphim= ReviewPhim::where('status',1)->get();
      $phim= ReviewPhim::where('slug',$slug)->where('status',1)->first();
        $category = Category::orderBy('id','ASC')->get();
        // $reviewphim=ReviewPhim::where('status',1)->paginate(24);
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get(); 
      return view('pages.watch_reviewphim',compact('reviewphim','category','genre','country','phim'));
    }

    public function episode(){
        $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
          // Lấy bộ phim được truy cập nhiều nhất trong ngày
          $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
          ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tuần
      $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
      ->orderBy('view', 'desc')->take(4)->get();
      // Lấy bộ phim được truy cập nhiều nhất trong tháng
      $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
      $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
        return view('pages.episode',compact('mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
    }
    public function search(Request $request){
      $url_canonical = $request->url();
        if(isset($_GET ['search-btn'])){
            $search =$_GET['search'];
            $category = Category::orderBy('id','ASC')->get();
            $reviewphim=ReviewPhim::where('status',1)->paginate(24);
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','DESC')->get();
            $movie = Movie::where('title','LIKE','%'.$search.'%')->paginate(24);
            $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
            $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
              // Lấy bộ phim được truy cập nhiều nhất trong ngày
            $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
              ->orderBy('view', 'desc')->take(4)->get();
            // Lấy bộ phim được truy cập nhiều nhất trong tuần
            $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')->orderBy('view', 'desc')->take(4)->get();
           // Lấy bộ phim được truy cập nhiều nhất trong tháng
           $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
           $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
             return view('pages.result_search', compact('url_canonical','reviewphim','category','country','genre','search','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
        }else{
            return redirect()->to('/');
        }
    }
    public function locphim(Request $request){
      $url_canonical = $request->url();
      $data_category= $request->category;
      $data_genre= $request->genre;
      $data_country= $request->country;
      $data_year= $request->year;
      $cate_locphim = Category::where('id',$data_category)->first();
      $country_locphim = Country::where('id',$data_country)->first();
      $genre_locphim = Genre::where('id',$data_genre)->first();
      // dd($data_category,$data_genre,$data_country,$data_year);
      $category = Category::orderBy('id','ASC')->get();
      $reviewphim=ReviewPhim::where('status',1)->paginate(24);
      $genre = Genre::orderBy('id','DESC')->get();
      $country = Country::orderBy('id','DESC')->get();
      // $cate_slug = Category::where('slug',$slug)->first();
      // $locphim = Movie::with('category','gere','')
      // $movie = Movie::where('category_id',$data_category)->where('genre_id',$data_genre)->where('country_id',$data_country)->where('year_movie',$data_year)->paginate(24);
      $movie = Movie::query();

if (!empty($data_category)) {
    $movie = $movie->where('category_id', $data_category);
}

if (!empty($data_genre)) {
    $movie = $movie->whereHas('genres', function ($query) use ($data_genre) {
        $query->where('genre_id', $data_genre);
    });
}

if (!empty($data_country)) {
    $movie = $movie->where('country_id', $data_country);
}

if (!empty($data_year)) {
    $movie = $movie->where('year_movie', $data_year);
}

$movie = $movie->paginate(24);

      // dd($movie);
      $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
      $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
        // Lấy bộ phim được truy cập nhiều nhất trong ngày
      $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
        ->orderBy('view', 'desc')->take(4)->get();
    // Lấy bộ phim được truy cập nhiều nhất trong tuần
    $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
    ->orderBy('view', 'desc')->take(4)->get();
    // Lấy bộ phim được truy cập nhiều nhất trong tháng
    $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
    $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();
       return view('pages.locphim', compact('url_canonical','cate_locphim','country_locphim','genre_locphim','data_year','reviewphim','category','country','genre','movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
    }


//lien he, khieunai, 
public function lien_he(Request $request){
  $url_canonical = $request->url();
  $highlight_movie =Movie::latest()->where('phim_hot',1)->get();
  $category = Category::orderBy('id','ASC')->get();
  $reviewphim=ReviewPhim::where('status',1)->paginate(24);
  $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
  $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
  $category_home = Category::with('movie')->orderBy('id','ASC')->where('status',1)->get();
  // dd($highlight_movie);
 $genre = Genre::orderBy('id','DESC')->get();
 $country = Country::orderBy('id','DESC')->get();

  // Lấy bộ phim được truy cập nhiều nhất trong ngày
  $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
      ->orderBy('view', 'desc')->take(4)->get();
  // Lấy bộ phim được truy cập nhiều nhất trong tuần
  $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
  ->orderBy('view', 'desc')->take(4)->get();
  // Lấy bộ phim được truy cập nhiều nhất trong tháng
  $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
  $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();

  return view('pages.lien_he', compact('url_canonical','reviewphim','category','country','genre','category_home','highlight_movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
}
public function khieu_nai(Request $request){
  $url_canonical = $request->url();
  $highlight_movie =Movie::latest()->where('phim_hot',1)->get();
  $category = Category::orderBy('id','ASC')->get();
  $reviewphim=ReviewPhim::where('status',1)->paginate(24);
  $phimhot_sidebar = Movie::where('phim_hot','1')->where('status','1')->latest()->take(10)->get();
  $coming_soon_movie = Movie::where('quality','4')->where('status','1')->latest()->take(4)->get();
  $category_home = Category::with('movie')->orderBy('id','ASC')->where('status',1)->get();
  // dd($highlight_movie);
 $genre = Genre::orderBy('id','DESC')->get();
 $country = Country::orderBy('id','DESC')->get();

  // Lấy bộ phim được truy cập nhiều nhất trong ngày
  $mostViewedToday = Movie::whereDay('updated_at', $this->day)->where('status','1')->where('view', '>=', 0)
      ->orderBy('view', 'desc')->take(4)->get();
  // Lấy bộ phim được truy cập nhiều nhất trong tuần
  $mostViewedThisWeek = Movie::whereBetween('updated_at', [$this->now->startOfWeek()->toDateString(), $this->now->endOfWeek()->toDateString()])->where('status','1')
  ->orderBy('view', 'desc')->take(4)->get();
  // Lấy bộ phim được truy cập nhiều nhất trong tháng
  $mostViewedThisMonth = Movie::whereMonth('updated_at', $this->month)->where('status','1')->orderBy('view', 'desc')->take(4)->get();
  $mostViewedThisYear = Movie::whereYear('updated_at', $this->year)->orderBy('view', 'desc')->take(4)->get();

  return view('pages.khieu_nai', compact('url_canonical','reviewphim','category','country','genre','category_home','highlight_movie','phimhot_sidebar','mostViewedToday','mostViewedThisWeek','mostViewedThisMonth','mostViewedThisYear','coming_soon_movie'));
}
}
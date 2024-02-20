<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\ReviewPhim;
use App\Models\Rating;
use App\Models\Movie_Genre;
use DB;
use App;
use File;
use Illuminate\Support\Carbon;
class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = \App::make('sitemap');
        // add home pages mặc định
        $sitemap->add(route('homepage'), Carbon::now('Asia/Ho_Chi_Minh'), '1.0', 'daily');
        // get all gển from db 
        $genre =Genre::orderBy('id','DESC')->get();

        //add every post to the sitemap 
        foreach($genre as $gen)
        {
            $sitemap->add(env('APP_URL')."/the-loai/{$gen->slug}",Carbon::now('Asia/Ho_Chi_Minh'),'0.7','daily');
        }
        $category =Category::orderBy('id','DESC')->get();

        //add every post to the sitemap 
        foreach($category as $categoryItem)
        {
            $sitemap->add(env('APP_URL')."/danh-muc/{$categoryItem->slug}",Carbon::now('Asia/Ho_Chi_Minh'),'0.7','daily');
        }
        $country =Country::orderBy('id','DESC')->get();

        //add every post to the sitemap 
        foreach($country as $countryItem)
        {
            $sitemap->add(env('APP_URL')."/quoc-gia/{$countryItem->slug}",Carbon::now('Asia/Ho_Chi_Minh'),'0.7','daily');
        }
        $movie = Movie::orderBy('id','DESC')->get();

        //add every post to the sitemap 
        foreach($movie as $movieItem)
        {
            $sitemap->add(env('APP_URL')."/phim/{$movieItem->slug}",Carbon::now('Asia/Ho_Chi_Minh'),'0.6','daily');
        }
        $movie_ep =Movie::with('episode')->orderBy('id','DESC')->get();

        //add every post to the sitemap 
        foreach($movie_ep as $movieItem)
        {
            foreach($movieItem->episode as $ep){
                $sitemap->add(env('APP_URL')."/xem-phim/{$movieItem->slug}/tap-{$ep->episode}",Carbon::now('Asia/Ho_Chi_Minh'),'0.6','daily');

            }
        }
        $years = range(Carbon::now('Asia/Ho_Chi_Minh')->year,1980);
        foreach($years as $year){
            $sitemap->add(env('APP_URL')."/nam/{$year}",Carbon::now('Asia/Ho_Chi_Minh'),'0.6','daily');
        }
        // lưu file và phân quyền
        $sitemap->store('xml', 'sitemap');
        if (File::exists(public_path() . '/sitemap.xml')) {
            // chmod(public_path() . '/sitemap.xml', 0777);
            File::copy(public_path('sitemap.xml'),base_path('sitemap.xml'));
        }
    }
}

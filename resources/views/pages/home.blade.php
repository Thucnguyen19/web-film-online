@extends('layout')
@section('meta')
<meta name="description" content="Xem phim hay nhất, mới nhất, hot nhất, Xem Phim Online HD Vietsub - Thuyết Minh tốt trên nhiều thiết bị." />
<meta property="og:title" content="Phimhay | Phimmoi| Xem phim mới | Phim hay | Phim chiếu rạp | phim lẻ | phim bộ" />
<meta property="og:description" content="Xem phim hay nhất, mới nhất, hot nhất, Xem Phim Online HD Vietsub - Thuyết Minh tốt trên nhiều thiết bị." />
@endsection
@section('title')
   <title>Phimhay | Phimmoi| Xem phim mới | Phim hay | Phim chiếu rạp | phim lẻ | phim bộ </title>
@endsection
@section('content')
<script type='text/javascript' src='//pl22030891.profitablegatecpm.com/fd/9d/b1/fd9db18b76dba91008dd1d5550252654.js'></script>
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
 
    <div id="halim_related_movies-2xx" class="wrap-slider">
      <div class="section-bar clearfix">
         <h3 class="section-title"><span style="margin-left:20px">PHIM HOT</span></h3>
      </div>
      <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
         @foreach ($highlight_movie as $key  => $movieItem )
         <article class="thumb grid-item post-38498">
            <div class="halim-item">
               {{-- {{ dd($movieItem->id) }} --}}
               <a class="halim-thumb" href="{{ route('movie', ['slug' => $movieItem->slug]) }}" title="{{ $movieItem->title }}">
                  <figure><img class="lazy img-responsive" style="object-fit: cover" src="{{ asset('uploads/movie/'.$movieItem->image)}}" alt="{{ $movieItem->title }}" title="{{ $movieItem->title }}"></figure>
                  <span class="status"> 
                     @if ($movieItem->category_id == 11 || count($movieItem->episode)>1) 
                      @if (count($movieItem->episode) == 0)
                      Trailer
                      @elseif($movieItem->all_episode == 10000)
                      Tập{{ $movieItem->episode->sortByDesc('id')->first()['episode'] }}
                      @elseif (count($movieItem->episode) == $movieItem->all_episode)
                     Full {{ count($movieItem->episode) }}/{{ $movieItem->all_episode }}   
                     @else
                     Tập {{ count($movieItem->episode) }}/{{ $movieItem->all_episode }}                      
                      @endif
                   @else
                       @switch($movieItem->quality)
                           @case(0)
                           CAM
                             @break
                             @case(1)
                             HD
                               @break
                               @case(2)
                               FULL HD
                                 @break
                                 @case(3)
                                 2K
                                   @break
                                   @case(4)
                                   Trailer
                                     @break 
                                     @default
                                      Unknown Quality
                         @endswitch
                     @endif
                     </span>
                  <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                     @if ($movieItem->quality == 4)
                        Coming soon
                     @else
                     {{ $movieItem->phu_de == 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                     @endif
                  </span> 
                  <div class="icon_overlay"></div>
                  <div class="halim-post-title-box">
                     <div class="halim-post-title ">
                        <p class="entry-title">{{ $movieItem ->title }}</p>
                        <p class="original_title">{{ $movieItem ->title_en }}</p>
                     </div>
                  </div>
               </a>
            </div>
         </article>            
         @endforeach

        
      </div>
      <script>
         $(document).ready(function($) {				
         var owl = $('#halim_related_movies-2');
         owl.owlCarousel({loop: true,margin: 10,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="fa-solid fa-chevron-left" style="color: #9297a0;"></i>', '<i class="fa-solid fa-chevron-right" style="color: #9297a0;"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:5},1000: {items:5}}})});
      </script>
   </div>

    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
      @foreach ($category_home as $Category_value )
      <section id="halim-advanced-widget-2">
         <div class="section-heading" style="display:flex;justify-content:space-between">
            <a href="{{ route('category',$Category_value->slug) }}" title="{{ $Category_value ->title }}">
            <span class="h-text">{{ $Category_value ->title }}</span>
            </a>
            <a href="{{ route('category',$Category_value->slug) }}" title="Xem tất cả">
               <span class="h-text">Xem tất cả</span>
            </a>

         </div>
         <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
          @foreach ( $Category_value->movie->take(8) as $movieItem )
          <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
             <div class="halim-item">
                <a class="halim-thumb" href="{{ route('movie', ['slug' => $movieItem->slug]) }}">
                   <figure><img class="lazy img-responsive" src="{{ asset('uploads/movie/'.$movieItem->image)}}" style="object-fit: cover" alt="{{ $movieItem ->title }}" title="BẠN CÙNG PHÒNG CỦA TÔI LÀ GUMIHO"></figure>
                   <span class="status">
                   @if ($movieItem->category_id == 11 || count($movieItem->episode)>1) 
                      @if (count($movieItem->episode) == 0)
                      Trailer
                      @elseif($movieItem->all_episode == 10000)
                      Tập {{ $movieItem->episode->sortByDesc('id')->first()['episode'] }}
                      @elseif (count($movieItem->episode) == $movieItem->all_episode)
                     Full {{ count($movieItem->episode) }}/{{ $movieItem->all_episode }}   
                     @else
                     Tập {{ count($movieItem->episode) }}/{{ $movieItem->all_episode }}                      
                      @endif
                   @else
                     @switch($movieItem->quality)
                         @case(0)
                         CAM
                           @break
                           @case(1)
                           HD
                             @break
                             @case(2)
                             FULL HD
                               @break
                               @case(3)
                               2K
                                 @break
                                 @case(4)
                                 Trailer
                                   @break 
                                   @default
                                    Unknown Quality
                       @endswitch
                   @endif
                  </span>
                  <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                     @if ($movieItem->quality == 4)
                        Coming soon
                     @else
                     {{ $movieItem->phu_de == 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                     @endif
                  </span> 
                   <div class="icon_overlay"></div>
                   <div class="halim-post-title-box">
                      <div class="halim-post-title ">
                         <p class="entry-title">{{ $movieItem ->title }}</p>
                         <p class="original_title">{{ $movieItem ->title_en }}</p>
                      </div>
                   </div>
                </a>
             </div>
          </article>
             
          @endforeach
         </div>
        
      </section>
         
      @endforeach
       <div class="clearfix"></div>
    </main>
   @include('pages.include.sidebar')
 
 </div>
 @endsection
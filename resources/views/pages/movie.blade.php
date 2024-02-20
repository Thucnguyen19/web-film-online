@extends('layout')
@section('meta')
<meta name="description" content="{{ $movie->description }}" />
<meta property="og:title" content="{{ $movie->title .' '.$movie->year_movie.'-'.' '.$movie->title_en.' '.$movie->year_movie}} " />
<meta property="og:description" content="{{ $movie->description }}" />
<meta property="og:image" content="{{ $movie->image }}" />
@endsection
@section('title')
   <title>{{ $movie->title }} {{ $movie->year_movie }} - {{ $movie->title_en }} </title>
@endsection
@section('meta')
<meta property="fb:app_id" content="232505114857147" />
<meta http-equiv="Permissions-Policy" content="ambient-light-sensor=()">
    <meta property="fb:pages" content="1128104117285467" />
<meta content="{{ $url_canonical }}" name="canonical">
<meta property="og:image" content="{{  'http://localhost:8000/'.$movie->image }}" />
@endsection
@section('content')
 {{-- <div id="fb-root"></div> --}}
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{ route('category',[$movie->category->slug]) }}">{{ $movie->category->title }}</a> » <span><a href="{{ route('country',[$movie->country->slug]) }}">{{ $movie->country->title }}</a> » <span class="breadcrumb_last" aria-current="page">{{ $movie->title }}</span></span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section id="content" class="test">
          <div class="clearfix wrap-content">
            
             <div class="halim-movie-wrapper">
                <div class="title-block">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                      <div class="halim-pulse-ring"></div>
                   </div>
                   <div class="title-wrapper" style="font-weight: bold;">
                      Bookmark
                   </div>
                </div>
                <div class="movie_info col-xs-12">
                   <div class="movie-poster col-md-3">
                      <img class="movie-thumb" style="object-fit: cover" src="{{ asset('uploads/movie/'.$movie->image) }}" alt="{{ $movie->title }}">
                     @if ($movie->quality !== 4 || $episode !== Null)
                     <a href="{{ url('xem-phim/'.$movie->slug.'/tap-'.$episode_tapdau->episode) }}" class="btn btn-primary " style="display:block;margin:5px">Xem Phim</a>
                     @else
                        <a href="#trailer" class="btn btn-primary " style="display:block;margin:5px">Xem Trailer</a>
                     @endif
                     
                   </div>
                   <div class="film-poster col-md-9">
                      <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{ $movie->title }}</h1>
                      <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->title_en }} {{ $movie->year_movie }}</h2>
                      <ul class="list-info-group">
                         <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">                     
                        @switch($movie->quality)
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
                         @endswitch</span>
                         <span class="episode">                     
                        @if ($movie->quality === 4)
                           Coming soon
                        @else
                        {{ $movie->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                        @endif</span></li>
                         <li class="list-info-group-item"><span>Thời lượng</span> : {{ $movie->time_movie }}</li>
                         @if ($movie->category_id ===11)
                         <li class="list-info-group-item"><span>Số tập</span> :
                      @if ($movie->all_episode >1 || $movie->all_episode !== Null)
                         @if (count($movie->episode) === 0)
                           Coming soon
                        @else
                        {{ count($movie->episode) }}/{{ $movie->all_episode }}                      
                        @endif
                        @if (count($movie->episode)=== $movie->all_episode && $movie->all_episode !== 0)
                        - Hoàn thành                           
                        @endif
                      @endif
                     </li>                              
                      @endif
                {{-- {{ dd($episode) }} --}}
                 @if ($episode !== Null && count($movie->episode)!== $movie->all_episode && $movie->all_episode !== 0)
                 <li class="list-info-group-item"><span>Tập mới nhất</span> : <a class="btn btn-primary" href="{{  url('xem-phim/'.$movie->slug.'/tap-'.$episode->episode) }} " rel="tag">Tập {{ $episode->episode }}</a></li>                                             
                 @endif                    
              
    
                         <li class="list-info-group-item"><span>Thể loại</span> : 
                           @foreach ($movie->genres as $movieItem )
                           <a href="{{ route('genre',$movieItem->slug) }}" rel="category tag">{{ $movieItem ->title }}</a>, 
                           @endforeach
                         </li>
                         <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{ route('country',[$movie->country->slug]) }}" rel="tag">{{ $movie->country->title }}</a></li>
                         <li class="list-info-group-item"><span>Đạo diễn</span> : 
                           @if ($movie->director !== Null)
                           @php
                              $directors =array();
                              $directors= explode(',',$movie->director);
                           @endphp
                           @foreach ($directors as $key => $director )
                            
                              <a href="{{ url('director/'.$director) }}">
                                 {{ $director.', '}}
                              </a>
                            
                           @endforeach
                        @else
                              Đang cập nhập!
                        @endif
                        </li>
                         <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : 
                           @if ($movie->actor !== Null)
                           @php
                              $actors =array();
                              $actors= explode(',',$movie->actor);
                           @endphp
                           @foreach ($actors as $key => $actor )
                            
                              <a href="{{ url('actor/'.$actor) }}">
                                 {{ $actor.', '}}
                              </a>
                            
                           @endforeach
                        @else
                              Đang cập nhập!
                        @endif
                        </li>
                        <li class="list-info-group-item"> <ul class="list-inline rating" title="Average Rating">
                           @for($count=1; $count<=10; $count++)
                           @php
                              if($count<=$rating){
                                 $color ='color:#ffcc00';

                              }else{
                                 $color='color:#cccccc';
                              }
                           @endphp
                           <li id="{{ $movie->id }}-{{ $count }}" data-index="{{ $count }}" data-movie_id="{{ $movie->id }}" data-rating="{{ $rating }}" class="rating" style="cursor:pointer;{{ $color }};font-size:20px;">
                              &#9733;
                           </li>
                           @endfor
                           <span>(Đánh giá:{{ $rating }} điểm/{{ $count_total }} lượt)</span> 
                        </ul>
                     </li>

                      </ul>
                      <div class="movie-trailer hidden"></div>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div id="halim_trailer"></div>
             <div class="clearfix"></div>
             @if (count($movie->episode) !==0)
             <div id="halim-list-server">
               <div class="section-bar clearfix">
                  @if ($movie->category_id ===11)
                  <h2 class="section-title"><span style="color:#ffed4d">Chọn tập phim</span></h2>
                  @else
                  <h2 class="section-title"><span style="color:#ffed4d">Chọn link phim</span></h2>
                  @endif
               </div>
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                     <div class="halim-server">
                        <ul class="halim-list-eps">
                    @foreach ($movie->episode as $key => $episodeItem )
                     <a href="{{  url('xem-phim/'.$movie->slug.'/tap-'.$episodeItem->episode) }}">
                        <li class="halim-episode"><span class="halim-btn halim-btn-2  halim-info-1-1 box-shadow" data-post-id="37976" data-server="1" data-episode="1" data-position="first" data-embed="0" data-title="Xem phim {{ $movie->title }} - Tập {{ $episodeItem->episode }} - {{ $movie->title_en }} - Vietsub  + Thuyết Minh" data-h1="{{ $movie->title }} - tập {{ $episodeItem->episode }}">{{ $episodeItem->episode }}</span></li>
                    </a>
                       
                    @endforeach

                        </ul>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
            </div>                
             @endif
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix">
                <div class="video-item halim-entry-box">
                   <article id="post-38424" class="item-content">
                      Phim <a href="https://phimhay.co/goa-phu-den-38424/">{{ $movie->title }}</a> - {{ $movie->year_movie }} - {{ $movie->country->title }}:
                      <p>{{ $movie->title }} &#8211; {{ $movie->title_en }}: {{ $movie->description }}</p>
                      <h5>Từ Khoá Tìm Kiếm:</h5>
                      <ul>
                        @if ($movie->tag_movie !== Null)
                           @php
                              $tags =array();
                              $tags= explode(',',$movie->tag_movie);
                           @endphp
                           @foreach ($tags as $key => $tag )
                            
                              <a href="{{ url('tag/'.$tag) }}">
                                 {{ $tag.' |'}}
                              </a>
                            
                           @endforeach
                        @else
                           <a href="{{ url('tag/'.$movie->title) }}">
                              {{ $movie->title }}
                           </a>
                           
                        @endif
                      </ul>
                   </article>
                </div>
             </div>
             <div class="section-bar clearfix" id="trailer">
               <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix text-center" >
               <iframe width="100%" height="415" src="https://www.youtube.com/embed/{{ $movie->trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
           
          </div>
       </section>
       <section class="related-movies">
          <div id="halim_related_movies-2xx" class="wrap-slider">
             <div class="section-bar clearfix">
                <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
             </div>
             <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
               @foreach ($movie_simila as $movieItem)
               <article class="thumb grid-item post-38498">
                  <div class="halim-item">
                     <a class="halim-thumb" href="{{ route('movie',$movieItem->slug) }}" title="{{ $movieItem->title }}">
                        <figure><img class="lazy img-responsive"  style="object-fit: cover" src="{{ asset('uploads/movie/'.$movieItem->image) }}" alt="{{ $movieItem->title }}" title="{{ $movieItem->title }}"></figure>
                        <span class="status">
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
                        </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                           @if ($movieItem->quality === 4)
                           Coming soon
                        @else
                        {{ $movieItem->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                        @endif
                        </span> 
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                           <div class="halim-post-title ">
                              <p class="entry-title">{{ $movieItem->title }}</p>
                              <p class="original_title">{{ $movieItem->title_en }}</p>
                           </div>
                        </div>
                     </a>
                  </div>
               </article>                  
               @endforeach
                
               
             </div>
             
          </div>
       </section>
      
    </main>
    @include('pages.include.sidebar')

 </div>
 {{-- <div class="section-bar clearfix" id="comment">
   <h2 class="section-title"><span style="color:#ffed4d">Để lại 1 bình luận</span></h2>
</div>
<div class="container" >
<div class="fb-comments" data-href="{{ $url_canonical }}" data-width="100%" data-numposts="5"></div>
<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="100%" data-numposts="20"></div>
</div> --}}

@endsection
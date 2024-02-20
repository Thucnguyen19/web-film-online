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
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">PHIM</a> CỦA ĐẠO DIỄN: <span class="breadcrumb_last" aria-current="page">{{ $director }}</span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section>
          <div class="section-bar clearfix">
             <h1 class="section-title"><span>{{ $director }}</span></h1>
          </div>
          <div class="section-bar clearfix">
            <form action="{{ route('locphim') }}" method="get">
             <select class="form-select" aria-label="Default select example" name="category" style="padding: 5px 0;width:150px; margin-right:10px">
                <option selected class="text-center" value="">Danh mục phim</option>
                @foreach ($category as $value )
                <option value="{{ $value->id }}">{{ $value->title }}</option>                  
                @endforeach
              </select>
             <select class="form-select" aria-label="Default select example" name="genre" style="padding: 5px 0;width:150px; margin-right:10px">
                <option selected class="text-center" value="">Thể loại</option>
                @foreach ($genre as $value )
                <option value="{{ $value->id }}">{{ $value->title }}</option>                  
                @endforeach
              </select>
              <select class="form-select" aria-label="Default select example" name="country" style="padding: 5px 0;width:150px; margin-right:10px">
                <option selected class="text-center" value="">Quốc gia</option>
                @foreach ($country as $value )
                <option value="{{ $value->id }}">{{ $value->title }}</option>                  
                @endforeach
              </select>
              <select class="form-select" aria-label="Default select example" name="year" style="padding: 5px 0;width:150px; margin-right:10px">
                <option selected class="text-center" value="">Năm</option>
                @for ($year= 2023;$year>=1980; $year-- )
                <option value="{{ $year }}">{{ $year }}</option>                  
                @endfor
              </select>
              <input class="btn-primary"  type="submit" value="Lọc phim">
          </form>
          </div>
          <div class="halim_box">
            @foreach ($movie as $movieItem )
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
               <div class="halim-item">
                  <a class="halim-thumb" href="{{ route('movie',$movieItem->slug) }}" title="{{ $movieItem->title }}">
                     <figure><img class="lazy img-responsive" style="object-fit:cover" src="{{ asset('uploads/movie/'.$movieItem->image) }}" alt="{{ $movieItem->title }}" title="{{ $movieItem->title }}"></figure>
                     <span class="status">
                        @if ($movieItem->category_id === 11 || count($movieItem->episode)>1) 
                      @if (count($movieItem->episode) === 0)
                      Trailer
                      @elseif($movieItem->all_episode === 10000)
                      Tập {{ count($movieItem->episode) }}                
                      @elseif (count($movieItem->episode) === $movieItem->all_episode)
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
                     @endif</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>                    
                     @if ($movieItem->quality === 4)
                        Coming soon
                     @else
                     {{ $movieItem->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                     @endif</span> 
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
          <div class="clearfix"></div>
          <div class="text-center">
            
          {{ $movie->links('pagination::bootstrap-4') }}
          </div>
       </section>
    </main>
    @include('pages.include.sidebar')

 </div>
@endsection
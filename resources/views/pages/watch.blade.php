@extends('layout')
@section('meta')
<meta name="description" content="{{ $movie->description }}" />
<meta property="og:title" content="{{ $movie->title .' '.$movie->year_movie.'-'.' '.$movie->title_en.' '.$movie->year_movie}} " />
<meta property="og:description" content="{{ $movie->description }}" />
<meta property="og:image" content="{{ $movie->image }}" />
@endsection
@section('title')
   <title>{{ $movie->title }} {{ $movie->year_movie }} {{ $movie->all_episode > 1 ? 'tập' : '' }} {{ $tapphim }} - {{ $movie->title_en }} {{ $movie->year_movie }}</title>
@endsection
@section('content')
<style>
   .link_film>iframe{
      width: 100%;
      height: 500px;
   }
</style>
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
      
                <div class="yoast_breadcrumb hidden-xs">
                  <span><span><a href="{{ route('category',[$movie->category->slug]) }}">{{ $movie->category->title }}</a> » <span><a href="{{ route('category',[$movie->country->slug]) }}">{{ $movie->country->title }}</a> » <span class="breadcrumb_last" aria-current="page">{{ $movie->title }}</span></span></span></span></div>
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
            <div class="text-center link_film">
               <iframe width="560" height="315" src="{{ $episode->link_film }}" title="Phim-hay-tong-hop-player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                  {{-- {!! $episode->link_film !!} --}}
            </div>  
             <div class="button-watch">
                <ul class="halim-social-plugin col-xs-4 hidden-xs">
                   <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                </ul>
                <ul class="col-xs-12 col-md-8">
                   <div id="autonext" class="btn-cs autonext">
                      <i class="icon-autonext-sm"></i>
                      <i class="fa-solid fa-forward" style="color: #ffffff;"></i> Autonext: <span id="autonext-status">On</span></span>
                   </div>
                   <div id="explayer" class="hidden-xs"><i class="fa-solid fa-expand" style="color: #ffffff;"></i>
                      Expand 
                   </div>
                   <div id="toggle-light"><i class="fa-solid fa-circle-half-stroke"></i>
                      Light Off 
                   </div>
                   <div id="report" class="halim-switch"><i class="fa-regular fa-flag" style="color: #ffffff;"></i> Report</div>
                   <div class="luotxem">
                     <i class="fa-regular fa-eye" style="color: #ffffff;"></i>
                      <span>  @if ($movie->view >= 1000000) 
                        {{ number_format($movie->view / 1000000, 1) . 'M' }}
                    @elseif ($movie->view >= 1000) 
                        {{ number_format($movie->view  / 1000, 1)  . 'K' }}
                    @elseif ($movie->view < 1000) 
                       {{ $movie->view + 1000 }}
                    @else 

                        {{ $movie->view }}
                    @endif
                    
                  </span> lượt xem 
                   </div>
                   <div class="luotxem">
                      <a class="visible-xs-inline" data-toggle="collapse" href="#moretool" aria-expanded="false" aria-controls="moretool"><i class="hl-forward"></i> Share</a>
                   </div>
                </ul>
             </div>
             <div class="collapse" id="moretool">
                <ul class="nav nav-pills x-nav-justified">
                   <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                   <div class="fb-save" data-uri="" data-size="small"></div>
                </ul>
             </div>
          
             <div class="clearfix"></div>
             <div class="clearfix"></div>
             <div class="title-block">
                <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                      <div class="halim-pulse-ring"></div>
                   </div>
                </a>
                <div class="title-wrapper-xem full">
                  @if (isset($movie->episode))
                  <h1 class="entry-title"><a href="" title="{{ $movie->title.' '.'Tập '.$tapphim }}" class="tl">{{ $movie->title.' '.'Tập'.$tapphim}}</a></h1>  
                  @else
                  <h1 class="entry-title"><a href="" title="{{ $movie->title }}" class="tl">{{ $movie->title}}</a></h1>    
                  @endif
                </div>
             </div>
             <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                <article id="post-37976" class="item-content post-37976"></article>
             </div>
             <div class="clearfix"></div>
             <div class="text-center">
                <div id="halim-ajax-list-server"></div>
             </div>
             <div id="halim-list-server">
                <ul class="nav nav-tabs" role="tablist">
                   <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="fa-solid fa-circle-play" style="color: #ffffff;"></i>       
                  @if ($movie->quality === 4)
                     Coming soon
                  @else
                  {{ $movie->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                  @endif</a></li>
                </ul>
                <div class="tab-content">
                   <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                      <div class="halim-server">
                         <ul class="halim-list-eps">
                     @foreach ($movie->episode as $key => $episode )
                      <a href="{{  url('xem-phim/'.$movie->slug.'/tap-'.$episode->episode) }}">
                        {{-- {{ dd($episode->episode) }} --}}
                         <li class="halim-episode"><span class="halim-btn halim-btn-2 {{ $tapphim == $episode->episode ? 'active' : '' }} halim-info-1-1 box-shadow" data-post-id="37976" data-server="1" data-episode="1" data-position="first" data-embed="0" data-title="Xem phim {{ $movie->title }} - Tập 1 - {{ $movie->title_en }} - Vietsub  + Thuyết Minh" data-h1="{{ $movie->title }} - tập 1">{{ $episode->episode }}</span></li>
                     </a>
                        
                     @endforeach

                         </ul>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div class="htmlwrap clearfix">
                <div id="lightout"></div>
             </div>
       </section>

    </main>
  @include('pages.include.sidebar')
 </div>
@endsection
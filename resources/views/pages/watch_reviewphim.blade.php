@extends('layout')
@section('title')
   <title>Phimhay | Phimmoi| Xem phim mới | Phim hay | Phim chiếu rạp | phim lẻ | phim bộ </title>
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
                  <span><span>REVIEW PHIM » <span>{{ $phim->title }}</span></span>
                </div>
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
                  {!! $phim->link_other !!}
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
                      <span>  @if ($phim->view >= 1000000) 
                        {{ number_format($phim->view / 1000000, 1) . 'M' }}
                    @elseif ($phim->view >= 1000) 
                        {{ number_format($phim->view  / 1000, 1)  . 'K' }}
                    @elseif ($phim->view < 1000) 
                       {{ $phim->view + 1000 }}
                    @else 

                        {{ $phim->view }}
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
             <div class="">
                <h3 class="entry-title">{{ $phim->title}}</h3>    
              </div>
             <div class="clearfix"></div>
          
             <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                <article id="post-37976" class="item-content post-37976"></article>
             </div>
             <div class="clearfix"></div>
             <div class="text-center">
                <div id="halim-ajax-list-server"></div>
             </div>
            
             <div class="clearfix"></div>
             <div class="htmlwrap clearfix">
                <div id="lightout"></div>
             </div>
       </section>

    </main>
  {{-- @include('pages.include.sidebar') --}}
 </div>
@endsection
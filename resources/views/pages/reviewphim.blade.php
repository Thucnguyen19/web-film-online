@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span>PHIM TỔNG HỢP<span> » <a href="">REVIEW PHIM</a><span class="breadcrumb_last" aria-current="page"></span></span></span></div>
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
             <h1 class="section-title"><span> REVIEW PHIM</span></h1>
          </div>
          <div class="halim_box">
            @foreach ($reviewphim as $reviewItem )
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
               <div class="halim-item">
                  <a class="halim-thumb" href="{{ route('watch_reviewphim',$reviewItem->slug) }}" title="{{ $reviewItem->title }}">
                     <figure><img class="lazy img-responsive" style="object-fit:cover" src="{{ asset('uploads/reviewphim/'.$reviewItem->image) }}" alt="{{ $reviewItem->title }}" title="{{ $reviewItem->title }}"></figure>
                     <div class="icon_overlay"></div>
                     <div class="halim-post-title-box">
                        <div class="halim-post-title ">
                           <p class="entry-title">{{ $reviewItem->title }}</p>
                           <p class="original_title">{{ $reviewItem->description }}</p>
                        </div>
                     </div>
                  </a>
               </div>
            </article>               
            @endforeach

          </div>
          <div class="clearfix"></div>
          <div class="text-center">
            
          {{ $reviewphim->links('pagination::bootstrap-4') }}
          </div>
       </section>
      </main>
      {{-- @include('pages.include.sidebar') --}}
 </div>
@endsection
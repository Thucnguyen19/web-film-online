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
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">Liên Hệ</a></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        Mọi vấn đề thắc mắc hoặc về quảng cáo xin vui lòng liên hệ qua
         Telegram: <a href="https://web.telegram.org/a/#6849602330">
            @adphimhay2010
         </a>
    </main>
    @include('pages.include.sidebar')

 </div>
@endsection
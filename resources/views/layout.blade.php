<!DOCTYPE html>
<html lang="vi">
   <head>
      @yield('title')
      <meta charset="utf-8" />
      <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
      <meta name="theme-color" content="#234556">
      <meta http-equiv="Content-Language" content="vi" />
      <meta content="VN" name="geo.region" />
      <meta name="csrf-token" content="{{ csrf_token() }}" >
      <meta name="DC.language" scheme="utf-8" content="vi" />
      <meta name="language" content="Việt Nam">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="mobile-web-app-capable" content="yes">
      <meta name="revisit-after" content="1 days" />
      <meta property="og:locale" content="vi_VN" />
      <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
      <meta property="og:url" content="{{ $url_canonical }}" />
      <meta property="og:site_name" content="PhimHay" />
      @yield('meta')
      <meta property="og:image:width" content="300" />
      <meta property="og:image:height" content="55" />
      <link rel="shortcut icon" href="/img/icon.png" type="image/x-icon" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="canonical" href="{{ $url_canonical }}">
      <link rel="next" href="" />
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
      <link rel='dns-prefetch' href='//s.w.org' />
      <link rel='stylesheet' id='bootstrap-css' href='{{ asset('css/bootstrap.min.css?ver=5.7.2')}}' media='all' />
      {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
      <link rel='stylesheet' id='style-css' href='{{ asset('css/style.css?ver=5.7.2')}}' media='all' />
      <link rel='stylesheet' id='wp-block-library-css' href='{{ asset('css/style.min.css?ver=5.7.2') }}' media='all' />
      <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="OGsIatgX"></script>
      <script type='text/javascript' src='{{ asset('js/jquery.min.js?ver=5.7.2') }}' id='halim-jquery-js'></script>
      <script type='text/javascript' src='{{ asset('js/bootstrap.min.js?ver=5.7.2') }}' id='bootstrap-js'></script>
      <script type='text/javascript' src='{{ asset('js/owl.carousel.min.js?ver=5.7.2') }}' id='carousel-js'></script>
      <script type='text/javascript' src='{{ asset('js/halimtheme-core.min.js?ver=1626273138') }}' id='halim-init-js'></script>
      {{-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="hTq69Cmy"></script>  --}}
   <script>
      $(document).ready(function() {
    $('#pills-tab a[href="#pills-home"]').tab('show');
});

   </script>

   </head>

   <body class="home blog halimthemes halimmovies" data-masonry="">
      <header id="header">
         <div class="container">
            <div class="row" style="display:flex;align-items: center;justify-content:space-between" id="headwrap">
               <div class="col-md-6 col-sm-6 slogan">
                  <img src="{{ asset('img/logo_phim2.png') }}" alt="phim hay" style="width:250px; height:100px;object-fit:cover">
                  {{-- <p class="site-title"><a class="logo" href="" title="Phim Hay ">Phim Hay</a></p> --}}
               </div>
               <div class="col-md-6 col-sm-6 halim-search-form">
                  <div class="header-nav">
                     <div class="col-xs-12 container">
                        <form id="search-form-pc" name="halimForm" role="search" action="{{ route('search') }}" method="GET">
                           <div class="form-group">
                              <div class="input-group col-xs-12" style="display: flex">
                                 <input id="search" type="text" name="search" class="form-control col-xs-10" placeholder="Nhập tên phim, diễn viên,..." autocomplete="off" required>
                                 <button class="btn btn-primary col-xs-2" name="search-btn"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
                              </div>
                              <ul id="result" class="list-group " style="display: none; display: inherit;position: absolute;background-color: #f7f7f7;z-index: 100;right: 0;width: 100%;border-radius: 5px;top: 40px;"></ul>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <div class="navbar-container">
         <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                  <span class="sr-only">Menu</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
               </div>
               <div class="collapse navbar-collapse" id="halim">
                  <div class="menu-menu_1-container">
                     <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{ route('homepage') }}">Trang Chủ</a></li>
                       
                        <li class="mega dropdown">
                           <a title="Thể Loại" href="" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach ($genre as $genreItem )
                              <li><a title="{{ $genreItem->title }}" href="{{ route('genre',$genreItem->slug) }}">{{ $genreItem ->title }}</a></li> 
                              @endforeach
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Quốc Gia" href="" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach ($country as $countryItem)
                              <li><a title="{{ $countryItem->title }}" href="{{ route('country',$countryItem->slug) }}">{{ $countryItem->title }}</a></li>                                 
                              @endforeach
                           </ul>
                        </li>  
                        <li class="mega dropdown">
                           <a title="Năm" href="" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Năm <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @for ($year= 2023; $year>=1980;$year--)
                              <li><a title="Phim {{ $year }}" href="{{ url('nam/'.$year) }}">{{ $year }}</a></li>
                                 
                              @endfor
                      
                           </ul>
                        </li> 
                        @foreach ($category as $categoryItem )
                        <li class="mega"><a title="{{ $categoryItem->title }}" href="{{ route('category',$categoryItem->slug) }}">{{ $categoryItem->title }}</a></li>                           
                        @endforeach
                        {{-- <li class="mega"><a title="Review Phim" href="{{ route('reviewphim') }}">Review Phim</a></li>                            --}}
                      
                        </ul>
                  </div>
                  {{-- <ul class="nav navbar-nav navbar-left" style="background:#000;">
                     <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                  </ul> --}}
               </div>
            </nav>
            {{-- <div class="collapse navbar-collapse" id="search-form">
               <div id="mobile-search-form" class="halim-search-form"></div>
            </div>
            <div class="collapse navbar-collapse" id="user-info">
               <div id="mobile-user-login"></div>
            </div> --}}
         </div>
      </div>
      </div>
      
      <div class="container">
         <div class="row fullwith-slider"></div>
      </div>
      <div class="container">
         @yield('content')
      </div>
      <div class="clearfix"></div>
      <footer id="footer" class="clearfix">
         <div class="container footer-columns">
            <div class="row container">
               <div class="widget about col-xs-12 col-sm-4 col-md-6">
                  <div class="footer-logo">
                     <img class="img-responsive" src="{{ asset('img/logo_phim2.png') }}" alt="Phim tong hop 2023- Xem phim hay nhất" />
                  </div>
                 <span class="footer_des">Xem phim online miễn phí chất lượng cao với phụ đề tiếng việt - thuyết minh - lồng tiếng. Phimhay có nhiều thể loại phim phong phú, đặc sắc, nhiều bộ phim hay nhất - mới nhất - hot nhất.</span> 
               <br/>
               <span class="footer_des">
                    <a href="{{ route('homepage') }}">Phimhay</a>
                    - Trang xem phim online với giao diện mới được bố trí và thiết kế thân thiện với người dùng. Nguồn phim được tổng hợp từ các website lớn với đa dạng các đầu phim và thể loại vô cùng phong phú.
                 </span>
                  {{-- Liên hệ QC: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e5958d8c888d849ccb868aa58288848c89cb868a88">vuareviewphim2023@gmail.com</a> --}}
               </div>
               <div class="col-md-3">
                  <ul class="list-footer">
                     <li class="menu-footer-title" ><a class="text-bold" title="Trang Chủ" href="{{ route('homepage') }}">
                           Phim Hay
                     </a></li>
                     @foreach ($category as $categoryItem )
                     <li class="menu-footer-child"><a title="{{ $categoryItem->title }}" href="{{ route('category',$categoryItem->slug) }}">{{ $categoryItem->title }}</a></li>                           
                     @endforeach
                  </ul>
               </div>
               <div class="col-md-3">
                  <ul class="list-footer">
                     <li class="menu-footer-title"><a title="Trang Chủ" href="{{ route('homepage') }}">Thông Tin</a></li>
                   <li class="menu-footer-child"><a href="">Trang Chủ</a></li>
                   <li class="menu-footer-child"><a href="">Giới Thiệu Về Chúng Tôi</a></li>
                   <li class="menu-footer-child"><a href="{{ route('lien_he') }}">Liên Hệ Chúng Tôi</a></li>
                   <li class="menu-footer-child"><a href="{{ route('khieu_nai') }}">Khiếu Nại Về Bản Quyền</a></li>
                   <li class="menu-footer-child"><a href="">Fanpage</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </footer>
      <div id='easy-top'></div>

<script src="{{ asset('js/layout.js') }}"></script>
<script type="text/javascript">
 function remove_background(movie_id){
   for(var count =1;count<=10;count++){
      $('#'+movie_id+'-'+count).css('color','#cccccc');
   }
 }
 //hover mouse to rating 
$(document).on('mouseenter','.rating',function(){
   var index =$(this).data("index");
   var movie_id = $(this).data('movie_id');
   // alert(index);
   remove_background(movie_id);
   for(var count = 1; count<=index;count++){
      // alert(movie_id+'-'+count);
      $('#'+movie_id+'-'+count).css('color','#ffcc00');
   }
})
//moving the mouse out won't rating
$(document).on('mouseleave','.rating',function(){
   var index =$(this).data("index");
   var movie_id =$(this).data('movie_id');
   var rating =$(this).data("rating");
   remove_background(movie_id);
   for(var count =1;count<=rating;count++){
      $('#'+movie_id+'-'+count).css('color','#ffcc00');

   }
})
//click to rating 
$(document).on('click','.rating',function(){
   var index =$(this).data("index");
   var movie_id = $(this).data('movie_id');
   $.ajax({
      url:"{{ route('add_rating') }}",
      method:"POST",
      data: {
         index:index, movie_id:movie_id
      },
      headers:{
         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      },
      success:function(data){
         if(data=="done"){
            alert("Bạn đã đánh giá phim này "+index+" sao");
            location.reload();
         }else if(data=="exist"){
            alert("Bạn đã đánh giá phim này rồi !");
         }else{
            alert('Erros rating !');
         }
      }
   });
});
</script>
   </body>
</html>
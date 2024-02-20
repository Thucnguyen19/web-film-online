<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- link css của dâttables.net --}}
    <link rel="stylesheet" href="{{ asset('datatables/datatables.css') }}">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- js của datatables  --}}
    <script src="{{ asset('datatables/datatables.js') }}"></script>
    <style>
        #myBtn {
      display: none; /* Ẩn nút khi người dùng không cuộn */
      position: fixed; /* Đặt nút ở vị trí cố định trên trang */
      bottom: 20px; /* Đặt nút ở dưới cùng trang */
      right: 30px; /* Đặt nút ở bên phải trang */
      z-index: 99; /* Đảm bảo nút luôn nằm trên cùng */
      border: none; /* Không có viền */
      outline: none; /* Loại bỏ hiệu ứng đường viền khi nhấp vào nút */
      background-color: rgb(0, 94, 255); /* Màu nền */
      color: white; /* Màu chữ */
      cursor: pointer; /* Thêm con trỏ chuột khi di chuyển qua nút */
      padding: 15px; /* Khoảng cách giữa chữ và viền nút */
     
    }
    
    #myBtn:hover {
      background-color: #555; /* Thay đổi màu nền khi di chuyển chuột qua nút */
    }
    
    </style>
        
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (Auth::id())            
            <div class="container">
                @include('layouts.navbar')
            </div>
            @endif
            @yield('content')
        </main>
    </div>
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-solid fa-chevron-up" style="color: #ffffff;"></i>
      </button>
    <script>
        //Get the button
        var mybutton = document.getElementById("myBtn");
        
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
          } else {
            mybutton.style.display = "none";
          }
        }
        
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          document.body.scrollTop = 0; // For Safari
          document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
        </script>
        <script>
          $('.select-year').change(function(){
    var year = $(this).find(':selected').val();
    var id_phim = $(this).attr("id");
    $.ajax({
        url: "/update-year-phim", // Thay đổi URL này nếu cần
        method: "GET",
        data: { year_movie:year, id_phim: id_phim},
        success: function() {
            alert('Change year to ' + year + ' successful!')
        }
    })
});
$('.select-season').change(function(){
    var season = $(this).find(':selected').val();
    var id_phim = $(this).attr("id");
    $.ajax({
        url: "/update-season-phim", // Thay đổi URL này nếu cần
        method: "GET",
        data: { season:season, id_phim: id_phim},
        success: function() {
            alert('Change season to ' + season + ' successful!')
        }
    })
})

        </script>
    <script>
        $('.select-movie').change(function(){
            var id = $(this).val();
            // alert(id);

            
        $.ajax({
        url: "{{ route('select-movie') }}", // Thay đổi URL này nếu cần
        method: "GET",
        data: {id:id},
        success: function(data) {
            // alert(data);
           $('#episode').html(data);
        }
    })
        })
    </script>
</body>
</html>

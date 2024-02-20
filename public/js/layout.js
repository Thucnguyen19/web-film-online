
$(document).ready(function($) {				
var owl = $('#halim_related_movies-2');
owl.owlCarousel({loop: true,margin: 10,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="fa-solid fa-chevron-left" style="color: #9297a0;"></i>', '<i class="fa-solid fa-chevron-right" style="color: #9297a0;"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:5},1000: {items:5}}});

    $('#search').keyup(function(){
      $('#result').html('');
      var search = $('#search').val();
      if(search != ''){
        var expression = new RegExp(search, "i");
        $.getJSON('/json/movies.json', function(data){
          $.each(data, function(key, value){
            if(value.title.search(expression) != -1 || value.description.search(expression) != -1){
              $('#result').css('display', 'inherit');
              $('#result').append('<li style="cursor:pointer;list-style:none" class="list-group-item link-class"><a href="/phim/' + value.slug + '"><img src="/uploads/movie/'+value.image+'" height="40px" width="40px" class=""/> '+value.title+' <br/> <span class="text-muted">'+value.description+'</span></a></li>');
            }
          });
        });
      } else {
        $('#result').css('display', 'none');
      }
    });

    $('#result').on('click', 'li', function(){
      var click_text = $(this).text().split('|');
      $('#search').val($.trim(click_text[0]));
      $('#result').html('');
    });
  });

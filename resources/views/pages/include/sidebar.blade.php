
   <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
       <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
          <div class="section-bar clearfix" style="display: flex;flex-direction:column">
             <div class="section-title dashed">
                <span>TOP TRENDING</span>
               </div>
               
               <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item active">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ngày</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
                  </li>
                  <li class="nav-item">
                   <a class="nav-link" id="pills-year-tab" data-toggle="pill" href="#pills-year" role="tab" aria-controls="pills-year" aria-selected="false">Năm</a>
                 </li>
                </ul>
                <div class="tab-content " id="pills-tabContent">
                  <div class="tab-pane fade active in" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                          <div class="halim-ajax-popular-post-loading hidden"></div>
                       
                          <div id="halim-ajax-popular-post " class="popular-post">    
                           @if ($mostViewedToday === Null)
                           @foreach ($phimhot_sidebar as $key => $value )
                           <div class="item post-37176">
                              <a href="{{ route('movie', ['slug' => $value->slug]) }}" title="{{ $value->title }}">
                                 <div class="item-link">
                                    <img src="{{ asset('uploads/movie/'.$value->image)}}" style="object-fit: cover" class="lazy post-thumb" alt="{{ $value->title }}" title="{{ $value->title }}" />
                                   
                                    <span class="is_trailer">  
                                    @if ($value->quality === 4)
                                      Trailer
                                    @else
                                    {{ $value->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                                    @endif
                                 </span>
                                 </div>
                                 <p class="title">{{ $value->title }}</p>
                              </a>
                           <div class="viewsCount" style="color: #9d9d9d;">{{ $value ->title_en }}</div>
                              <div style="float: left;">
                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                 <span style="width: 0%"></span>
                                 </span>
                              </div>
                           </div>    
                           @endforeach 
                           @else
                           @foreach ($mostViewedToday as $key => $value )
                           <div class="item post-37176">
                              <a href="{{ route('movie', ['slug' => $value->slug]) }}" title="{{ $value->title }}">
                                 <div class="item-link">
                                    <img src="{{ asset('uploads/movie/'.$value->image)}}" style="object-fit: cover" class="lazy post-thumb" alt="{{ $value->title }}" title="{{ $value->title }}" />
                                   
                                    <span class="is_trailer">  
                                    @if ($value->quality === 4)
                                      Trailer
                                    @else
                                    {{ $value->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                                    @endif
                                 </span>
                                 </div>
                                 <p class="title">{{ $value->title }}</p>
                              </a>
                           <div class="viewsCount" style="color: #9d9d9d;">{{ $value ->title_en }}</div>
                              <div style="float: left;">
                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                 <span style="width: 0%"></span>
                                 </span>
                              </div>
                           </div>    
                           @endforeach 
                           @endif        
                                              
                          </div>
                        </div>
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"> 
               
                          <div class="halim-ajax-popular-post-loading hidden"></div>
                          <div id="halim-ajax-popular-post" class="popular-post">
                          
                            @foreach ($mostViewedThisWeek as $key => $value )
                            <div class="item post-37176">
                               <a href="{{ route('movie', ['slug' => $value->slug]) }}" title="{{ $value->title }}">
                                  <div class="item-link">
                                     <img src="{{ asset('uploads/movie/'.$value->image)}}" style="object-fit: cover" class="lazy post-thumb" alt="{{ $value->title }}" title="{{ $value->title }}" />
                                    
                                     <span class="is_trailer">  
                                       @if ($value->quality === 4)
                                      Trailer
                                    @else
                                    {{ $value->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                                    @endif 
                                  </span>
                                  </div>
                                  <p class="title">{{ $value->title }}</p>
                               </a>
                              <div class="viewsCount" style="color: #9d9d9d;">{{ $value ->title_en }}</div>
                               <div style="float: left;">
                                  <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                  <span style="width: 0%"></span>
                                  </span>
                               </div>
                            </div>    
                            @endforeach
                            
                          </div>
                      
               </div>
                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                          <div class="halim-ajax-popular-post-loading hidden"></div>
                          <div id="halim-ajax-popular-post" class="popular-post">
                          
                            @foreach ($mostViewedThisMonth as $key => $value )
                            <div class="item post-37176">
                               <a href="{{ route('movie', ['slug' => $value->slug]) }}" title="{{ $value->title }}">
                                  <div class="item-link">
                                     <img src="{{ asset('uploads/movie/'.$value->image)}}" style="object-fit: cover" class="lazy post-thumb" alt="{{ $value->title }}" title="{{ $value->title }}" />
                                    
                                     <span class="is_trailer">  
                                       @if ($value->quality === 4)
                                      Trailer
                                    @else
                                    {{ $value->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                                    @endif 
                                  </span>
                                  </div>
                                  <p class="title">{{ $value->title }}</p>
                               </a>
                              <div class="viewsCount" style="color: #9d9d9d;">{{ $value ->title_en }}</div>
                               <div style="float: left;">
                                  <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                  <span style="width: 0%"></span>
                                  </span>
                               </div>
                            </div>    
                            @endforeach
                            
                          </div>
               </div>
                <div class="tab-pane fade" id="pills-year" role="tabpanel" aria-labelledby="pills-year-tab"> 
             
                          <div class="halim-ajax-popular-post-loading hidden"></div>
                          <div id="halim-ajax-popular-post" class="popular-post">
                          
                            @foreach ($mostViewedThisYear as $key => $value )
                            <div class="item post-37176">
                               <a href="{{ route('movie', ['slug' => $value->slug]) }}" title="{{ $value->title }}">
                                  <div class="item-link">
                                     <img src="{{ asset('uploads/movie/'.$value->image)}}" style="object-fit: cover" class="lazy post-thumb" alt="{{ $value->title }}" title="{{ $value->title }}" />
                                    
                                     <span class="is_trailer">  
                                       @if ($value->quality === 4)
                                      Trailer
                                    @else
                                    {{ $value->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                                    @endif 
                                  </span>
                                  </div>
                                  <p class="title">{{ $value->title }}</p>
                               </a>
                              <div class="viewsCount" style="color: #9d9d9d;">{{ $value ->title_en }}</div>
                               <div style="float: left;">
                                  <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                  <span style="width: 0%"></span>
                                  </span>
                               </div>
                            </div>    
                            @endforeach
                            
                          </div>
                 
                </div>
               </div>
          </div>
          <div class="clearfix"></div>
       </div>
       <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
         <div class="section-bar clearfix" style="display: flex;flex-direction:column">
            <div class="section-title dashed">
               <span>Phim sắp ra mắt</span>
   
              </div>
              <section class="tab-content">
               <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                  <div class="halim-ajax-popular-post-loading hidden"></div>
                  <div id="halim-ajax-popular-post" class="popular-post">
   
                     @foreach ($coming_soon_movie as $key => $value )
                     <div class="item post-37176">
                        <a href="{{ route('movie', ['slug' => $value->slug]) }}" title="{{ $value->title }}">
                           <div class="item-link">
                              <img src="{{ asset('uploads/movie/'.$value->image)}}" style="object-fit: cover" class="lazy post-thumb" alt="{{ $value->title }}" title="{{ $value->title }}" />
                             
                              <span class="is_trailer">  
                                @if ($value->quality === 4)
                               Trailer
                             @else
                             {{ $value->phu_de === 0 ? 'Vietsub' : 'Thuyết Minh' }}                        
                             @endif 
                           </span>
                           </div>
                           <p class="title">{{ $value->title }}</p>
                        </a>
                       <div class="viewsCount" style="color: #9d9d9d;">{{ $value ->title_en }}</div>
                        <div style="float: left;">
                           <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                           <span style="width: 0%"></span>
                           </span>
                        </div>
                     </div>    
                     @endforeach
                  </div>
               </div>
            </section>
   
         </div>
         <div class="clearfix"></div>
      </div>
    </aside>


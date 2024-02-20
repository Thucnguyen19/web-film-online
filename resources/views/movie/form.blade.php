@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col mt-2 mb-2">
    <a href="{{ route('movie.index') }}" class="btn btn-primary ">Liệt kê phim </a>
  </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">{{ __('QUẢN LÝ PHIM') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} --}}
             @if (isset($movie))
               {!! Form::open(['method' => 'PUT','route' =>['movie.update',$movie->id] , 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}
                 
             @else
               {!! Form::open(['method' => 'POST','route' => 'movie.store', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
               @csrf
            @endif
               <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
               {!! Form::label('title', 'Tiêu đề') !!}
               {!! Form::text('title', isset($movie) ? $movie->title : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('title') }}</small>
               </div>
               <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                {!! Form::label('title_en', 'Tiêu đề Tiếng Anh') !!}
                {!! Form::text('title_en', isset($movie) ? $movie->title_en : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('title_en') }}</small>
                </div>
               <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', 'Mô tả') !!}
                {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style'=>'resize:none','class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
                <div class="form-group{{ $errors->has('tag_movie') ? ' has-error' : '' }}">
                  {!! Form::label('tag_movie', 'Tag phim') !!}
                  {!! Form::textarea('tag_movie', isset($movie) ? $movie->tag_movie : '', ['style'=>'resize:none','class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('tag_movie') }}</small>
                </div>                
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                {!! Form::label('status', 'Active') !!}
                {!! Form::select('status', ['0'=>'Không hiển thị','1'=>'Hiển thị'], isset($movie) ? $movie->status  : '', ['id' => 'status', 'class' => 'form-control', 'required' => 'required', ]) !!}
                <small class="text-danger">{{ $errors->first('status') }}</small>
                </div>
                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    {!! Form::label('category_id', 'Danh sách') !!}
                    {!! Form::select('category_id',$category, isset($movie) ? $movie->category_id  : '', ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required', ]) !!}
                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                    </div>
                {{-- <div class="form-group{{ $errors->has('genre_id') ? ' has-error' : '' }}">
                {!! Form::label('genre_id', 'Thể loại') !!}
                {!! Form::select('genre_id',$genre, isset($movie) ? $movie->genre_id  : '', ['id' => 'genre_id', 'class' => 'form-control', 'required' => 'required', ]) !!}
                <small class="text-danger">{{ $errors->first('genre_id') }}</small>
                </div> --}}
                <div class="form-group">
                <div class="checkbox{{ $errors->has('genre_id') ? ' has-error' : '' }}">
                  Thể loại:<br/>
                  @foreach ($list_genre as $value )
                  <label for="genre[]">
                    @if (isset($movie))
                    {!! Form::checkbox('genre[]', $value->id, isset($movie_genre) && $movie_genre->contains($value->id) ? true : false , ['id' => 'genre_id']) !!} 
                    {{-- Kiểm tra xem đối số trong contains($agument) có khớp với collections movie_genre  --}}
                    @else
                    {{-- {!! Form::checkbox('genre[]',$value->id, ['id' => 'genre_id']) !!}  auto tick for all checkbox after page reload--}}
                    {!! Form::checkbox('genre[]', $value->id, false, ['id' => 'genre_id']) !!}
                    @endif
                  </label> {{ $value ->title }}                   
                  @endforeach
                </div>
                <small class="text-danger">{{ $errors->first('genre_id') }}</small>
                </div>
                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                    {!! Form::label('country_id', 'Quốc gia') !!}
                    {!! Form::select('country_id',$country, isset($movie) ? $movie->country_id  : '', ['id' => 'country_id', 'class' => 'form-control', 'required' => 'required', ]) !!}
                    <small class="text-danger">{{ $errors->first('country_id') }}</small>
                 </div>
                 <div class="form-group{{ $errors->has('phim_hot') ? ' has-error' : '' }}">
                  {!! Form::label('phim_hot', 'Phim hot') !!}
                  {!! Form::select('phim_hot', [ '1'=>'Có','0'=>'Không'], isset($movie) ? $movie->phim_hot  : '', ['id' => 'phim_hot', 'class' => 'form-control', 'required' => 'required', ]) !!}
                  <small class="text-danger">{{ $errors->first('phim_hot') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('quality') ? ' has-error' : '' }}">
                    {!! Form::label('quality', 'Chất lượng Video') !!}
                    {!! Form::select('quality', [ '0'=>'Cam','1'=>'HD','2'=>'Full HD','3'=>'2K','4'=>'Trailer'], isset($movie) ? $movie->quality  : '', ['id' => 'quality', 'class' => 'form-control', 'required' => 'required', ]) !!}
                    <small class="text-danger">{{ $errors->first('quality') }}</small>
                  </div>
                    <div class="form-group{{ $errors->has('phu_de') ? ' has-error' : '' }}">
                      {!! Form::label('phu_de', 'Phụ đề') !!}
                      {!! Form::select('phu_de', ['0'=>'Vietsub','1'=>'Thuyết minh'], isset($movie) ? $movie->phu_de  : '', ['id' => 'phu_de', 'class' => 'form-control', 'required' => 'required', ]) !!}
                      <small class="text-danger">{{ $errors->first('phu_de') }}</small>
                    </div>
                      <div class="form-group">
                        {!! Form::label('all_episode', 'Số Tập') !!}
                        {!! Form::text('all_episode', isset($movie) ? $movie->all_episode : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu']) !!}
                      </div>
                      <div class="form-group{{ $errors->has('time_movie') ? ' has-error' : '' }}">
                        {!! Form::label('time_movie', 'Thời lượng phim') !!}
                        {!! Form::text('time_movie', isset($movie) ? $movie->time_movie : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('time_movie') }}</small>
                        </div>
                        <div class="form-group">
                          {!! Form::label('trailer', 'Trailer') !!}
                          {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu']) !!}
                        </div>
                          <div class="form-group{{ $errors->has('director') ? ' has-error' : '' }}">
                            {!! Form::label('director', 'Đạo diễn') !!}
                            {!! Form::text('director', isset($movie) ? $movie->director : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('director') }}</small>
                          </div>
                          <div class="form-group{{ $errors->has('actor') ? ' has-error' : '' }}">
                            {!! Form::label('actor', 'Diễn viên') !!}
                            {!! Form::textarea('actor', isset($movie) ? $movie->actor : '', ['style'=>'resize:none','class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('actor') }}</small>
                          </div>     
                 <br/>
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                {!! Form::label('image', 'Ảnh') !!}
                {!! Form::file('image', ['required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('image') }}</small>
                
              </div>
             @if (isset($movie))
               <img src="{{ asset('uploads/movie/'.$movie->image)}}" width="100px" height="100px" style="object-fit:cover;margin :10px 0" alt="{{ $movie->title }}">
            
             @endif
                
            <br/>
            @if (isset($movie))
            {!! Form::submit('Update', ['class' => 'btn btn-info pull-right']) !!}
                
            @else
            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-info pull-right']) !!}
                
            @endif
               {!! Form::close() !!}
               {{-- phải cài gói laravel collective --}}
                </div>
            </div>
        </div>
    </div>
</div>




   
@endsection

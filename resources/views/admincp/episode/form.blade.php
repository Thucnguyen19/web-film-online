@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col mt-2 mb-2">
    <a href="{{ route('episode.index') }}" class="btn btn-primary ">Liệt kê tập phim </a>
  </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">{{ __('QUẢN LÝ TẬP PHIM') }}</div>

                <div class="card-body">
             @if (isset($episode))
               {!! Form::open(['method' => 'PUT','route' =>['episode.update',$episode->id] , 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}
                 
             @else
               {!! Form::open(['method' => 'POST','route' => 'episode.store', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
               @csrf
            @endif
            <div class="form-group{{ $errors->has('link_film') ? ' has-error' : '' }}">
                {!! Form::label('link_film', 'Link Phim') !!}
                {!! Form::text('link_film', isset($episode) ? $episode->link_film : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('link_film') }}</small>
            </div>
                 <div class="form-group{{ $errors->has('movie_id') ? ' has-error' : '' }}">
                  {!! Form::label('movie_id', 'Tên Phim') !!}
                  {!! Form::select('movie_id',$list_movie, isset($episode) ? $episode->movie_id  : '', ['id' => 'movie_id', 'class' => 'form-control select-movie', 'required' => 'required', ]) !!}
                  <small class="text-danger">{{ $errors->first('movie_id') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('episode') ? ' has-error' : '' }}">
                    {!! Form::label('episode', 'Tập Phim') !!}
                    {!! Form::text('episode', isset($episode) ? $episode->episode : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('episode') }}</small>
                </div>     
            <br/>
            @if (isset($episode))
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

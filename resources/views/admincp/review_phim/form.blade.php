@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col mt-2 mb-2">
    <a href="{{ route('reviewphim.index') }}" class="btn btn-primary ">Liệt kê các phim review </a>
  </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">{{ __('QUẢN LÝ  REVIEW PHIM') }}</div>

                <div class="card-body">
             @if (isset($reviewphim))
               {!! Form::open(['method' => 'PUT','route' =>['reviewphim.update',$reviewphim->id] , 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}
             @else
               {!! Form::open(['method' => 'POST','route' => 'reviewphim.store', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
               @csrf
            @endif
               <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
               {!! Form::label('title', 'Tiêu đề') !!}
               {!! Form::text('title', isset($reviewphim) ? $reviewphim->title : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('title') }}</small>
               </div>
               <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', 'Mô tả') !!}
                {!! Form::text('description', isset($reviewphim) ? $reviewphim->description : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
                <div class="form-group{{ $errors->has('link_phim') ? ' has-error' : '' }}">
                    {!! Form::label('link_phim', 'Link_phim 1') !!}
                    {!! Form::text('link_phim', isset($reviewphim) ? $reviewphim->link_phim : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('link_phim') }}</small>
                </div>
                <div class="form-group">
                    {!! Form::label('link_other', 'Link Phụ') !!}
                    {!! Form::text('link_other', isset($reviewphim) ? $reviewphim->link_other : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                    
                </div>
                <div class="form-group">
                    {!! Form::label('key_word', 'Từ Khóa') !!}
                    {!! Form::text('key_word', isset($reviewphim) ? $reviewphim->key_word : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                   
                </div>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    {!! Form::label('status', 'Active') !!}
                    {!! Form::select('status', ['0'=>'Không hiển thị','1'=>'Hiển thị'], isset($reviewphim) ? $reviewphim->status  : '', ['id' => 'status', 'class' => 'form-control', 'required' => 'required', ]) !!}
                    <small class="text-danger">{{ $errors->first('status') }}</small>
                    </div>
                 <br/>
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                {!! Form::label('image', 'Ảnh') !!}
                {!! Form::file('image', ['required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('image') }}</small>
              </div>
             @if (isset($reviewphim))
               <img src="{{ asset('uploads/reviewphim/'.$reviewphim->image)}}" width="100px" height="100px" style="object-fit:cover;margin :10px 0" alt="{{ $reviewphim->title }}">
            
             @endif
                
            <br/>
            @if (isset($reviewphim))
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

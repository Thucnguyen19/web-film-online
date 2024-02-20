@extends('layouts.app')

@section('content')
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('QUẢN LÝ QUỐC GIA') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} --}}
             @if (isset($country))
               {!! Form::open(['method' => 'PUT','route' =>['country.update',$country->id] , 'class' => 'form-horizontal']) !!}
                 
             @else
               {!! Form::open(['method' => 'POST','route' => 'country.store', 'class' => 'form-horizontal']) !!}
            @endif
               <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
               {!! Form::label('title', 'Tiêu đề') !!}
               {!! Form::text('title', isset($country) ? $country->title : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('inputname') }}</small>
               </div>
               <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', 'Mô tả') !!}
                {!! Form::text('description', isset($country) ? $country->description : '', ['class' => 'form-control','placeholder'=>'Nhập vào dữ liệu','required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                {!! Form::label('status', 'Active') !!}
                {!! Form::select('status', ['0'=>'Không hiển thị','1'=>'Hiển thị'], isset($country) ? $country->status  : '', ['id' => 'status', 'class' => 'form-control', 'required' => 'required', ]) !!}
                <small class="text-danger">{{ $errors->first('status') }}</small>
                </div>
            <br/>
            @if (isset($country))
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

<div class="container mt-4">
    <div class="mt-4">
        <h3 class=" text-center text-bold">DANH SÁCH DANH MỤC</h3>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">TÊN QUỐC GIA</th>
            <th scope="col">MÔ TẢ</th>
            <th scope="col">ACTIVE/INACTIVE</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $value)
            <tr>
              <th scope="row">{{ $value->id }}</th>
              <td>{{ $value->title }}</td>
              <td>{{ $value->description }}</td>
              <td>{{ $value->status === 1 ? 'Hiển thị' : 'Không hiển thị'}}</td>
              <td>
               <a href="{{ route('country.edit',$value->id) }}" class="btn btn-warning">SỬA</a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['country.destroy',$value->id],'onsubmit'=>'return confirm(" Bạn chắc chắn muốn xóa mục này chứ ?")','class' => 'form-horizontal']) !!}
            
                <div class="btn-group pull-right">
                {!! Form::submit('XÓA', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
              </td>
            </tr>                
            @endforeach
         
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
          {{ $list->links('pagination::bootstrap-4') }}

      </div>
</div>

@endsection

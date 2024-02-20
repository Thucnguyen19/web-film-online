@extends('layouts.app')

@section('content')



<div class="container ">
    <div class="col mb-2 mt-2">
        <a href="{{ route('reviewphim.create') }} " class="btn btn-primary">Thêm Phim Mới</a>
    </div>
    <table class="table table-responsive" id="tablereviewphim">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">TÊN PHIM REVIEW</th>
            <th scope="col">MÔ TẢ</th>
            <th scope="col">LINK PHIM 1</th>
            <th scope="col">LINK PHỤ</th>
            <th scope="col">TỪ KHÓA</th>
            <th scope="col">ẢNH</th>
            <th scope="col">HIỂN THỊ</th>
            <th scope="col">VIEW</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $value)
            <tr>
              <th scope="row">{{ $value->id }}</th>
              <td>{{ $value->title }}</td>
              <td>{{ $value->description }}</td>
              <td>{{ $value->link_phim }}</td>
              <td>{{ $value->link_other }}</td>
              <td>{{ $value->key_word }}</td> 
              <td> <img src="{{ asset('uploads/reviewphim/'.$value->image)}}" width="40px" height="40px" style="object-fit:cover" alt="{{ $value->title }}"> </td>
              <td>{{ $value->status === 1 ? 'Hiển thị' : 'Không hiển thị'}}</td>
              <td>{{ $value->view }}</td>
              <td>
               <a href="{{ route('reviewphim.edit',$value->id) }}" class="btn btn-warning">SỬA</a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['reviewphim.destroy',$value->id],'onsubmit'=>'return confirm(" Bạn chắc chắn muốn xóa mục này chứ ?")','class' => 'form-horizontal']) !!}
                <div class="btn-group pull-right">
                {!! Form::submit('XÓA', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
              </td>
            </tr>                
            @endforeach
         
        </tbody>
      </table>
      {{-- <div class="d-flex justify-content-center">
          {{ $list->links('pagination::bootstrap-4') }}

      </div> --}}
</div>


    <script>
       $(document).ready( function () {
    $('#tablereviewphim').DataTable();
} );
    </script>
@endsection

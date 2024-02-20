@extends('layouts.app')

@section('content')



<div class="container ">
    <div class="col mb-2 mt-2">
        <a href="{{ route('episode.create') }} " class="btn btn-primary">Thêm Tập Phim Mới</a>
    </div>
    <table class="table table-responsive" id="tableMovie">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">TÊN PHIM</th>
            <th scope="col">HÌNH ẢNH</th>
            <th scope="col">LINK PHIM</th>
            <th scope="col">TẬP PHIM</th>
            <th scope="col">ACTIVE</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($list_episode as $key => $value)
            <tr>
              <th scope="row">{{ $value->id }}</th>
              <td>{{ $value->movie->title }}</td>
              <td><img src="{{ asset('uploads/movie/'.$value->movie->image)}}" width="200px" height="200px" style="object-fit:cover" alt="{{ $value->movie->image }}"> </td>
              <td>{!! $value->link_film !!}</td>
              <td>{{ $value->episode }}</td>
              <td>
                <a href="{{ route('episode.edit',$value->id) }}" class="btn btn-warning">SỬA</a>
                 {!! Form::open(['method' => 'DELETE', 'route' => ['episode.destroy',$value->id],'onsubmit'=>'return confirm(" Bạn chắc chắn muốn xóa mục này chứ ?")','class' => 'form-horizontal']) !!}
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
          {{ $list_episode->links('pagination::bootstrap-4') }}

      </div>
</div>


    <script>
       $(document).ready( function () {
    $('#tableMovie').DataTable();
} );
    </script>
@endsection

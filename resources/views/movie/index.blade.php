@extends('layouts.app')

@section('content')



<div class="container ">
    <div class="col mb-2 mt-2">
        <a href="{{ route('movie.create') }} " class="btn btn-primary">Thêm Phim Mới</a>
    </div>
    <table class="table table-responsive" id="tableMovie">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">TÊN PHIM</th>
            <th scope="col">TITLE EN</th>
            <th scope="col">NĂM PHIM</th>
            <th scope="col">MÙA PHIM</th>
            <th scope="col">TRAILER</th>
            <th scope="col">DANH MỤC</th>
            <th scope="col">THỂ LOẠI</th>
            <th scope="col">QUỐC GIA </th>
            <th scope="col">HÌNH ẢNH</th>
            <th scope="col">PHIM HOT</th>
            <th scope="col">CHẤT LƯỢNG VIDEO</th>
            <th scope="col">PHỤ ĐỀ</th>
            <th scope="col">ACTIVE/INACTIVE</th>
            <th scope="col">THỜI LƯỢNG</th>
            <th scope="col">SLUG</th>
            <th scope="col">TAGS</th>
            <th scope="col">ĐẠO DIỄN</th>
            <th scope="col">DIỄN VIÊN</th>
            <th scope="col">VIEW</th>
            <th scope="col">SỐ TẬP</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $value)
            {{-- @php
              dd($value->category->title);
              dd($value->country->title);
              dd($value->genre->id);
            @endphp --}}
            <tr>
              <th scope="row">{{ $value->id }}</th>
              <td>{{ $value->title }}</td>
              <td>{{ $value->title_en }}</td>
              <td>
                <div class="form-group{{ $errors->has('year_movie') ? ' has-error' : '' }}">
                {!! Form::label('year_movie', 'Year') !!}
                {!! Form::selectYear('year_movie', date('1980'), date('2023') + 10,  isset($value->year_movie) ? $value->year_movie : '' ,['id'=> $value->id,'class' => 'select-year form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('year_movie') }}</small>
                </div>
              </td>
              <td>

                <div class="form-group">
                {!! Form::label('season', 'Season') !!}
                {!! Form::selectRange('season', 0, 30, isset($value->season) ? $value->season : '' , ['class' => 'select-season form-control','id'=> $value->id]) !!}
              
                </div>
              </td>
              <td>{{ $value->trailer }}</td>
              <td>{{ $value->category->title }}</td>
              {{-- <td>{{ $value->genre->title }}</td> --}}
              {{-- {{ dd($value->movie_genre) }} --}}
              <td>
              @foreach ($value->genres as $genreItem )
               <div class="btn btn-primary">
                 {{ $genreItem->title}}                
              </div> 
              @endforeach  
              </td>
              <td>{{ $value->country->title }}</td>
              <td> <img src="{{ asset('uploads/movie/'.$value->image)}}" width="40px" height="40px" style="object-fit:cover" alt="{{ $value->title }}"> </td>
              <td>{{ $value->phim_hot === 1 ? 'Có' : 'Không'}}</td>
              <td>
            @switch($value->quality)
                @case(0)
                CAM
                  @break
                  @case(1)
                  HD
                    @break
                    @case(2)
                    FULL HD
                      @break
                      @case(3)
                      2K
                        @break
                        @case(4)
                        Trailer
                          @break 
                          @default
                           Unknown Quality
              @endswitch
            </td>
            <td>{{ $value->phu_de === 1 ? 'Thuyết minh' : 'Vietsub'}}</td>
              <td>{{ $value->status === 1 ? 'Hiển thị' : 'Không hiển thị'}}</td>
              <td>{{ $value->time_movie }}</td>
              <td>{{ $value->slug }}</td>
              <td>{{ $value->tag_movie }}</td>
              <td>{{ $value->director }}</td>
              <td>{{ $value->actor }}</td>
              <td>{{ $value->view }}</td>
              @if ($value->quality === 4)
              <td>Trailer</td>
              @elseif ($value->category_id === 10)
              <td>{{ $value->episode_count.'/'.'1' }}</td>
              @else
              <td>{{ $value->episode_count.'/'.$value->all_episode }}</td>
              @endif
              <td>
               <a href="{{ route('movie.edit',$value->id) }}" class="btn btn-warning">SỬA</a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['movie.destroy',$value->id],'onsubmit'=>'return confirm(" Bạn chắc chắn muốn xóa mục này chứ ?")','class' => 'form-horizontal']) !!}
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
    $('#tableMovie').DataTable();
} );
    </script>
@endsection

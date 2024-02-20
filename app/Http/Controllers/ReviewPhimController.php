<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewPhim;
use Str;

class ReviewPhimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = ReviewPhim::all();
        // $path  =public_path()."/json/";
        // if(!is_dir($path)){
        //     mkdir($path,0777,true);
        // }
        // File::put($path.'reviewphims.json',json_encode($list));
        //Nếu chưa tồn tại file có $path thì sẽ tạo folder theo đường dẫn của path và tạo một file json
        return view('admincp.review_phim.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.review_phim.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $data = $request->all();
        $reviewphim = new ReviewPhim();
        $reviewphim -> title = $data['title'];
        $reviewphim -> description = $data['description'];
        $reviewphim -> link_phim = $data['link_phim'];
        $reviewphim -> link_other = $data['link_other'];
        $reviewphim -> key_word = $data['key_word'];
        $reviewphim -> status = $data['status'];
        $reviewphim->slug = Str::slug($data['title']);
        $reviewphim->view = 0;
        //Add Image
        $get_image = $request->file('image');
        $path ='uploads/reviewphim/';
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $reviewphim->image = $new_image;
        }
        
        // $data['slug'] = Str::slug($data['title']);
        // $reviewphim =reviewphim::create($data);
        $reviewphim ->save($data);//phương thức này dùng cho câu lệnh insert, into nên các trường created_at và updated_at sẽ ko tự động thêm dữ liệu
      
        return redirect()->route('reviewphim.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reviewphim = ReviewPhim::find($id);
        return view('admincp.review_phim.form',compact('reviewphim'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $reviewphim =  ReviewPhim::find($id);
        $reviewphim -> title = $data['title'];
        $reviewphim -> description = $data['description'];
        $reviewphim -> link_phim = $data['link_phim'];
        $reviewphim -> link_other = $data['link_other'];
        $reviewphim -> key_word = $data['key_word'];
        $reviewphim -> status = $data['status'];
        $reviewphim->slug = Str::slug($data['title']);
        $reviewphim->view = 0;
        //Add Image
        $get_image = $request->file('image');
        $path ='uploads/reviewphim/';
        if($get_image){
            if(!empty($reviewphim->image) && file_exists('uploads/reviewphim/'.$reviewphim->image)){
                unlink('uploads/reviewphim/'.$reviewphim->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $data['image'] = $new_image;
        }
        
        // $data['slug'] = Str::slug($data['title']);
        // $reviewphim =reviewphim::create($data);
        $reviewphim ->update($data);//phương thức này dùng cho câu lệnh insert, into nên các trường created_at và updated_at sẽ ko tự động thêm dữ liệu
      
        return redirect()->route('reviewphim.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reviewphim = ReviewPhim::find($id);
        if(!empty($reviewphim->image) && file_exists('uploads/reviewphim/'.$reviewphim->image)){
            unlink('uploads/reviewphim/'.$reviewphim->image);
        }
       
        $reviewphim->delete();
        return redirect()->back();
    }
}

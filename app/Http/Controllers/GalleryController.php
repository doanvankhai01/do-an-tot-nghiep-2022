<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;
use App\Models\GalleryModel;
use Session ;
session_start();
class GalleryController extends Controller
{
    //Kiểm tra đăng nhập
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            Session::put('message','Vui lòng đăng nhập quyền Admin!');
            return Redirect::to('admin')->send();
        }
    }
    //Hiển thị tất cả hình ảnh thuộc sản phẩm và form thêm hình ảnh
    public function manager_gallery($product_id){
        $pro_id = $product_id;
        return view('gallery.add_gallery')->with(compact('pro_id'));
    }
    //Lấy tất cả hình ảnh
    public function all_gallery(Request $request){
        $product_id = $request->pro_id;//lấy id sản phẩm
        $url = $request->url;//lấy đường dẫn
        $gallery = GalleryModel::where("product_id",$product_id)->get();//lấy tất cả gallery với id sản phẩm cần xem
        $gallery_count = $gallery->count();//Đếm số phẩn từ trong mảng
       
        $output='
        <table class="tbl-function-infomation">
            
                <tr>
                    <th class="th-infomation-title" style="width:5%;">STT</th>
                    <th class="th-infomation-title" style="width:25%;">Tên hình ảnh phụ</th>
                    <th class="th-infomation-title" style="width:25%;">Đường dẫn</th>
                    <th class="th-infomation-title" style="width:35%;">Hình ảnh</th>
                    <th class="th-infomation-title" style="width:10%;">Quản lý</th>
                </tr>
    
       ';
        if($gallery_count>0){//Nếu mảng lớn hơn 0
            $i= 0;
            foreach($gallery as $key => $galley){//Truy xuất toàn bộ dữ liệu có trong mảng
                $i++;
                $output.='
                    <tr>
                        <td class="td-infomation-title" id="'.$galley->gallery_id.'">'.$i.'</td>
                        <td class="td-infomation-title edit_gallery_name" id="gallery_name'.$galley->gallery_id.'" data-gallery_name="'.$galley->gallery_id.'" contenteditable>'.$galley->gallery_name.'</td>
                        <td class="td-infomation-title" id="gallery_slug'.$galley->gallery_id.'">'.$galley->gallery_slug.'</td>
                        <td class="td-infomation-title">
                            <form enctype="multipart/form-data">
                                '.csrf_field().'
                                <img src="'.url('public/uploads/gallery/'.$galley->gallery_image).'" style="width:100px; height:100px;">
                                <input type="file" class="btn-function-infomation update_gallery" data-gal_id="'.$galley->gallery_id.'" id="file-'.$galley->gallery_id.'" name="file" accept="image/*" />
                            </form>
                        </td>
                        <td class="td-infomation-title">
                        <a href="#" class="edit-delete-function delete_gallery" data-gal_id="'.$galley->gallery_id.'">
                            <i class="material-icons text-danger">delete_forever</i>
                            Xóa
                        </a>
                        </td>
                    </tr>
                ';
            }
        $output.=' 
        </table>';
        echo $output;
        }else{//ngược lại
            echo '<p class="p-title">Không có dữ liệu</p>';
        }
       
    }
    //Thêm hình ảnh 
    public function add_gallery(Request $request, $product_id){
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName();//lấy cả tên và đuôi file
                $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
                $new_image =$name_image.rand(0,999999).'.'.$image->getClientOriginalExtension();//Nối thêm đuôi số
                $image->move('public/uploads/gallery',$new_image);//Chuyển ảnh đến thư mục gallery
                
                $i = rand(0,999);
                $gallery = new GalleryModel();
                $gallery->gallery_name = "Hình-".$i;
                $gallery->gallery_slug = "hinh-".$i;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $product_id;
                $gallery->save();
            }
            Session::put('message','swal("Thêm thành công!", "Thêm thư viện ảnh thành công!","success")');
            return redirect()->back();
        }else{
            Session::put('message','swal("Thêm thất bại!", "Thêm thư viện không thành công!","error")');
            return redirect()->back();
        }

    }
    // Cập nhật tên hình ảnh
    public function update_name_gallery(Request $request){
        $data = $request->all();
        // $gallery = GalleryModel::where('gallery_id',$data['gallery_id'])->first();
        $gallery = GalleryModel::find($data['gallery_id']);
        $gallery->gallery_name = $data['gallery_name'];
        $gallery->gallery_slug = $data['gallery_slug'];
        $gallery->save();
    }
    //Cập nhật hình ảnh
    public function update_image_gallery(Request $request){
        $get_image = $request->file('file');
        $gallery_id = $request->gallery_id;
        if($get_image){
            $gallery = GalleryModel::find($gallery_id);
            $check = 'public/uploads/gallery/'.$gallery->gallery_image;
            if(File::exists($check)){//kiểm tra xem file có tồn tại không
                unlink('public/uploads/gallery/'.$gallery->gallery_image);//xóa hình ảnh khỏi thư mục chứa ảnh
                
                $get_name_image = $get_image->getClientOriginalName();//lấy cả tên và đuôi file
                $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
                $new_image =$name_image.rand(0,999999).'.'.$get_image->getClientOriginalExtension();//Nối thêm đuôi số
                $get_image->move('public/uploads/gallery',$new_image);//Chuyển ảnh đến thư mục gallery
                
                $gallery->gallery_image = $new_image;
                $gallery->save();
            }else{
                $get_name_image = $get_image->getClientOriginalName();//lấy cả tên và đuôi file
                $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
                $new_image =$name_image.rand(0,999999).'.'.$get_image->getClientOriginalExtension();//Nối thêm đuôi số
                $get_image->move('public/uploads/gallery',$new_image);//Chuyển ảnh đến thư mục gallery
                
                $gallery->gallery_image = $new_image;
                $gallery->save();
            }
        }else{
            Session::put('message','swal("Thêm thất bại!", "Không có hình ảnh!","error")');
        }
    }
    //Xóa sản phẩm
    public function delete_gallery(Request $request){
        $data = $request->all();
        // $gallery = GalleryModel::where('gallery_id',$data['gallery_id'])->first();
        $gallery = GalleryModel::find($data['gallery_id']);
        $check = 'public/uploads/gallery/'.$gallery->gallery_image;
        if(File::exists($check)){//kiểm tra xem file có tồn tại không
            unlink('public/uploads/gallery/'.$gallery->gallery_image);//xóa hình ảnh khỏi thư mục chứa ảnh
            $gallery->delete();
        }else{
            $gallery->delete();
        }
       
    }
}

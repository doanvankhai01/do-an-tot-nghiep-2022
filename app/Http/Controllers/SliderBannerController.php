<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use Session ;
use Auth;
use App\Models\SliderBannerModel;
session_start();
class SliderBannerController extends Controller
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
    //Kiểm tra đăng nhập Auth
    public function AuthLogin_Auth(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            Session::put('message','Vui lòng đăng nhập quyền admin!');
            return Redirect::to('login-auth')->send();
        }
    }
    //Hiển thị danh sách
    public function manager_slider(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
    	$all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('waste_basket_slider',0)->paginate(10);
    	return view('slider.all_slider')
        ->with(compact('all_slider'))
        ->with('i',(request()->input('page',1)-1)*10);;
         //Cho i là số thứ tự khi phân trang
        //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
        //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
        //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
        //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 
    }
    // Hiện trang thêm
    public function add_slider(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
    	return view('slider.add_slider');
    }
    //Ẩn
    public function unactive_slider($slider_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        SliderBannerModel::where('slider_id',$slider_id)->update(['slider_status'=>1]);
        Session::put('message','swal("Thông báo!", "Ẩn Slider!","success")');
        return Redirect::to('manager-slider');

    }
    //Kích hoạt
    public function active_slider($slider_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        SliderBannerModel::where('slider_id',$slider_id)->update(['slider_status'=>0]);
        Session::put('message','swal("Thông báo!", "Kích hoạt Slider!","success")');
        return Redirect::to('manager-slider');

    }
    //Lưu
    public function save_slider(Request $request){
    	
    	// $this->AuthLogin();
        $this->AuthLogin_Auth();
   		$data = $request->all();
       	$get_image = request('slider_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider', $new_image);

            $slider = new SliderBannerModel();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_slug = $data['slider_slug'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->waste_basket_slider = 0;
           	$slider->save();
            Session::put('message','swal("Thành công!", "Thêm slider thành công!","success")');
            return Redirect::to('manager-slider');
        }else{
        	Session::put('message','swal("Thất bại!", "Vui lòng thêm hình ảnh !","error")');
    		return Redirect::to('add-slider');
        }
       	
    }
    public function delete_slider($slider_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        // DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        SliderBannerModel::where('slider_id',$slider_id)->delete();
        Session::put('message','swal("Thông báo!", "Xóa thành công!","success")');
        return Redirect::to('all-waste-basket-slider');
    }

    // Thùng rác--------------------------------------------------------------------------------------------------
    // Hiển thị
    public function all_waste_basket_slider(){
        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')->where('waste_basket_slider',1)->paginate(10);
    	return view('slider.waste_basket_slider')
        ->with(compact('all_slider'))
        ->with('i',(request()->input('page',1)-1)*10);;
         //Cho i là số thứ tự khi phân trang
        //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
        //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
        //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
        //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 
    }
    // Xóa tạm thời 
    public function unactive_waste_basket_slider($slider_id){
        $this->AuthLogin();
        SliderBannerModel::where('slider_id',$slider_id)->update(['waste_basket_slider'=>1]);
        Session::put('message','swal("Thông báo!", "Đã chuyển Slider vào thùng rác!","success")');
        return Redirect::to('manager-slider');

    }
    //khôi phục
    public function active_waste_basket_slider($slider_id){
        $this->AuthLogin();
        SliderBannerModel::where('slider_id',$slider_id)->update(['waste_basket_slider'=>0]);
        Session::put('message','swal("Thông báo!", "Đã khôi phục Slider!","success")');
        return Redirect::to('all-waste-basket-slider');

    }
}

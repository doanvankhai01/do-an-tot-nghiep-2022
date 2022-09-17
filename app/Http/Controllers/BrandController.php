<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use Session ;
session_start();
class BrandController extends Controller
{
    //Kiểm tra đăng nhập admin sesion
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            Session::put('message','swal("Cảnh báo!", "Vui lòng đăng nhập!","warning")');
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
    //Kiểm tra quyền hạn
    public function check_position(){
        $admin_status = Session::get('admin_status');
        if($admin_status == 0){
            return true;
        }else{
            // $mesage = Session::put('message','swal("Thông báo!", "Bạn không đủ thẩm quyền để thực hiện chức năng này","info")');
            return false;
        }
    }
    public function check_position_2(){
        $admin_status = Session::get('admin_status');
        if($admin_status == 0 || $admin_status == 1){
            return true;
        }else{
            // $mesage = Session::put('message','swal("Thông báo!", "Bạn không đủ thẩm quyền để thực hiện chức năng này","info")');
            return false;
        }
    }
    //Hiển thị form thêm thương hiệu
    public function add_brand_product(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            return view('brand.add_brand_product');
        }else{
            return redirect()->back()->send();
        }
    }
    //Hiển thị danh sách thương hiệu
    public function all_brand_product(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $all_brand_product = BrandModel::orderBy('brand_id','DESC')
            //->where('waste_basket_brand',0)
            ->paginate(5);
            //Cho i là số thứ tự khi phân trang
            //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
            //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
            //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
            //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 

            

            return view('brand.all_brand_product')
            ->with('i',(request()->input('page',1)-1)*5)
            ->with('all_brand_product',$all_brand_product);
        }else{
            return redirect()->back()->send();
        }
    }
    //Thêm thương hiẹu
    // public function save_brand_product(Request $request){
    //     $this->AuthLogin();
    //     // $data = array();
    //     // $data['brand_name'] = $request->brand_product_name;
    //     // $data['brand_slug'] = $request->brand_product_slug;
    //     // $data['brand_desc'] = $request->brand_product_desc;
    //     // $data['brand_status'] = $request->brand_product_status;
    //     $data = $request->all();
    //     $brand = new BrandModel();
    //     $brand->brand_name = $data['brand_product_name'];
    //     $brand->brand_slug = $data['brand_product_slug'];
    //     $brand->brand_desc = $data['brand_product_desc'];
    //     $brand->brand_status = $data['brand_product_status'];
    //     $brand->save();

    //     // DB::table('tbl_brand_product')->insert($data);
    //     Session::put('message','swal("Thông báo!", "Thêm thương hiệu thành công!","success")');
    //     return Redirect::to('/all-brand-product');

    //     // echo'<pre>';
    //     // print_r($data);
    //     // echo'</pre>';
    // }

    //Thêm thương hiẹu-ajax
    public function save_brand_product(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $data = $request->all();
            $brand = new BrandModel();
            $brand->brand_name = $data['brand_name'];
            $brand->brand_slug = $data['brand_slug'];
            $brand->brand_desc = $data['brand_desc'];
            $brand->brand_status = $data['brand_status'];
            $brand->save();
        }else{
            return redirect()->back()->send();
        }
    }
    //Hiện thương hiệu 
    public function active_brand_product($brand_product_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
            if($check_position == true){
            BrandModel::where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
            Session::put('message','swal("Thông báo!", "kích hoạt!","success")');
            return Redirect::to('all-brand-product');
        }else{
            return redirect()->back()->send();
        }   
    }
    //Ẩn thương hiệu
    public function unactive_brand_product($brand_product_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            BrandModel::where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
            Session::put('message','swal("Thông báo!", "Ẩn!","error")');
            return Redirect::to('all-brand-product');
        }else{
            return redirect()->back()->send();
        }
    }

    //Hiển thị ra thông tin chi tiết
    public function edit_brand_product($brand_product_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $edit_brand_product = BrandModel::where('brand_id',$brand_product_id)->get();
            $manager_brand_product = view('brand.edit_brand_product')
            ->with('edit_brand_product',$edit_brand_product);
            return view('admin.admin_layout')->with('brand.edit_brand_product',$manager_brand_product);
        }else{
            return redirect()->back()->send();
        }
    }
    // Cập nhật Thương hiệu
    // public function update_brand_product(Request $request,$brand_product_id){
    //     $this->AuthLogin();
    //     $data = array();
    //     $data['brand_name'] = $request->brand_product_name;
    //     $data['brand_slug'] = $request->brand_product_slug;
    //     $data['brand_desc'] = $request->brand_product_desc;
    //     BrandModel::where('brand_id',$brand_product_id)->update($data);
    //     Session::put('message','swal("Thành công!", "Cập nhật thương hiệu thành công!","success")');
    //     return Redirect::to('all-brand-product');    
    // }
    // Cập nhật Thương hiệu-ajax
    public function update_brand_product(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $data = $request->all();
            $brand = BrandModel::find($data['brand_id']);
            $brand->brand_name = $data['brand_name'];
            $brand->brand_slug = $data['brand_slug'];
            $brand->brand_desc = $data['brand_desc'];
            $brand->save();
        }else{
            return redirect()->back()->send();
        }
    }
    // Xóa Thương hiệu 
    public function delete_brand_product($brand_product_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            BrandModel::where('brand_id',$brand_product_id)->delete();
            Session::put('message','swal("Thành công", "Đã xóa thương hiệu!","success")');
            return Redirect::to('all-brand-product'); 
        }else{
            return redirect()->back()->send();
        }
    }
}

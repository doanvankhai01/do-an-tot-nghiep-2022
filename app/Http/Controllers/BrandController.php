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
    //Kiểm tra đăng nhập admin
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            Session::put('message','swal("Cảnh báo!", "Vui lòng đăng nhập!","warning")');
            return Redirect::to('admin')->send();
        }
    }
    //Hiển thị form thêm thương hiệu
    public function add_brand_product(){
        $this->AuthLogin();
        return view('brand.add_brand_product');
    }
    //Hiển thị danh sách thương hiệu
    public function all_brand_product(){
        $this->AuthLogin();
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
        $this->AuthLogin();
        $data = $request->all();
        $brand = new BrandModel();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();
    }
    //Hiện thương hiệu 
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        BrandModel::where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','swal("Thông báo!", "kích hoạt!","success")');
        return Redirect::to('all-brand-product');
    }
    //Ẩn thương hiệu
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        BrandModel::where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','swal("Thông báo!", "Ẩn!","error")');
        return Redirect::to('all-brand-product');
    }

    //Hiển thị ra thông tin chi tiết
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        $edit_brand_product = BrandModel::where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('brand.edit_brand_product')
        ->with('edit_brand_product',$edit_brand_product);
        return view('admin.admin_layout')->with('brand.edit_brand_product',$manager_brand_product);
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
        $this->AuthLogin();
        $data = $request->all();
        $brand = BrandModel::find($data['brand_id']);
        $brand->brand_name = $data['brand_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->save();
    }
    // Xóa Thương hiệu 
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        BrandModel::where('brand_id',$brand_product_id)->delete();
        Session::put('message','swal("Thành công", "Đã xóa thương hiệu!","success")');
        return Redirect::to('all-brand-product'); 
    }
}

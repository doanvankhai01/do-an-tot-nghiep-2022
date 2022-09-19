<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use App\Models\CategoryModel;
use Session ;
use Auth;
session_start();
class CategoryController extends Controller
{
    //Kiểm tra đăng nhập session
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
    //Hiện trang thêm danh mục
    public function add_category_product(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            return view('category.add_category_product');
        }else{
            return redirect()->back()->send();
        }
    }
    //Hiển thị danh sách tất cả danh mục
    public function all_category_product(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $all_category_product = CategoryModel::orderBy('category_id','DESC')
            ->where('waste_basket_category',0)->paginate(5);
            
            //Cho i là số thứ tự khi phân trang
            //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
            //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
            //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
            //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 
            return view('category.all_category_product')
            ->with('i',(request()->input('page',1)-1)*5)
            ->with('all_category_product',$all_category_product);
        }else{
            return redirect()->back()->send();
        }
    }
    // //Xử lý thêm danh mục
    // public function save_category_product(Request $request){
    //     $this->AuthLogin();
    //     $data = $request->all();

    //     $category = new CategoryModel();
    //     $category->category_name = $data['category_product_name'];
    //     $category->category_slug = $data['category_product_slug'];
    //     $category->category_desc = $data['category_product_desc'];
    //     $category->category_status = $data['category_product_status'];
    //     $category->waste_basket_category = 0;
    //     $category->save();

    //     // $data['category_name'] = $request->category_product_name;
    //     // $data['category_slug'] = $request->category_product_slug;
    //     // $data['category_desc'] = $request->category_product_desc;
    //     // $data['category_status'] = $request->category_product_status;
    //     // DB::table('tbl_category')->insert($data);
        
    //     Session::put('message','swal("Thêm thành công!", "Thêm danh mục thành công!","success")');
    //     return Redirect::to('/all-category-product');

    //     // echo'<pre>';
    //     // print_r($data);
    //     // echo'</pre>';
    // }
    //Xử lý thêm danh mục - ajax
    public function save_category_product(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $data = $request->all();
            $category = new CategoryModel();
            $category->category_name = $data['category_name'];
            $category->category_slug = $data['category_slug'];
            $category->category_desc = $data['category_desc'];
            $category->category_status = $data['category_status'];
            $category->waste_basket_category = 0;
            $category->save();
        }else{
            return redirect()->back()->send();
        }
    }
    //Hiện danh mục
    public function active_category_product($category_product_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            // DB::table('tbl_category')->where('category_id',$category_product_id)->update(['category_status'=>0]);
            CategoryModel::where('category_id',$category_product_id)->update(['category_status'=>0]);
            Session::put('message','swal("Thông báo!", "Kích hoạt!","success")');
            return Redirect::to('all-category-product');
        }else{
            return redirect()->back()->send();
        }
    }
    //Ẩn danh mục
    public function unactive_category_product($category_product_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            // DB::table('tbl_category')->where('category_id',$category_product_id)->update(['category_status'=>1]);
            CategoryModel::where('category_id',$category_product_id)->update(['category_status'=>1]);
            Session::put('message','swal("Thông báo!", "Ẩn!","success")');
            return Redirect::to('all-category-product');
        }else{
            return redirect()->back()->send();
        }
    }
    //Hiển thị ra thông tin chi tiết
    public function edit_category_product($category_product_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            // $edit_category_product = DB::table('tbl_category')->where('category_id',$category_product_id)->get();
            $edit_category_product = CategoryModel::where('category_id',$category_product_id)->get();
            $manager_category_product = view('category.edit_category_product')->with('edit_category_product',$edit_category_product);
            return view('admin.admin_layout')->with('category.edit_category_product',$manager_category_product);
        }else{
            return redirect()->back()->send();
        }
    }
    // Cập nhật danh mục
    // public function update_category_product(Request $request,$category_product_id){
    //     $this->AuthLogin();
    //     // $data = array();
    //     // $data['category_name'] = $request->category_product_name;
    //     // $data['category_slug'] = $request->category_product_slug;
    //     // $data['category_desc'] = $request->category_product_desc;
    //     // DB::table('tbl_category')->where('category_id',$category_product_id)->update($data);

    //     $data = $request->all();
    //     $category = CategoryModel::find($category_product_id);
    //     $category->category_name = $data['category_product_name'];
    //     $category->category_slug = $data['category_product_slug'];
    //     $category->category_desc = $data['category_product_desc'];
    //     $category->waste_basket_category = 0;
    //     $category->save();
    //     Session::put('message','swal("Thông báo!", "Cập nhật thành công!","success")');
    //     return Redirect::to('all-category-product');    
    // }
    // Cập nhật danh mục-ajax
    public function update_category_product(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $data = $request->all();
            $category = CategoryModel::find($data['category_id']);
            $category->category_name = $data['category_name'];
            $category->category_slug = $data['category_slug'];
            $category->category_desc = $data['category_desc'];
            $category->waste_basket_category = 0;
            $category->save();
        }else{
            return redirect()->back()->send();
        }
    }
    // Xóa danh mục 
    public function delete_category_product($category_product_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            // DB::table('tbl_category')->where('category_id',$category_product_id)->delete();
            CategoryModel::where('category_id',$category_product_id)->delete();
            Session::put('message','swal("Thông báo!", "Xóa thành công!","success")');
            return Redirect::to('all-category-product'); 
        }else{
            return redirect()->back()->send();
        }
    }

    // Thùng rác--------------------------------------------------------------------------------------------------
    // Hiển thị
    public function all_waste_basket_category(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $all_category_product = CategoryModel::orderBy('category_id','DESC')
            ->where('waste_basket_category',1)
            ->paginate(5);
        
            return view('category.waste_basket_category')
            ->with('all_category_product',$all_category_product)
            ->with('i',(request()->input('page',1)-1)*5);
            //Cho i là số thứ tự khi phân trang
            //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
            //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
            //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
            //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10
        }else{
            return redirect()->back()->send();
        }
    }
    // Xóa tạm thời 
    public function unactive_waste_basket_category($category_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            CategoryModel::where('category_id',$category_id)->update(['waste_basket_category'=>1]);
            Session::put('message','swal("Thông báo!", "Đã chuyển danh mục vào thùng rác!","success")');
            return Redirect::to('all-category-product');
        }else{
            return redirect()->back()->send();
        }

    }
    //khôi phục
    public function active_waste_basket_category($category_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            CategoryModel::where('category_id',$category_id)->update(['waste_basket_category'=>0]);
            Session::put('message','swal("Thông báo!", "Đã khôi phục danh mục!","success")');
            return Redirect::to('waste-basket-category');
        }else{
            return redirect()->back()->send();
        }

    }
}

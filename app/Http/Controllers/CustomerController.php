<?php

namespace App\Http\Controllers;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use Session ;

class CustomerController extends Controller
{
    //Kiểm tra đăng nhập Session
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
    //Quản lý ==================================================================================
    //Hiển thị trang thêm admin
    public function add_customer_accounts(){}
    //Lưu và thêm admin
    public function save_customer_accounts(){}
    //Hiển thị danh sách admin
    public function all_customer_account(){
        $all_customer = CustomerModel::orderby('customer_id','desc')
        ->where('waste_basket_customer',0)
        ->paginate(10);

        return view('customer.all_customer')
        ->with('all_customer', $all_customer)
        ->with('i',(request()->input('page',1)-1)*10);
         //Cho i là số thứ tự khi phân trang
        //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
        //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
        //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
        //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 
    }
    //Hiển thị chi tiết thông tin tài khoản
    public function edit_customer_account($customer_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();

        $edit_customer = CustomerModel::where('customer_id',$customer_id)->get();
        return view('customer.edit_customer')->with('edit_customer', $edit_customer);
    }
    //Cập nhật tài khoản admin
    public function update_customer_accounts(){}
    //Xóa tài khoản admin
    public function delete_customer_accounts(){}
}

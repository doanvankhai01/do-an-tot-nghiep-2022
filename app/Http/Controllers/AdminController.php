<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\AdminModel;
use Session ;
session_start();
class AdminController extends Controller
{
    //Kiểm tra đăng nhập
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            Session::put('message','Vui lòng đăng nhập quyền admin!');
            return Redirect::to('admin')->send();
        }
    }
    //Hiển thị trang đăng nhập
    public function index(){
        return view('admin_login.admin_login');
    }
    //Hiển thị trang quản lí
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');// Muốn hiển thị dashboard thì cần gọi dashboard, gọi admin_layout thì sẽ không thể hiển thị được dashboard ra 
    }
    //Xử lí đăng nhập
    public function dashboard(Request $request){
        $email = $request->email;//gắn biến email với biến admin_email tại form action <admin_login class="blade php"></admin_login>
        $password = md5($request->password);
        $result = DB::table('tbl_admin')->where('admin_email',$email)->where('admin_password',$password)->first();
        if($result){
            // echo'<pre>';
            // print_r($result);
            // echo'</pre>';
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id',$result->admin_id);
            Session::put('message','swal("Đăng nhập thành công!", "Chuyển tới trang quản lý","success")');
            return Redirect::to('dashboard');
        }else{
            // Session::put('message','login_admin_error();');
            // Session::put('message','Vui lòng đăng nhập lại!');
            Session::put('message','swal("Đăng nhập thất bại!", "Vui lòng kiểm tra lại tài khoản và mật khẩu đăng nhập!","error")');
            return redirect()->back()->send();
        }
        
        //return view('admin.dashboard');
    }
    //Đăng xuất
    public function log_out(){
        // Session::put('admin_name',null);
        // Session::put('admin_id',null);
        Session::forget('admin_name');
        Session::forget('admin_id');
        Session::put('message','swal("Đăng xuất thành công!", "Chuyển tới trang đăng nhập","warning")');
        return Redirect::to('admin');
    }

    //Quản lý ==================================================================================
    //Hiển thị trang thêm admin
    public function add_admin(){
        return view('admin.add_admin');
    }
    //Lưu và thêm admin
    public function save_admin(){}
    //Hiển thị danh sách admin
    public function all_admin(){
        $all_admin = AdminModel::orderby('admin_status','asc')
        ->where('waste_basket_admin',0)
        ->paginate(10);

        return view('admin.all_admin')
        ->with('all_admin', $all_admin)
        ->with('i',(request()->input('page',1)-1)*10);
         //Cho i là số thứ tự khi phân trang
        //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
        //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
        //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
        //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 
    }
    //Hiển thị chi tiết thông tin tài khoản
    public function edit_admin(){}
    //Cập nhật tài khoản admin
    public function update_admin(){}
    //Xóa tài khoản admin
    public function delete_admin(){}

    
}
?>

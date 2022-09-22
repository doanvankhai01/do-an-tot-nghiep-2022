<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\AdminModel;
use App\Models\RolesModel;
use Auth;
use Session ;
class AuthController extends Controller
{
    // Các file bị chỉnh sửa
        // config/auth.php
        // Hàm validateCredentials() tại file có đường dẫn vendor/laravel/framework/src/Illuminate/Auth/EloquentUserProvider.php
    // Validation
    public function validation_register_auth($request){
        return $this->validate($request,[
            'admin_email' => 'required|email|max:255',
            'admin_password' =>'required|string|max:255|min:6',
            'admin_name' => 'required|string|max:255|min:3',
            'admin_birdthday' => 'required|string|max:255',
            'admin_address' => 'required|string|max:255|min:3',
            'admin_phone' => 'required|string|max:255|min:10',
            
        ]);
    }
    public function validation_login_auth($request){
        return $this->validate($request,[
            'admin_email' => 'required|email|max:255',
            'admin_password' =>'required|string|max:255|min:6',
            
        ]);
    }
    //end validtion
    //Hiển thị giao diện login auth
    public function register_auth(){
        return view('customer_auth.register');
    }
    public function register(Request $request){
        $this->validation_register_auth($request);
        $data = $request->all();
        
        $admin = new AdminModel();
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = $data['admin_password'];
        $admin->admin_name = $data['admin_name'];
        $admin->admin_slug = $data['admin_slug'];
        $admin->admin_birdthday = $data['admin_birdthday'];
        $admin->admin_address = $data['admin_address'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_status = $data['admin_status'];
        $admin->waste_basket_admin = 0;
        $get_image  = $request->file('admin_image');
        // Session::put('message',$get_image);
        // return redirect()->back();
        $path_image_product = 'public/uploads/admin';
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();//lấy cả tên và đuôi file
            $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
            $new_image =$name_image.rand(0,999999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path_image_product,$new_image);
            // $data['product_image'] = $new_image;
            $admin->admin_image = $new_image;
            // DB::table('tbl_product')->insert($data);
            $admin->save();

            // $product_id = $product->id();
            
            Session::put('message','swal("Thêm tài khoản thành công!", "Thêm tài khoản thành công!","success")');
            return Redirect::to('admin');
        }else{
            
            Session::put('message','swal("Không thể thêm tài khoản!", "Tài khoản không có hình ảnh!","error")');
            return redirect()->back();
        }
    }
    public function login_auth(){
        return view("customer_auth.login_auth");    
    }
    public function login_at_auth(Request $request){
        $this->validation_login_auth($request);
        $data = $request->all();
        /*
            Giải thích một chút nhé: Khi ta sử dụng Auth::attempt() nó sẽ nhận vào một mảng các key/value ,
            như ví dụ ở trên thì hệ thống sẽ kiểm tra xem email có trong bảng users hay không,
            nếu có thì trường hash password trong bảng users sẽ được lấy ra để so sánh với hash password. 
            Và giá trị của Auth::attempt() sẽ tra về false hoặc true.
        */
        // $request->admin_email = $request->input['admin_email']
        if(Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])){
            // Session::put('admin_name', Auth::user()->admin_name);
            // Session::put('admin_image', Auth::user()->admin_image);
            // Session::put('admin_status', Auth::user()->admin_status);
            // Session::put('admin_id',Auth::user()->admin_id);
            Session::put('message','swal("Đăng nhập thành công!", "Chuyển tới trang quản lý","success")');
            return redirect('/dashboard');
        }else{
            Session::put('message','swal("Đăng nhập thất bại!", "Vui lòng kiểm tra lại!","error")');
            return redirect('/login-auth');
        }
    }
    public function log_out_auth(){
        Auth::logout();
        return redirect('/login-auth');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\AdminModel;
use Auth;
use Session ;
session_start();
class AdminController extends Controller
{
    //Kiểm tra đăng nhập Session
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            Session::put('message','Vui lòng đăng nhập quyền admin!');
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
    //Hiển thị trang đăng nhập
    public function index(){
        return view('admin_login.admin_login');
    }
    //Hiển thị trang quản lí
    public function show_dashboard(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            return view('admin.dashboard');// Muốn hiển thị dashboard thì cần gọi dashboard, gọi admin_layout thì sẽ không thể hiển thị được dashboard ra 
        }else{
            return redirect('/all-product')->send();
        }
    }
    //Xử lí đăng nhập
    public function dashboard(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $email = $request->email;//gắn biến email với biến admin_email tại form action <admin_login class="blade php"></admin_login>
        $password = md5($request->password);
        $result = DB::table('tbl_admin')
        ->where('admin_email',$email)
        ->where('admin_password',$password)
        ->where('waste_basket_admin',0)->first();
        if($result){
            // echo'<pre>';
            // print_r($result);
            // echo'</pre>';
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_image', $result->admin_image);
            Session::put('admin_status', $result->admin_status);
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
        $this->AuthLogin_Auth();
        // Session::put('admin_name',null);
        // Session::put('admin_id',null);
        Session::forget('admin_name');
        Session::forget('admin_image');
        Session::forget('admin_status');
        Session::forget('admin_id');
        Session::put('message','swal("Đăng xuất thành công!", "Chuyển tới trang đăng nhập","warning")');
        return Redirect::to('admin');
    }






    //Quản lý ==================================================================================
    // Validation
    public function validation($request){
        return $this->validation($request,[
            'admin_email'
                =>'required|email|max:255'
            ,
            'admin_password'
                =>'required|string|max:255|min:6'
            ,
            'admin_name' 
                =>'required|string|max:255|min:3'
            ,
            'admin_birdthday' 
                =>'required|string|max:255'
            ,
            'admin_address' 
                =>'required|string|max:255|min:3'
            ,
            'admin_image' 
                =>'required|string|max:255|min:3'
            ,
            'admin_phone' 
                =>'required|string|max:255|min:10'
            ,
            'admin_status' 
                =>'required|string|max:255'
            ,
            'waste_basket_admin' 
                =>'required|string|max:255|min:3'
            ,
            
        ]);
    }
    //Hiển thị trang thêm admin
    public function add_admin(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            return view('admin.add_admin');
        }else{
            return redirect()->back()->send();
        }
    }
    //Lưu và thêm admin
    public function save_admin(Request $request){
        // $this->AuthLogin();
        // $this->AuthLogin_Auth();
        // $this->validation($request);
        $data = $request->all();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $get_image = $request->file('file');
            $admin_name = $request->admin_name;
            $amdin_slug = $request->admin_slug;
            $amdin_birdthday = $request->admin_birdthday;
            $amdin_address = $request->admin_address;
            $amdin_phone = $request->admin_phone;
            $admin_email = $request->admin_email;
            $admin_password = $request->admin_password;
            $admin_status = $request->admin_status;
            if($get_image){
                $admin = new AdminModel();            
                    $get_name_image = $get_image->getClientOriginalName();//lấy cả tên và đuôi file
                    $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
                    $new_image =$name_image.rand(0,999999).'.'.$get_image->getClientOriginalExtension();//Nối thêm đuôi số
                    $get_image->move('public/uploads/admin',$new_image);//Chuyển ảnh đến thư mục gallery
                    
                    $admin->admin_image = $new_image;
                    $admin->admin_name = $admin_name;
                    $admin->admin_slug = $amdin_slug;
                    $admin->admin_birdthday = $amdin_birdthday;
                    $admin->admin_address = $amdin_address;
                    $admin->admin_phone = $amdin_phone;
                    $admin->admin_email = $admin_email;
                    $admin->admin_password = md5($admin_password);
                    $admin->admin_status = $admin_status;
                    $admin->waste_basket_admin =0;
                    $admin->save();
                    Session::put('message','swal("Thêm thành công!", "Thêm tài khoản thành công!","success")');
            }else{
                Session::put('message','swal("Thêm thất bại!", "Thêm không thành công!","error")');
            }
        }else{
            return redirect()->back()->send();
        }
    }
    //Hiển thị danh sách admin
    public function all_admin(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
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
        }else{
            return redirect()->back()->send();
        }
    }
    //Hiển thị chi tiết thông tin tài khoản
    public function edit_admin(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $admin_id = $request->admin_id;
        $edit_admin = AdminModel::where('admin_id',$admin_id)->first();
        return view('admin.edit_admin')->with('edit_admin',$edit_admin);
    }
    //Cập nhật tài khoản admin
    public function update_admin(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $get_image = $request->file('file');
            $admin_id = $request->admin_id;
            $admin_name = $request->admin_name;
            $amdin_slug = $request->admin_slug;
            $amdin_birdthday = $request->admin_birdthday;
            $amdin_address = $request->admin_address;
            $amdin_phone = $request->admin_phone;
            $admin_email = $request->admin_email;
            $admin_password = $request->admin_password;
            $admin_status = $request->admin_status;

            if($get_image){
                $admin = AdminModel::find($admin_id);   
                $check = 'public/uploads/admin/'.$admin->admin_image;
                if(File::exists($check)){//kiểm tra xem file có tồn tại không
                    unlink('public/uploads/admin/'.$admin->admin_image);//xóa hình ảnh khỏi thư mục chứa ảnh
                    $get_name_image = $get_image->getClientOriginalName();//lấy cả tên và đuôi file
                    $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
                    $new_image =$name_image.rand(0,999999).'.'.$get_image->getClientOriginalExtension();//Nối thêm đuôi số
                    $get_image->move('public/uploads/admin',$new_image);//Chuyển ảnh đến thư mục gallery
                    
                    $admin->admin_image = $new_image;
                    $admin->admin_name = $admin_name;
                    $admin->admin_slug = $amdin_slug;
                    $admin->admin_birdthday = $amdin_birdthday;
                    $admin->admin_address = $amdin_address;
                    $admin->admin_phone = $amdin_phone;
                    $admin->admin_email = $admin_email;
                    if($admin->admin_password != $admin_password){
                        $admin->admin_password = md5($admin_password);
                    }
                    $admin->admin_status = $admin_status;
                    $admin->waste_basket_admin =0;
                    $admin->save();
                }else{
                    $get_name_image = $get_image->getClientOriginalName();//lấy cả tên và đuôi file
                    $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
                    $new_image =$name_image.rand(0,999999).'.'.$get_image->getClientOriginalExtension();//Nối thêm đuôi số
                    $get_image->move('public/uploads/admin',$new_image);//Chuyển ảnh đến thư mục gallery
                    
                    $admin->admin_image = $new_image;
                    $admin->admin_name = $admin_name;
                    $admin->admin_slug = $amdin_slug;
                    $admin->admin_birdthday = $amdin_birdthday;
                    $admin->admin_address = $amdin_address;
                    $admin->admin_phone = $amdin_phone;
                    $admin->admin_email = $admin_email;
                    if($admin->admin_password != $admin_password){
                        $admin->admin_password = md5($admin_password);
                    }
                    $admin->admin_status = $admin_status;
                    $admin->waste_basket_admin =0;
                    $admin->save();
                }
            
            }else{
                $admin = AdminModel::find($admin_id);   
                $admin->admin_name = $admin_name;
                $admin->admin_slug = $amdin_slug;
                $admin->admin_birdthday = $amdin_birdthday;
                $admin->admin_address = $amdin_address;
                $admin->admin_phone = $amdin_phone;
                $admin->admin_email = $admin_email;
                if($admin->admin_password != $admin_password){
                    $admin->admin_password = md5($admin_password);
                }
                $admin->admin_status = $admin_status;
                $admin->waste_basket_admin =0;
                $admin->save();
            
            }
        }else{
            return redirect()->back()->send();
        }
    }
    //Xóa tài khoản admin
    public function delete_admin(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){

        }else{
            return redirect()->back()->send();
        }
    }
    //Tìm kiếm admin
    public function search_admin(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $data = $request->all();
            $keywords = $data['admin_name'];
            $i = 0;
            $all_admin = AdminModel::orderby('admin_status','asc')
            ->where('admin_name','like','%'.$keywords.'%')
            ->where('waste_basket_admin','0')
            // ->paginate(10);
            ->get();
            return view('admin.search_admin')
            ->with('all_admin', $all_admin)
            ->with('i',$i);
            
            // ->with('i',(request()->input('page',1)-1)*10);
        }else{
            return redirect()->back()->send();
        }
    }
    //Tự động tìm kiếm
    public function autocomplete_search_admin_ajax(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $data = $request->all();
            if($data['query']){
                $admin = AdminModel::where('admin_name','LIKE','%'.$data['query'].'%')
                ->where('waste_basket_admin',0)
                ->limit(6)
                ->get();
                $output = '';
                // display:block đỗ dữ liệu list về dạng khối
                // position:relative là cố định dính liền với những đối tượng trên nó
                foreach($admin as $key => $val){
                    $output.='<a class="a-auto-complete" href="#"><img class="img-auto-complete" src="'.url("public/uploads/admin/$val->admin_image").'" >'
                        .$val->admin_name.
                        '</a>';
                }
                $output .= '';
                echo $output;
            }else{
                alert('lỗi');
            }
        }else{
            return redirect()->back()->send();
        }
    }
    //Thùng rác
    public function waste_basket_admin(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $all_admin = AdminModel::orderby('admin_status','asc')
            ->where('waste_basket_admin',1)
            ->paginate(10);

            return view('admin.waste_basket_admin')
            ->with('all_admin', $all_admin)
            ->with('i',(request()->input('page',1)-1)*10);
            //Cho i là số thứ tự khi phân trang
            //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
            //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
            //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
            //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 
        }else{
            return redirect()->back()->send();
        }
    }
    //Chuyển vào thùng rác
    public function unactive_waste_basket_admin(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $admin_id = $request->admin_id;
            $admin = AdminModel::find($admin_id);   
            $admin->waste_basket_admin = 1;
            $admin->save();
        }else{
            return redirect()->back()->send();
        }
    }
    //Khôi phục thùng rác
    public function active_waste_basket_admin(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $admin_id = $request->admin_id;
            $admin = AdminModel::find($admin_id);   
            $admin->waste_basket_admin = 0;
            $admin->save();
        }else{
            return redirect()->back()->send();
        }
    }
}
?>

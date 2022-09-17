<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use Session ;
use Cart;
use App\Models\CouponModel;
session_start();
class CouponController extends Controller
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
    //Hiển thị trang thêm coupon
    public function add_coupon(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            return view('coupon.add_coupon');
        }else{
            return redirect()->back()->send();
        }
    }
    //Lưu sau khi thêm coupon
    public function save_coupon(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $data = $request->all();
            $coupon_model = new CouponModel;
            $coupon_model->coupon_name = $data['coupon_name'];
            $coupon_model->coupon_desc = $data['coupon_desc'];
            $coupon_model->coupon_code = $data['coupon_code'];
            $coupon_model->coupon_time = $data['coupon_time'];
            $coupon_model->coupon_feature = $data['coupon_feature'];
            $coupon_model->coupon_number = $data['coupon_number'];
            $coupon_model->waste_basket_coupon = 0;
            $coupon_model->save();

            Session::put('message','Thêm mã Coupon thành công!');
            return Redirect::to('all-coupon');
        }else{
            return redirect()->back()->send();
        }
    }
    //Danh sách mã coupon
    public function all_coupon(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $coupon_model = CouponModel::orderby('coupon_id','desc')
            ->where('waste_basket_coupon',0)
            ->paginate(10);
            return view('coupon.all_coupon')->with(compact('coupon_model'))
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
    //Xóa mã coupon 
    public function delete_coupon($coupon_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $coupon = CouponModel::find($coupon_id);
            //find() chỉ áp dụng cho cột mặc đinh được coi là id
            //Đem giá trị của $coupon_id so sánh với giá trị mang id trong model
            //$coupon_id = Coupon::where('coupon_id',$coupon_id)->first();
            //Muốn sử dụng cột khác id thì dùng where()
            Session::put('message','Xóa mã giảm giá thành công!');
            $coupon->delete();
            return  Redirect::to('all-coupon');
        }else{
            return redirect()->back()->send();
        }
    }

    //thùng rác
    public function waste_basket_coupon(){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $coupon_model = CouponModel::orderby('coupon_id','desc')
            ->where('waste_basket_coupon',1)->paginate(10);
            return view('coupon.waste_basket_coupon')->with(compact('coupon_model'))
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

    // Xóa tạm thời 
    public function unactive_waste_basket_coupon($coupon_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            CouponModel::where('coupon_id',$coupon_id)->update(['waste_basket_coupon'=>1]);
            Session::put('message','swal("Thông báo!", "Đã chuyển mã giảm giá vào thùng rác!","success")');
            return Redirect::to('all-coupon');
        }else{
            return redirect()->back()->send();
        }

    }
    //khôi phục
    public function active_waste_basket_coupon($coupon_id){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            CouponModel::where('coupon_id',$coupon_id)->update(['waste_basket_coupon'=>0]);
            Session::put('message','swal("Thông báo!", "Đã khôi phục mã giảm giá!","success")');
            return Redirect::to('waste-basket-coupon');
        }else{
            return redirect()->back()->send();
        }

    }
}

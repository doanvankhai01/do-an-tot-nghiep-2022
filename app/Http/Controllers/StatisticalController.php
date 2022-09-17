<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use App\Models\StatisticalModel;
use App\Models\VisitorModel;
use Carbon\Carbon;
use Session ;
use Auth;   
session_start();
class StatisticalController extends Controller
{
    //Kiểm tra đăng nhập sesion
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
    public function filter_statistical_by_day(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $data = $request->all();
            $date_start = $data['date_start'];
            $date_end = $data['date_end'];
            // if($dat){
                // Session::put('message','swal("Đăng nhập thành công!", "'.$date_end.'","success")');
                $get = StatisticalModel::whereBetween('order_date',[$date_start,$date_end]) 
                ->orderBy('order_date','ASC')
                ->get();
                // whereBetween là điều kiện giữa cái gì tới cái gì

                foreach($get as $key => $val){
                    $chart_data[] = array(
                        // 'period' => $val->order_date,
                        'date' => $val->order_date,
                        'order' => $val->total_order,
                        'sales' => $val->sales,
                        'profit' => $val->profit,
                        'quantity' => $val->quantity
                    );
                    //Các trường bên trái là bắt buộc, không được thay đổi tên, bên phải là giá trị gán vào
                    //$chart_data là một mảng
                }
                echo $data = json_encode($chart_data);
                //Trả về một chuỗi có chứa biểu diễn JSON của cung cấp value. Nếu tham số là một mảng hoặc đối tượng , nó sẽ được tuần tự hóa một cách đệ quy.
            
            
            // }else{
            //     Session::put('message','swal("Đăng nhập thành công!", "Chuyển tới trang quản lý","error")');
            // }
        }else{
            return redirect()->back()->send();
        }
    }
    //Load dữ liệu
    public function load_sixty_day_statistical(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $sub_sixty_day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(60)->toDateString();//Lấy 30 ngày trước
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();//Lấy ngày hiện tại
            $get = StatisticalModel::whereBetween('order_date',[$sub_sixty_day,$now])
            ->orderBy('order_date','ASC')->get();//Lấy tất cả số liệu trong khoản thời gian đã đặt
            // whereBetween là điều kiện giữa cái gì tới cái gì

            //Load toàn bộ dữ liệu nén vào mảng
            foreach($get as $key => $val){
                $chart_data[] = array(
                    // 'period' => $val->order_date,
                    'date' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity
                );
            }
            echo $data = json_encode($chart_data);
            //Trả về một chuỗi có chứa biểu diễn JSON của cung cấp value. Nếu tham số là một mảng hoặc đối tượng , nó sẽ được tuần tự hóa một cách đệ quy.
        }else{
            return redirect()->back()->send();
        }
    }
    //lọc doanh số
    public function filter_statistical(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            $data = $request->all();
            // echo $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
            // $day_in_month = Carbon::now('Asia/Ho_Chi_Minh');//Lấy thời gian hiện tại
            // $day_check_month = $day_in_month->day;//lấy ngày
            //Hàm xử lý điều kiện ngày hiện tại 31, nhưng tháng cần tìm chỉ có 30 hoặc 28,29 ngày, điều này thường gây lỗi nên cần kiểm tra điều kiện 
            // if($day_check_month == 31 || $day_check_month == 30){
            //     $day_to_30 = $day_in_month->subDay();
            //     $dau_hai_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subDays(3)->subMonths(2)->startOfMonth()->toDateString();//Lấy ngày đầu 2 tháng trước
            //     $dau_ba_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subDays(3)->subMonths(3)->startOfMonth()->toDateString();//Lấy ngày đầu 3 tháng trước
            //     $dau_sau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subDays(3)->subMonths(6)->startOfMonth()->toDateString();//lấy ngày đầu 6 tháng trước

            //     $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subDays(3)->subMonth()->startOfMonth()->toDateString();//Lấy ngày đầu tháng trước
            //     $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subDays(3)->subMonth()->endOfMonth()->toDateString();//lấy ngày cuối tháng trước
            //     // trừ đi 3 ngày luôn vì lỡ vào trường hợp gặp tháng 2 chỉ có 28 ngày thì sẽ ko hiện tháng 2 mà nhảy qua tháng 3
            // }else{
            //     $dau_hai_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonths(2)->startOfMonth()->toDateString();//Lấy ngày đầu 2 tháng trước
            //     $dau_ba_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonths(3)->startOfMonth()->toDateString();//Lấy ngày đầu 3 tháng trước
            //     $dau_sau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonths(6)->startOfMonth()->toDateString();//lấy ngày đầu 6 tháng trước

            //     $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();//Lấy ngày đầu tháng trước
            //     $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();//lấy ngày cuối tháng trước
            // }
            $dau_hai_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonths(2)->startOfMonth()->toDateString();//Lấy ngày đầu 2 tháng trước
            $dau_ba_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonths(3)->startOfMonth()->toDateString();//Lấy ngày đầu 3 tháng trước
            $dau_sau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonths(6)->startOfMonth()->toDateString();//lấy ngày đầu 6 tháng trước

            $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();//Lấy ngày đầu tháng trước
            $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();//lấy ngày cuối tháng trước
            $dau_thang_nay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();//Lấy ngày đầu tháng
            $sub_bay_ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();//lấy thời gian cách đây 7 ngày
            $sub_ba_sau_nam_ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();//lấy thời gian cách đây 365 ngày
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            //startOfMonth() : ngày bắt đầu của tháng
            //toDateString() : chuyển ngày thành kiểu chuỗi
            //endOfMonth(): ngày cuối tháng
            //subMonth(): giảm 1 tháng so với hiện tại, nếu thêm số vào thì giảm theo số tháng nhưng phải thêm s vào cuối hàm subMonths(2)
            //addMonth: tăng 1 tháng so với hiện tại, nếu thêm số vào thì tăng theo số đã điền nhưng phải thêm s vào cuối hàm addMonths(2)

            if($data['filter_statistical'] == 'bay_ngay'){
                $get = StatisticalModel::whereBetween('order_date',[$sub_bay_ngay,$now])
                ->orderBy('order_date','ASC')
                ->get();
            }else if($data['filter_statistical'] == 'thang_nay'){
                $get = StatisticalModel::whereBetween('order_date',[$dau_thang_nay,$now])
                ->orderBy('order_date','ASC')
                ->get();
            }else if($data['filter_statistical'] == 'thang_truoc'){
                $get = StatisticalModel::whereBetween('order_date',[$dau_thang_truoc,$cuoi_thang_truoc])
                ->orderBy('order_date','ASC')
                ->get();
            }else if($data['filter_statistical'] == 'ba_sau_nam_ngay'){
                $get = StatisticalModel::whereBetween('order_date',[$sub_ba_sau_nam_ngay,$now])
                ->orderBy('order_date','ASC')
                ->get();
            }else if($data['filter_statistical'] == 'hai_thang_truoc'){
                $get = StatisticalModel::whereBetween('order_date',[$dau_hai_thang_truoc,$now])
                ->orderBy('order_date','ASC')
                ->get();
            }
            else if($data['filter_statistical'] == 'ba_thang_truoc'){
                $get = StatisticalModel::whereBetween('order_date',[$dau_ba_thang_truoc,$now])
                ->orderBy('order_date','ASC')
                ->get();
            }else if($data['filter_statistical'] == 'sau_thang_truoc'){
                $get = StatisticalModel::whereBetween('order_date',[$dau_sau_thang_truoc,$now])
                ->orderBy('order_date','ASC')
                ->get();
            }
            // whereBetween là điều kiện giữa cái gì tới cái gì
            //Load toàn bộ dữ liệu nén vào mảng
            foreach($get as $key => $val){
                $chart_data[] = array(
                    // 'period' => $val->order_date,
                    'date' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity
                );
            }
            echo $data = json_encode($chart_data);
            //Trả về một chuỗi có chứa biểu diễn JSON của cung cấp value. Nếu tham số là một mảng hoặc đối tượng , nó sẽ được tuần tự hóa một cách đệ quy.
        }else{
            return redirect()->back()->send();
        }
    }

    //Thống kê lượt truy cập
    public function show_visitor(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
            echo $user_ip_address = $request->ip();//lấy địa chỉ ip đã đăng nhập
        }else{
            return redirect()->back()->send();
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use App\Models\StatisticalModel;
use Session ;
session_start();
class StatisticalController extends Controller
{
    public function filter_statistical_by_day(Request $request){
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
                    'period' => $val->order_date,
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
        
    }
}

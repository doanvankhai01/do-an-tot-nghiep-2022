<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use App\Models\ProductModel;
use App\Models\OrderModel;
use Session ;
session_start();
class NotificationController extends Controller
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
    // Thống kê tổng sản phẩm
    public function notification_product(Request $request){
        $this->AuthLogin();
            $all_product = ProductModel::orderby('product_id','desc')
            ->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')//Hiển thị tên danh mục
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')//Hiển thị tên thương hiệu
            ->where('waste_basket_product',0)
            ->paginate(10);
            $i = 0;
            foreach($all_product as $key => $all_pro){
                $i++;
            }
            echo $i;
      
    }
    // Thống kê tổng đơn hàng mới
    public function notification_new_order(Request $request){
        $this->AuthLogin();
            $order = OrderModel::orderby('created_at','DESC')
            ->where('waste_basket_order',0)
            ->where('order_status',0)
            ->get(); 
            $i = 0;
            foreach($order as $key => $all_pro){
                $i++;
            }
            echo $i;
    }
    // Thống kê tổng đơn hàng chưa xử lí
    public function notification_view_order(Request $request){
        $this->AuthLogin();
            $order = OrderModel::orderby('created_at','DESC')
            ->where('waste_basket_order',0)
            ->whereBetween('order_status',[0,1])
            ->get(); 
            $i = 0;
            foreach($order as $key => $all_pro){
                $i++;
            }
            echo $i;
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use Session ;
use Cart;

use App\Models\ProductModel;
use App\Models\ProvinceModel;
use App\Models\DistrictModel;
use App\Models\TownModel;
use App\Models\FeeShipModel;
use App\Models\CustomerModel;
use App\Models\SliderBannerModel;
use App\Models\ShippingModel;
use App\Models\OrderModel;
use App\Models\CouponModel;
use App\Models\OrderDetailModel;

session_start();
class CheckoutController extends Controller
{
    //hiện trang đăng nhập đăng kí
    public function login_checkout(Request $request){
         //------------------------SEO-------------------------
         $meta_desc = "Chuyên cung cấp các mặt hàng gấu bông chất lượng cao!"; 
         $meta_keywords = "Gấu bông nhiều chủng loại, nhiều size, nhiều mẫu mã!";
         $meta_title = "TeddyShop";
         $url_canonical = $request->url();
         //------------------------SEO--------------------------
         $cate_product = DB::table('tbl_category_product')
         ->where('category_status','0')
         ->where('waste_basket_category','0')
         ->orderby('category_id','desc')
         ->get(); 
        $brand_product = DB::table('tbl_brand_product')
        ->where('brand_status','0')
        ->orderby('brand_id','desc')
        ->get();
        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('slider_status',0)
        ->where('waste_basket_slider',0)
        ->get();//Hiển thị Slider
        return view('pages.checkout.login_checkout')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
    }
    //đăng xuất
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    //thực hiện chức năng đăng kí 
    public function add_customer(Request $request){
        $data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
        $data['customer_address'] = $request->customer_address;
        $data['waste_basket_customer'] = 0;
    	$data['customer_password'] = md5($request->customer_password);

    	$customer_id = DB::table('tbl_customer')
        ->insertGetId($data);//tạo tài khoản và lấy id vừa tạo chuyển tới trang đăng nhập

    	Session::put('customer_id',$customer_id);//customer_id là
    	Session::put('customer_name',$request->customer_name);//
    	return Redirect::to('/checkout');
    }
    //chức năng đăng nhập
    public function login_customer(Request $request){
        $email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
    	if($result){
    		Session::put('customer_id',$result->customer_id);
    		return Redirect::to('/checkout');
    	}else{
    		return Redirect::to('/login-checkout');
    	}
    }
    //Hiển thị trang thông tin ship hàng
    public function checkout(Request $request){
         //------------------------SEO-------------------------
         $meta_desc = "Chuyên cung cấp các mặt hàng gấu bông chất lượng cao!"; 
         $meta_keywords = "Gấu bông nhiều chủng loại, nhiều size, nhiều mẫu mã!";
         $meta_title = "TeddyShop";
         $url_canonical = $request->url();
         //------------------------SEO--------------------------
         $cate_product = DB::table('tbl_category_product')
         ->where('category_status','0')
         ->where('waste_basket_category','0')
         ->orderby('category_id','desc')
         ->get(); 
        $brand_product = DB::table('tbl_brand_product')
        ->where('brand_status','0')
        ->orderby('brand_id','desc')
        ->get();
        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('slider_status',0)
        ->where('waste_basket_slider',0)
        ->get();//Hiển thị Slider
        //Hiển thị tỉnh thành phố-ajax
        $province = ProvinceModel::orderby('province_id','ASC')->get();
        // Lấy thông tin khách hàng
        $id_customer = Session::get('customer_id');
        $receiver = CustomerModel::where('customer_id',$id_customer)->get();
        return view('pages.checkout.show_checkout')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('province',$province)
        ->with('receiver',$receiver)
        ->with('all_slider',$all_slider);
    }
    //Thực hiện lưu thông tin khách hàng = Trang này đã bị hủy, không còn sử dụng trên page
    public function save_checkout_customer(Request $request){
        $data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_notes'] = $request->shipping_notes;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);
    	Session::put('shipping_id',$shipping_id);
    	
    	return Redirect::to('/payment');
    }
    //Hiển thị trang thanh toán = Trang này đã bị hủy, không còn sử dụng trên page
    public function payment(Request $request){
         //------------------------SEO-------------------------
         $meta_desc = "Chuyên cung cấp các mặt hàng gấu bông chất lượng cao!"; 
         $meta_keywords = "Gấu bông nhiều chủng loại, nhiều size, nhiều mẫu mã!";
         $meta_title = "TeddyShop";
         $url_canonical = $request->url();
         //------------------------SEO--------------------------
         $cate_product = DB::table('tbl_category_product')
         ->where('category_status','0')
         ->where('waste_basket_category','0')
         ->orderby('category_id','desc')
         ->get(); 
        $brand_product = DB::table('tbl_brand_product')
        ->where('brand_status','0')
        ->orderby('brand_id','desc')
        ->get();
        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('slider_status',0)
        ->where('waste_basket_slider',0)
        ->get();//Hiển thị Slider
        //Hiển thị tỉnh thành phố-ajax
        return view('pages.checkout.payment')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('all_slider',$all_slider)
        ->with('url_canonical',$url_canonical);
    }

    //Thanh toán đơn hàng
    public function order_place(Request $request){
        //insert payment_method
         //------------------------SEO-------------------------
         $meta_desc = "Chuyên cung cấp các mặt hàng gấu bông chất lượng cao!"; 
         $meta_keywords = "Gấu bông nhiều chủng loại, nhiều size, nhiều mẫu mã!";
         $meta_title = "TeddyShop";
         $url_canonical = $request->url();
         //------------------------SEO--------------------------
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 0;
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        //Khi đăng nhập và nhập thông tin khách hàng thì mặc định đã có customer_id và shipping_id lưu trữ tạm thời trên session
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 0;
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            //Các đối tượng id, name, price, qty là các đối tượng được tạo mặc định có sẵn trong Cart
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){

            echo 'Thanh toán thẻ ATM';

        }elseif($data['payment_method']==2){
            Cart::destroy();//sau thi mua xong thì hủy  giỏ hàng

            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
            return view('pages.checkout.handcash')
            ->with('category',$cate_product)
            ->with('brand',$brand_product)
            ->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)
            ->with('url_canonical',$url_canonical);

        }else{
            echo 'Thẻ ghi nợ';

        }
        
        //return Redirect::to('/payment');
    }

    //Xử lí đơn hàng trên trang quản lí admin-------------------------------------------------------------------------------------------------------------------------
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
    //Quản lí đơn hàng -- tại trang dashboard
    public function manager_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')//select là chọn,tbl_order.* là chọn tất cả trong table
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order  = view('order.manager_order')->with('all_order',$all_order);
        return view('admin.admin_layout')->with('order.manager_order', $manager_order);
    }
    //Chi tiết đơn hàng--dashboard
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')->first();

        $d_product  = DB::table('tbl_order_details')
        ->where('order_id',$orderId)
        ->get();

        $manager_order_by_id  = view('order.view_order')->with('order_by_id',$order_by_id)->with('d_product', $d_product);

        return view('admin.admin_layout')->with('order.view_order', $manager_order_by_id);
        
    }
//AJAX-----------------------------------------------------------------------------------------------------------------------------------------------
    //Hiển thị thông tin các tỉnh thành-Trang chủ
    public function select_delivery_page_home(Request $request){
        $data = $request->all();
        print_r ($data);
        if($data['action']){
            $output = '';
            if($data['action']=="province"){
                $select_district = DistrictModel::where('province_id',$data['ma_id'])->orderby('district_id','ASC')->get();
                $output.= '<option value="">---Chọn quận huyện---</option>';
                foreach($select_district as $key => $sel_dis){
                    $output.= '<option value="'.$sel_dis->district_id.'">'.$sel_dis->district_name.'</option>';
                }
            }else{
                $select_town = TownModel::where('district_id',$data['ma_id'])->orderby('town_id','ASC')->get();
                $output.= '<option value="">---Chọn xã phường---</option>';
                foreach($select_town as $key => $sel_town){
                    $output.= '<option value="'.$sel_town->town_id.'">'.$sel_town->town_name.'</option>';
                }
            }
        }
        echo $output; 
    }
    //Tính phí vận chuyển-trang chủ
    public function calculate_delivery_fee(Request $request){
        $data = $request->all();
        if($data['province_id']){
            $feeship = FeeShipModel::where('province_id',$data['province_id'])
            ->where('district_id',$data['district_id'])
            ->where('town_id',$data['town_id'])
            ->get();
            if($feeship){
                $count_feeship = $feeship->count();//count đếm số lượng bản ghi trả về 
                if($count_feeship > 0){//nếu số lượng trả về lớn hơn 0
                    foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->feeship_number);
                        Session::save();
                    }
                }else{//nếu không thì mặc định giá vận chuyển là 10k
                    Session::put('fee',10000);
                    Session::save();
                }
            }
        }
    }
    //Hủy phí vận chuyển-trang chủ
    public function cancel_fee(){
        Session::forget('fee');
        return redirect()->back();
    }    
    //Đặt hàng
    public function confirm_order(Request $request){
        $data = $request->all();
        // Cập nhật coupon
        if(Session::get('coupon')==true){
            $coupon = CouponModel::where('coupon_code',$data['order_coupon'])->first();
            $coupon->coupon_time =$coupon->coupon_time - 1;
            $coupon->save();
        }
        // Cập nhật số lượng
        // $product = ProductModel::where('product_id',$order_dt_pro['product_id']);
        // $qtty = $order_dt_pro['product_qty'];
        // $product->product_quantity = $product->product_quantity - $order_dt_pro['product_qty'];
        // $product->save();
        // 
        $shipping = new ShippingModel();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();

        //thêm vào tbl_order
        $shipping_id = $shipping->shipping_id;//sau khi save xong thì sẽ có id này trong tbl_shipping
        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        $order = new OrderModel();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 0;
        $order->waste_basket_order = 0;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');//lấy múi giờ của thành phố HCM
        $order->created_at = now();//lấy giờ hiện tại
        $order->save();//tương ứng với insert(lưu)

        // Giảm số lượng mã giảm giá

        //thêm vào tbl_order_details
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $order_dt_pro ){
                $order_detail = new OrderDetailModel();
                $order_detail->order_code = $checkout_code;
                $order_detail->product_id = $order_dt_pro['product_id'];
                $order_detail->product_name = $order_dt_pro['product_name'];
                $order_detail->product_image = $order_dt_pro['product_image'];
                $order_detail->product_price = $order_dt_pro['product_price'];
                $order_detail->product_sales_quantity = $order_dt_pro['product_qty'];
                $order_detail->product_coupon = $data['order_coupon'];
                $order_detail->product_feeship = $data['order_feeship'];
                $order_detail->save();
                
            }
            // // Cập nhật số lượng , trừ số lượng khi đẫm mau hàng 
            // $product = ProductModel::where('product_id',$order_dt_pro['product_id'])->first();
            // $product->product_sales_quantity = $product->product_sales_quantity- $order_dt_pro['product_qty'];
            // $product->save();
            
            Session::forget('cart');
            Session::forget('coupon');
            Session::forget('fee');
        }
    }
}
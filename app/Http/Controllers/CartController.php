<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use App\Models\CouponModel;
use App\Models\SliderBannerModel;
use Session ;
use Cart;
session_start();
class CartController extends Controller
{
    //Hiển thị sản phẩm ra giỏ hàng và tính tiền
    public function save_cart(Request $request){
        $cate_product = DB::table('tbl_category')
        ->where('category_status','0')
        ->orderby('category_id','desc')
        ->get(); 
        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')
        ->orderby('brand_id','desc')
        ->get(); 

        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);//thêm 
        //Cart::destroy();//hủy giỏ hàng
        // trong Cart có các trường quy định sẵn
        // chúng ta cần dùng các trường này gán với các mục cần hiển thị sao cho hợp lí nhất
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        Cart::setglobalTax(10);
        return Redirect::to('/show-cart');
        // return view('pages.cart.show_cart')
        // ->with('category',$cate_product)
        // ->with('brand',$brand_product)
        // ->with('meta_desc',$meta_desc)
        // ->with('meta_keywords',$meta_keywords)
        // ->with('meta_title',$meta_title)
        // ->with('url_canonical',$url_canonical);
    }
    //giỏ hàng
    public function show_cart(Request $request){
         //------------------------SEO-------------------------
         $meta_desc = "Chuyên cung cấp các mặt hàng gấu bông chất lượng cao!"; 
         $meta_keywords = "Gấu bông nhiều chủng loại, nhiều size, nhiều mẫu mã!";
         $meta_title = "TeddyShop";
         $url_canonical = $request->url();
         //------------------------SEO--------------------------
        $cate_product = DB::table('tbl_category')
        ->where('category_status','0')
        ->orderby('category_id','desc')
        ->get(); 
        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')
        ->orderby('brand_id','desc')
        ->get();

        return view('pages.cart.show_cart')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);
    }
    //xóa sản phẩm trong giỏ hàng
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);//Xóa sp dựa vào id, khi đưa rowId giá trị về = 0, thì mặc định sản phẩm không tồn tại, và sẽ xóa sản phẩm khỏi giỏ hàng
        return Redirect::to('/show-cart');
    }
    //cập nhật giỏ hàng
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);// Dựa vào rowid update số lượng sản phẩm 
        return Redirect::to('/show-cart');
    }
//AJAX CART----------------------------------------------------------------------------------------------------------------------
    //Cart Ajax
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        // print_r($data);
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                    $cart[$key]['product_qty']+=$data['cart_product_qty'];
                    Session::put('cart',$cart);
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }  
    //Hiển thị giỏ hàng ajax
    public function show_cart_ajax(Request $request){
         //------------------------SEO-------------------------
         $meta_desc = "Chuyên cung cấp các mặt hàng gấu bông chất lượng cao!"; 
         $meta_keywords = "Gấu bông nhiều chủng loại, nhiều size, nhiều mẫu mã!";
         $meta_title = "TeddyShop";
         $url_canonical = $request->url();
         //------------------------SEO--------------------------
        $cate_product = DB::table('tbl_category')
        ->where('category_status','0')
        ->orderby('category_id','desc')
        ->get(); 
        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')
        ->orderby('brand_id','desc')
        ->get();
        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('waste_basket_slider',0)
        ->where('slider_status',0)
        ->get();//Hiển thị Slider
        //Session::put('cart',null);
        return view('pages.cart.show_cart_ajax')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
    }
    //Cập nhật giỏ hàng
    public function update_cart_ajax(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){//Nếu có giỏ hàng
            $message ='';
           
            foreach($data['cart_qty'] as $key => $qty){//Chạy vòng lặp hiển thị ra toàn bộ số lượng nhập vào
                $i=0;
                foreach($cart as $session =>$val){//chạy vòng lặp hiển thị thông tin toàn bộ sản phẩm trong giỏ hàng
                    $i++;
                    if($val['session_id']==$key && $qty <= $cart[$session]['product_quantity']){
                        //Nếu session_id(được tạo tự động khi add, trong phần add_cart_ajax) có trước trong Session trùng khớp với Session_id được gửi qua khi cập nhật
                        //Và nếu Số lượng nhập vào nhỏ hơn số lượng tồn kho
                        $cart[$session]['product_qty'] = $qty;//Gán giá trị số lượng mới
                        // $message.= '<p class="text-success">'.$i.'. Cập nhật số lượng: '.$cart[$session]['product_name'].' thành công!</p>';
                        $message.= ''.$i.'. Cập nhật số lượng: '.$cart[$session]['product_name'].' thành công!\n';
                        Session::put('message','swal("Thông báo!", "'.$message.'!","info")');
                    }elseif($val['session_id']==$key && $qty > $cart[$session]['product_quantity']){
                        $message.= ''.$i.'. Cập nhật số lượng: '.$cart[$session]['product_name'].' thất bại!\n';
                        Session::put('message','swal("Thông báo!", "'.$message.'!","info")');
                    }
                }
            }
            Session::put('cart',$cart);//Cập nhật lại Session cart
            return redirect()->back();
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng sản phẩm thất bại!');
        }
    }
    //Xóa giỏ hàng ajax
    public function delete_to_cart_ajax($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            Session::put('message','swal("Thông báo!", "Xóa sản phẩm thành công!","success" )');
            return redirect()->back();
        }else{
            Session::put('message','swal("Thông báo!", "Xóa sản phẩm không thành công!","error")');
            return redirect()->back();
        }
    }
    //Xóa tất cả sản phẩm trong giỏ hàng
    public function delete_all_ajax(){
        $cart = Session::get('cart');
        if($cart == true){
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Giỏ hàng đã được dọn sạch!');
        }
    }
    //Coupon
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = CouponModel::where('coupon_code',$data['coupon_code'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            //count() là đếm số lượng
            if($count_coupon >0){//Kiểm tra có mã coupon có kí tự hay ko
                
                $coupon_quantity = $coupon->coupon_time;
                if($coupon_quantity > 0){//Kiểm tra số lượng coupon
                    $coupon_session = Session::get('coupon');
                    if($coupon_session==true){
                        $is_avaiable = 0;
                        if($is_avaiable==0){
                            $cou[] = array(
                                'coupon_code'=> $coupon->coupon_code,
                                'coupon_feature'=> $coupon->coupon_feature,
                                'coupon_number'=> $coupon->coupon_number
                            );
                            Session::put('coupon',$cou);
                        }
                        Session::save();
                        return redirect()->back()->with('message','Thêm mã giảm giá thành công !');
                    }else{
                        $cou[] = array(
                            'coupon_code'=> $coupon->coupon_code,
                            'coupon_feature'=> $coupon->coupon_feature,
                            'coupon_number'=> $coupon->coupon_number
                        );
                        Session::put('coupon',$cou);
                        Session::save();
                        return redirect()->back()->with('message','Thêm mã giảm giá thành công !');
                    }
                }else{
                    Session::put('coupon',null);;
                    return redirect()->back()->with('error','Mã coupon đã hết hạn!');
                }
            }else{
                Session::save();
                return redirect()->back()->with('message','Is avaiable null!');
            }
        }else{
            Session::put('coupon',null);;
            return redirect()->back()->with('error','Mã giảm giá không tồn tại!');
        }
    }
    //Reset mã coupon đã nhập trong giỏ hàng
    public function reset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');
            return redirect()->back();
        }
        return redirect()->back();
    }
}

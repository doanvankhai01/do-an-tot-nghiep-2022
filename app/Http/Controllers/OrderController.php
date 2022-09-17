<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use Session ;
use Cart;
use Auth;

use App\Models\ProvinceModel;
use App\Models\DistrictModel;
use App\Models\TownModel;
use App\Models\FeeShipModel;
use App\Models\CustomerModel;
use App\Models\ShippingModel;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\CouponModel;
use App\Models\ProductModel;
use PDF;
session_start();
class OrderController extends Controller
{
	 //Kiểm tra đăng nhập session
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
    //Danh sách đơn hàng
    public function manager_order(){
		// $this->AuthLogin();
		$this->AuthLogin_Auth();
		$check_position = $this->check_position_2();
        if($check_position == true){
			$order = OrderModel::orderby('created_at','DESC')
			->where('waste_basket_order',0)->paginate(10);
			return view('order.manager_order')->with(compact('order'))
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
	//Tìm kiếm mã đơn hàng
	public function search_order_on_admin_layout(Request $request){
		// $this->AuthLogin();
		$this->AuthLogin_Auth();
		$check_position = $this->check_position_2();
        if($check_position == true){
			$data = $request->all();
			$keywords = $data['search_order_submit'];
			// echo '<pre>';
			// echo $keywords;
			// echo '</pre>';
			$order = OrderModel::orderby('order_id','desc')
			->where('order_code','like','%'.$keywords.'%')
			->where('waste_basket_order','0')
			// ->paginate(10);
			->get();
			return view('order.search_order')
			->with('order', $order)
			->with('keywords', $keywords);
			// ->with('i',(request()->input('page',1)-1)*10);
		}else{
			return redirect()->back()->send();
		}
	}
	//Tìm kiếm mã đơn hàng tự động
    public function autocomplete_search_order_admin_ajax(Request $request){
		// $this->AuthLogin();
		$this->AuthLogin_Auth();
		$check_position = $this->check_position_2();
        if($check_position == true){
			$data = $request->all();
			if($data['query']){
				$order = OrderModel::where('order_code','LIKE','%'.$data['query'].'%')
				->where('waste_basket_order',0)
				->limit(6)
				->get();
				$output = '';
				// display:block đỗ dữ liệu list về dạng khối
				// position:relative là cố định dính liền với những đối tượng trên nó
				$i = 0;
				foreach($order as $key => $val){
					// $output.='<a class="a-auto-complete">Mã đơn hàng:<span id="span-show-auto-complete-'.$i++.'">'
					//     .$val->order_code.'</span> || Đặt ngày:'.$val->created_at.
					//     '</a>';
					$output.='<a class="a-auto-complete">'
						.$val->order_code.
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
    //Chi tiết đơn hàng
    public function view_order($order_code){
		// $this->AuthLogin();
		$this->AuthLogin_Auth();
		$check_position = $this->check_position_2();
        if($check_position == true){
			$order_detail = OrderDetailModel::with('product')->where('order_code',$order_code)->get();//có vẻ là code thừa ???
			$order = OrderModel::where('order_code',$order_code)->get();//lấy thông tin tất cả đơn hàng mang có mã là order_code
			
			//Cập nhật tình trạng đơn hàng - đã xem
			$order_status = OrderModel::where('order_code',$order_code)->first();
			//Khi click vào chi tiết thì chuyển qua trạng thái đã xem
			if($order_status->order_status == 0){
				$order_status->order_status = 1;
				$order_status->save();
			}
			// lấy dữ liệu thông tin đơn hàng từ OrderModel
			foreach($order as $key => $ode){
				$customer_id = $ode->customer_id;
				$shipping_id = $ode->shipping_id;
				$get_status_show_btn_update_qty = $ode->order_status;
			}
			// Sau đó lấy các giá trị đó đem so sánh để lấy ra thông tin chính xác của từng đơn hàng
			$customer = CustomerModel::where('customer_id',$customer_id)->first();//Lấy thông tin người đặt(1 người)
			$shipping = ShippingModel::where('shipping_id',$shipping_id)->first();//lấy thông tin người nhận(1 người)
			$order_details = OrderDetailModel::with('product')->where('order_code',$ode->order_code)->get();//lấy toàn bộ sản phẩm có trong đơn hàng
			// Lây chi tiết đơn hàng kết nối với tbl_product lấy điều kiện mã đơn hàng -> lấy hết toàn bộ 
				foreach($order_details as $key => $or_de){
					$product_coupon = $or_de->product_coupon;//Lấy ra mã giảm giá trong chi tiêt đơn hàng
					// echo('<pre style="font-weight:bold;color:blue; position: absolute;z-index:9999;">');
					// echo( $or_de);
					// echo('</pre>');
				}
				//Lấy giá trị cuối cùng kiểm tra
				if($product_coupon !='không có'){//Nếu mã khác không có
					$coupon = CouponModel::where('coupon_code',$product_coupon)->first();
					$coupon_feature = $coupon->coupon_feature;//loại mã(%/tiền) bằng với mã đã cho
					$coupon_number = $coupon->coupon_number;// số tiền giẩm
				}else{//Nếu mã là không có
					$coupon_feature = 2;//giảm theo tiền mặt
					$coupon_number = 0;//số tiền giảm là 0 VNĐ
				}
			return view('order.view_order')->with(compact('order_detail','customer','shipping','order_details','coupon_feature','coupon_number','order_code','order','get_status_show_btn_update_qty'));
		}else{
			return redirect()->back()->send();
		}
	}
    //Xuất đơn hàng
    public function export_order($checkout_code){
		// $this->AuthLogin();
		$this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
			// $this->AuthLogin();
			$this->AuthLogin_Auth();
			$pdf = \App::make('dompdf.wrapper');
			$pdf->loadHTML($this->print_order_convert($checkout_code));
			return $pdf->stream();
		}else{
            return redirect()->back()->send();
        }
    }
    //Hàm lấy thông tin và hiển thị thông tin ra đơn hàng PDF
    public function print_order_convert($checkout_code){
		// $this->AuthLogin();
		$this->AuthLogin_Auth();
		$check_position = $this->check_position_2();
        if($check_position == true){
			$order_details = OrderDetailModel::where('order_code',$checkout_code)->get();
			$order = OrderModel::where('order_code',$checkout_code)->get();
			foreach($order as $key => $ord){
				$customer_id = $ord->customer_id;
				$shipping_id = $ord->shipping_id;
			}
			$customer = CustomerModel::where('customer_id',$customer_id)->first();
			$shipping = ShippingModel::where('shipping_id',$shipping_id)->first();
			$order_details_product = OrderDetailModel::with('product')->where('order_code', $checkout_code)->get();
			
			foreach($order_details_product as $key => $order_d){
				$product_coupon = $order_d->product_coupon;
			}
			if($product_coupon != 'không có'){
				$coupon = CouponModel::where('coupon_code',$product_coupon)->first();
				$coupon_feature = $coupon->coupon_feature;
				$coupon_number = $coupon->coupon_number;
				if($coupon_feature==1){
					$coupon_echo = $coupon_number.'%';
				}elseif($coupon_feature==2){
					$coupon_echo = number_format($coupon_number,0,',','.').'đ';
				}
			}else{
				$coupon_feature = 2;
				$coupon_number = 0;
				$coupon_echo = '0';
			}

			$output = '';

			$output.='<style>body{
				font-family: DejaVu Sans;
			}
			.table-styling{
				border:1px solid #000;
			}
			.table-styling tbody tr td{
				border:1px solid #000;
			}
			</style>
			<h1><centerCông ty TNHH một thành viên ABCD</center></h1>
			<h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
			<p>Người đặt hàng</p>
			<table class="table-styling">
					<thead>
						<tr>
							<th>Tên khách đặt</th>
							<th>Số điện thoại</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>';
			$output.='		
						<tr>
							<td>'.$customer->customer_name.'</td>
							<td>'.$customer->customer_phone.'</td>
							<td>'.$customer->customer_email.'</td>
						</tr>';
			$output.='				
					</tbody>
			</table>
			<p>Ship hàng tới</p>
				<table class="table-styling">
					<thead>
						<tr>
							<th>Tên người nhận</th>
							<th>Địa chỉ</th>
							<th>Sdt</th>
							<th>Email</th>
							<th>Ghi chú</th>
						</tr>
					</thead>
					<tbody>';
			$output.='		
						<tr>
							<td>'.$shipping->shipping_name.'</td>
							<td>'.$shipping->shipping_address.'</td>
							<td>'.$shipping->shipping_phone.'</td>
							<td>'.$shipping->shipping_email.'</td>
							<td>'.$shipping->shipping_notes.'</td>
						</tr>';
			$output.='				
					</tbody>
			</table>
			<p>Đơn hàng đặt</p>
				<table class="table-styling">
					<thead>
						<tr>
							<th>Tên sản phẩm</th>
							<th>Phí ship</th>
							<th>Số lượng</th>
							<th>Giá sản phẩm</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>';
					$total = 0;
					foreach($order_details_product as $key => $product){
						$subtotal = $product->product_price*$product->product_sales_quantity;
						$total+=$subtotal;

						if($product->product_coupon!='no'){
							$product_coupon = $product->product_coupon;
						}else{
							$product_coupon = 'không mã';
						}		
			$output.='		
						<tr>
							<td>'.$product->product_name.'</td>
							<td>'.number_format($product->product_feeship,0,',','.').'đ'.'</td>
							<td>'.$product->product_sales_quantity.'</td>
							<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
							<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						</tr>';
					}
					if($coupon_feature==1){
						$total_after_coupon = ($total*$coupon_number)/100;
						$total_coupon = $total - $total_after_coupon;
					}else{
						$total_coupon = $total - $coupon_number;
					}
			$output.='				
					</tbody>
			</table>
			<p>Mã giảm giá:'.$product_coupon.' </p>
			<p>Tổng giảm:'.$coupon_echo.' </p>
			<p>Phí ship: '.number_format($product->product_feeship,0,',','.').'VNĐ '.'<i>(Lưu ý: Mã giảm giá không áp dụng cho cước phí này)<i></p>
			<p>Thanh toán : '.number_format($total_coupon + $product->product_feeship,0,',','.').'VNĐ'.'</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
					</tr>
					<tr>
						<th width="200px"><i>(Kí tên)</i></th>
						<th width="800px"><i>(Kí tên)</i></th>
					</tr>
				</thead>
				<tbody>';	
			$output.='				
					</tbody>
			</table>
			';
			return $output;
		}else{
			return redirect()->back()->send();
		}
    }
	//Cập nhật tình trạng đơn hàng
	public function update_order_status(Request $request){
		// $this->AuthLogin();
		$this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
			$data = $request->all();

			//Cập nhật tình trạng đơn hàng
			$order = OrderModel::find($data['order_id']);
			$order->order_status = $data['order_status'];//tình trạng
			$order->save();

			$order_product_id = $data['order_product_id'];//id sản phẩm
			$quantity = $data['quantity'];//số lượng
			//Trừ số lượng khi đã giao hàng
			if($order->order_status == 2){
				//$key là vị trí mảng, $ode_pro_id là giá trị tại vị trí đó
				foreach($order_product_id  as $key => $ode_pro_id){//lấy id sản phẩm trong đơn hàng đang mang
					$product = ProductModel::find($ode_pro_id);//tìm kiếm trong model và lấy sản phẩm có giá trị id $ode_pro_id
					$product_quantity = $product->product_quantity;//lấy giá trị số lượng hàng còn trong sản phẩm trong table
					$product_sold = $product->product_quantity_sold;//lấy giá trị số lượng hàng đã bán của sản phẩm trong table
					foreach($quantity as $key2 => $qty){//lấy số lượng sản phẩm đã đặt
						if($key == $key2){//nếu vị trí mảng trùng nhau , mang cùng một vị trí
							$pro_remain = $product_quantity - $qty;//Tính số lượng sản phẩm còn lại sau khi hoàn thành đơn hàng
							$product->product_quantity = $pro_remain;//gán giá trị sản phẩm còn lại trong kho thay cho giá trị hiện tại
							$product->product_quantity_sold = $product_sold + $qty;//Thêm số lượng sản phẩm đã bán vào sô lượng sản phẩm đã bán được
							$product->save();
						}
					}
				}
			}
			if($order->order_status == 3){
				//$key là vị trí mảng, $ode_pro_id là giá trị tại vị trí đó
				foreach($order_product_id  as $key => $ode_pro_id){//lấy id sản phẩm trong đơn hàng đang mang
					$product = ProductModel::find($ode_pro_id);//tìm kiếm trong model và lấy sản phẩm có giá trị id $ode_pro_id
					$product_quantity = $product->product_quantity;//lấy giá trị số lượng hàng còn trong sản phẩm trong table
					$product_sold = $product->product_quantity_sold;//lấy giá trị số lượng hàng đã bán của sản phẩm trong table
					foreach($quantity as $key2 => $qty){//lấy số lượng sản phẩm đã đặt
						if($key == $key2){//nếu vị trí mảng trùng nhau , mang cùng một vị trí
							$pro_remain = $product_quantity + $qty;//Tính số lượng sản phẩm còn lại sau khi hoàn thành đơn hàng
							$product->product_quantity = $pro_remain;//gán giá trị sản phẩm còn lại trong kho thay cho giá trị hiện tại
							$product->product_quantity_sold = $product_sold - $qty;//Thêm số lượng sản phẩm đã bán vào sô lượng sản phẩm đã bán được
							$product->save();
						}
					}
				}
			}
		
		}else{
            return redirect()->back()->send();
        }
	}
	//Cập nhật số lương đơn hàng
	public function update_order_quantity(Request $request){
		// $this->AuthLogin();
		$this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
			$data = $request->all();
			$order_details = OrderDetailModel::where('product_id',$data['order_product_id'])
			->where('order_code',$data['order_code'])->first();
			$order_details->product_sales_quantity = $data['order_qty']; 
			$order_details->save();
		}else{
            return redirect()->back()->send();
        }
	}
	// thùng rác --------------------------------------------------------------------
	// Hiển thị
    public function waste_basket_order(){
		// $this->AuthLogin();
		$this->AuthLogin_Auth();
        $check_position = $this->check_position_2();
        if($check_position == true){
			$order = OrderModel::orderby('created_at','DESC')
			->where('waste_basket_order',1)
			->paginate(5);
			return view('order.waste_basket_order')->with(compact('order'))
			->with('i',(request()->input('page',1)-1)*5);
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
    public function unactive_waste_basket_order($order_code){
        // $this->AuthLogin();
		$this->AuthLogin_Auth();
		$check_position = $this->check_position_2();
        if($check_position == true){
			OrderModel::where('order_code',$order_code)->update(['waste_basket_order'=>1]);
			Session::put('message','swal("Thông báo!", "Đã chuyển đơn hàng vào thùng rác!","success")');
			return Redirect::to('manager-order');
		}else{
			return redirect()->back()->send();
		}

    }
    //khôi phục
    public function active_waste_basket_order($order_code){
        // $this->AuthLogin();
		$this->AuthLogin_Auth();
		$check_position = $this->check_position_2();
        if($check_position == true){
			OrderModel::where('order_code',$order_code)->update(['waste_basket_order'=>0]);
			Session::put('message','swal("Thông báo!", "Đã khôi phục đơn hàng!","success")');
			return Redirect::to('waste-basket-order');
		}else{
            return redirect()->back()->send();
        }
    }
}

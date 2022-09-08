@extends('layout')
@section('content')
<section id="cart_items">
	<br>
	<h2 class="title-product-home">Giỏ hàng của bạn</h2>
	<hr>
	<div class="container">
		<div class="">
			<?php
				// echo'<pre>';
				// print_r(Session::get('coupon'));
				// //print_r(Session::get('cart'));
				// echo'</pre>';
			?>
				{{-- @if(session()->has('message'))
					<div class="alert alert-success">
						{{session()->get('message')}}
					</div>
				@elseif(session()->has('error'))
					<div class="alert alert-danger">
						{{session()->get('error')}}
					</div>
				@endif --}}
				<?php
				$message = Session::get("message");
				if($message){
					echo '<script type="text/javascript">window.setTimeout(function test(){'.$message.'},100);</script>';
					Session::put('message',null);
				
				?>
				<?php
				}
				?>
				<form action="{{url('/update-cart-ajax')}}" method="POST">
					@csrf
					
						@if(Session::get('cart')==true)
						<table class="table table-condensed border-danger">
							<thead>
								<tr class="th-show-cart">
									<th class="" style="width:10%">Hình ảnh</th>
									<th class="" style="width:33%">Tên sản phẩm</th>
									<th class="" style="width:14%">Số lượng trong kho</th>
									<th class="" style="width:15%">Giá</th>
									<th class="" style="width:10%">Số lượng mua</th>
									<th class="" style="width:11%">Tổng</th>
									<th  style="width:7%">Xóa</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$total = 0;
								?>
								@foreach(Session::get('cart') as $key => $cart)
								<?php
									$subtotal = $cart['product_price']*$cart['product_qty'];
									$total+=$subtotal;
								?>
								<tr class="td-show-cart">
									<td class="cart_product ">
										<a href=""><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" /></a>
									</td>
									<td class="cart_description down-the-line-name">
										<h4><a href=""></a></h4>
										<p class="">{{$cart['product_name']}}</p>
									</td>
									<td class="cart_description down-the-line-name">
										<h4><a href=""></a></h4>
										<p class="">{{$cart['product_quantity']}}</p>
									</td>
									<td class="cart_price">
										<p>{{number_format($cart['product_price'],0,',','.')}} VNĐ</p>
									</td>
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											{{ csrf_field() }}
											<input class="cart_quantity_input input-information-checkout" type="text" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
											<!-- <input type="hidden" value="" name="rowId_cart" class="form-control"> -->
										</div>
									</td>
									<td class="cart_total">
										<p class="cart_total_price">{{number_format($subtotal,0,',','.')}} VNĐ</p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete delete-show-cart" href="{{url('/delete-to-cart-ajax/'.$cart['session_id'])}}">Loại bỏ</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
							<div class="row">
								<div class="col-sm-2"></div>
								<div class="col-sm-7">
								</div>
								<div class="col-sm-3">
									<input class="check_out btn-cart-update-checkout" type="submit" value="Cập nhật số lượng sản phẩm" name="update_qty" class="btn btn-default btn-sm">
								</div>
							</div> 
								<div class="row">
									<div class="col-sm-1">
									</div>
									<div class="col-sm-8">
										<ul class="ul-cart-pagehome">
											<li class="li-cart-pagehome">&#8608; Tổng tiền: <span>{{number_format($total,0,',','.')}} VNĐ</span></li>
											<li class="li-cart-pagehome">
											@if(Session::get('coupon'))
													@foreach(Session::get('coupon') as $key =>$cou)
														@if($cou['coupon_feature'] == 1)
															&#8608; Được giảm: {{$cou['coupon_number']}} % số tiền
															<p>
																@php
																	$total_reduce = ($total*$cou['coupon_number'])/100;
																	$total_coupon = $total - $total_reduce;
																	echo'&#8608; Số tiền giảm: '.number_format($total_reduce,0,',','.').' VNĐ';
																	echo' &#8633; Tổng tiền còn lại sau khi giảm: '.number_format($total_coupon,0,',','.').' VNĐ</li>';
																@endphp
															</p>
															@php
																$total_after_coupon = $total_coupon;
															@endphp
														@elseif($cou['coupon_feature'] == 2)
															&#8608; Được giảm: {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
															<p>
																@php
																	$total_coupon = $total-$cou['coupon_number'];
																	echo' &#8608;Tổng tiền còn lại sau khi giảm: '.number_format($total_coupon,0,',','.').'VNĐ';
																@endphp
															</p>
															@php
																$total_after_coupon = $total_coupon;
															@endphp
														@endif
													@endforeach
												
											@endif
											</li>
											@if(Session::get('fee'))
												<li>
													&#8608; Phí vận chuyển: <span>{{number_format(Session::get('fee'),0,',','.')}} VNĐ <i>(Phí này không nằm trong mục được giảm giá)</i></span>
													<a class="cart_quantity_delete a-cart-checkout-pagehome" href="{{url('/cancel-fee')}}"><i class="fa fa-times"></i>Hủy phí vận chuyển</a>
												</li>
											@endif
											<li>&#8608; Thành tiền:
												@php 
													if(Session::get('fee') && !Session::get('coupon')){
														$total_after = $total + Session::get('fee');
														echo number_format($total_after,0,',','.').'VNĐ';
													}elseif(!Session::get('fee') && Session::get('coupon')){
														$total_after = $total_after_coupon;
														echo number_format($total_after,0,',','.').'VNĐ';
													}elseif(Session::get('fee') && Session::get('coupon')){
														$total_after = $total_after_coupon;
														$total_after = $total_after + Session::get('fee');
														echo number_format($total_after,0,',','.').'VNĐ';
													}elseif(!Session::get('fee') && !Session::get('coupon')){
														$total_after = $total;
														echo number_format($total_after,0,',','.').'VNĐ';
													}
												@endphp
											</li>		
										</ul>
									</div>
									<div class="col-sm-3"></div>
									
								</div>															
						@else
							<span class="center">
								<?php
									echo'<h5>Giỏ hàng trống !<i class="fa fa-shopping-cart"></i></h5>';
								?>
							</span>
						@endif
				</form>
				<div class="row all-function-pagehome">
					<div class="col-sm-1"></div>
					<div class="col-sm-7">
						@if(Session::get('cart'))
							<form method="POST" action="{{url('/check-coupon')}}">
								@csrf
									<p>
									<input type="text" class="coupon-cart-checkout-pagehome" name="coupon_code" placeholder="Nhập mã giảm giá">
									<input type="submit" class="check_out btn-coupon-cart-checkout-pagehome" name="check_coupon" value="Tính mã giảm giá"></a>
									</p>
							</form>
							<a class="check_out a-cart-checkout-pagehome" href="{{url('/delete-all-ajax')}}">Xóa tất cả sản phẩm</a>
							@if(Session::get('coupon'))
								<a class="check_out a-cart-checkout-pagehome" href="{{url('/reset-coupon')}}">Xóa mã khuyến mãi</a>
							@endif
						@endif
					</div>
					<div class="col-sm-4"></div>
				</div> 
		</div>
	</div>	
	<hr>
	{{-- XÁC NHẬN ĐƠN HÀNG --}}
	@if(Session::get('cart')==true)
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<form method="POST">
					@csrf
					<h2 class="title-product-home">Thông tin người nhận</h2>
					<label class="title-shipping-checkout-homepage" for="exampleInputPassword1"><i>(Thông tin người nhận có thế thay đổi nếu bạn muốn tặng quà cho người khác!)</i></label>
					@foreach($receiver as $key => $recei)
						<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Email người nhận</label>
						<input type="text" name="shipping_email" class="shipping_email input-information-checkout" placeholder="Điền Email" value="{{$recei->customer_email}}">
						<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Tên người nhận</label>
						<input type="text" name="shipping_name" class="shipping_name input-information-checkout"placeholder="Họ và tên" value="{{$recei->customer_name}}">
						<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Địa chỉ người nhận</label>
						<input type="text" name="shipping_address" class="shipping_address input-information-checkout" placeholder="Địa chỉ" value="{{$recei->customer_address}}">
						<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Số điện thoại</label>
						<input type="text" name="shipping_phone" class="shipping_phone input-information-checkout" placeholder="Số điện thoại" value="{{$recei->customer_phone}}">
					@endforeach
					<textarea name="shipping_notes" class="shipping_notes textarea-information-checkout" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
					<hr>
					<div class="row">
						<div class="col-sm-6">
							<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Phí ship</label>
							@if(Session::get('fee'))
								<input type="text" name="order_feeship" class="order_feeship input-information-checkout input-shipping-coupon" value="{{Session::get('fee')}}" readonly="false">
							@else
								<input type="text" name="order_feeship" class="order_feeship input-information-checkout input-shipping-coupon" value="" readonly="false">
							@endif
						</div>
						<div class="col-sm-6">
							<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Mã giảm giá</label>
							@if(Session::get('coupon'))
								@foreach(Session::get('coupon') as $key => $cou)
									<input type="text" name="order_coupon" class="order_coupon input-information-checkout input-shipping-coupon" value="{{$cou['coupon_code']}}" readonly="false">
								@endforeach
							@else
								<input type="text" name="order_coupon" class="order_coupon input-information-checkout input-shipping-coupon" value="không có" readonly="false">
							@endif
						</div>
					</div>
					<div class="">
						<div class="form-group">
							<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Chọn hình thức thanh toán</label>
							<select name="payment_select" class="form-control input-sm m-bot15 payment_select select-shipping-pagehome">
									<option value="0">Qua chuyển khoản</option>   
									<option value="1">Trả tiền mặt</option>
							</select>
						</div>
					</div>
					@if(Session::get('customer_id'))
					<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn-cart-update-checkout send_order"> 
					@else
						<p></p>
						<a class="check_out m-	t-3 a-cart-checkout-pagehome" href="{{url('/login-checkout')}}">Xác nhận đơn hàng</a>
					@endif
					
				</form>
			</div>
			<div class="col-sm-6">
				<form>
					@csrf 
					<div class="form-group">
						<h2 class="title-product-home">Thông tin Ship hàng</h2>
						<label class="title-shipping-checkout-homepage" for="exampleInputPassword1"><i>(Vui lòng chọn để tính phí ship hàng!)</i></label>
						<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Chọn thành phố</label>
						<select name="province" id="province" class="form-control input-sm m-bot15 province choose select-shipping-pagehome">
							<!--
								thêm provice choose sau tên class để tránh trùng tên với các hàm trong js và css
								đồng thời giúp chương trình ajax tránh bị lỗi.
							-->
								<option class="option-shipping-pagehome" value="">--Chọn tỉnh thành phố--</option>
							@foreach($province as $key => $pro)
								<option class="option-shipping-pagehome" value="{{$pro->province_id}}">{{$pro->province_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Chọn quận huyện</label>
						<select name="district" id="district" class="form-control input-sm m-bot15 district choose select-shipping-pagehome">
								<option class="option-shipping-pagehome"  value="">--Chọn quận huyện--</option>
						</select>
					</div>
					<div class="form-group">
						<label class="title-shipping-checkout-homepage" for="exampleInputPassword1">Chọn xã phường</label>
						<select name="town" id="town" class="form-control input-sm m-bot15 town select-shipping-pagehome">
								<option class="option-shipping-pagehome" value="">--Chọn xã phường--</option>   
						</select>
					</div>
					<br>
					<input type="button" value="Tính phí vận chuyển" name="calculator_order" class="btn-cart-update-checkout calculate_delivery">
				</form>
				<hr>
			</div>
		</div>
	</div>
	@endif










		{{-- <div class="container">
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<h2 class="title-product-home">Điền thông tin gửi hàng</h2>
							<div class="form-one">
								<form method="POST">
									@csrf
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Điền Email">
									<input type="text" name="shipping_name" class="shipping_name"placeholder="Họ và tên">
									<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
									<textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
									<hr>
									@if(Session::get('fee'))
										<input type="text" name="order_feeship" class="order_feeship" value="{{Session::get('fee')}}" readonly="false">
									@else
										<input type="text" name="order_feeship" class="order_feeship" value="10000" readonly="false">
									@endif

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $cou)
											<input type="text" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}" readonly="false">
										@endforeach
									@else
										<input type="text" name="order_coupon" class="order_coupon" value="không có" readonly="false">
									@endif
									
									<div class="">
										<div class="form-group">
											<label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
											<select name="payment_select" class="form-control input-sm m-bot15 payment_select">
													<option value="0">Qua chuyển khoản</option>   
													<option value="1">Trả tiền mặt</option>
											</select>
										</div>
									</div>
									<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order"> 
								</form>
								<form>
                                    @csrf 
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn thành phố</label>
                                        <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                            <!--
                                                thêm provice choose sau tên class để tránh trùng tên với các hàm trong js và css
                                                đồng thời giúp chương trình ajax tránh bị lỗi.
                                            -->
                                                <option value="">--Chọn tỉnh thành phố--</option>
                                            @foreach($province as $key => $pro)
                                                <option value="{{$pro->province_id}}">{{$pro->province_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn quận huyện</label>
                                        <select name="district" id="district" class="form-control input-sm m-bot15 district choose">
                                                <option value="">--Chọn quận huyện--</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn xã phường</label>
                                        <select name="town" id="town" class="form-control input-sm m-bot15 town">
                                                <option value="">--Chọn xã phường--</option>   
                                        </select>
                                    </div>
                                    <input type="button" value="Tính phí vận chuyển" name="calculator_order" class="btn btn-primary btn-sm calculate_delivery">
                                </form>
							</div>
						</div>
					</div>
					<div class="col-sm-12 clearfix">
						<div class="table-responsive cart_info">
							<?php
								// echo'<pre>';
								// print_r(Session::get('coupon'));
								// //print_r(Session::get('cart'));
								// echo'</pre>';
							?>
							@if(session()->has('message'))
								<div class="alert alert-success">
									{{session()->get('message')}}
								</div>
							@elseif(session()->has('error'))
								<div class="alert alert-danger">
									{{session()->get('error')}}
								</div>
							@endif
							<form action="{{url('/update-cart-ajax')}}" method="POST">
								@csrf
								<table class="table table-condensed">
									<thead>
										<tr class="cart_menu">
											<td class="image">Hình ảnh</td>
											<td class="description">Tên sp</td>
											<td class="price">Giá</td>
											<td class="quantity">Số lượng</td>
											<td class="total">Tổng</td>
											<td></td>
										</tr>
									</thead>
									@if(Session::get('cart')==true)
										<tbody>
											<?php
												$total = 0;
											?>
											@foreach(Session::get('cart') as $key => $cart)
												<?php
													$subtotal = $cart['product_price']*$cart['product_qty'];
													$total+=$subtotal;
												?>
												<tr>
													<td class="cart_product">
														<a href=""><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" /></a>
													</td>
													<td class="cart_description">
														<h4><a href=""></a></h4>
														<p>{{$cart['product_name']}}</p>
													</td>
													<td class="cart_price">
														<p>{{number_format($cart['product_price'],0,',','.')}}VNĐ</p>
													</td>
													<td class="cart_quantity">
														<div class="cart_quantity_button">
															{{ csrf_field() }}
															<input class="cart_quantity_input" type="text" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
															<!-- <input type="hidden" value="" name="rowId_cart" class="form-control"> -->
														</div>
													</td>
													<td class="cart_total">
														<p class="cart_total_price">{{number_format($subtotal,0,',','.')}}VNĐ</p>
													</td>
													<td class="cart_delete">
														<a class="cart_quantity_delete" href="{{url('/delete-to-cart-ajax/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
													</td>
												</tr>
											@endforeach
											<tr>
												<td>
													<input class="btn btn-default check_out" type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
												</td>
												<td><a class="btn btn-default check_out" href="{{url('/delete-all-ajax')}}">Xóa tất cả sản phẩm</a></td>
												<td>
													@if(Session::get('coupon'))
														<a class="btn btn-default check_out" href="{{url('/reset-coupon')}}">Xóa mã khuyến mãi</a>
													@endif
												</td>
												<td>
													<li>Tổng tiền: <span>{{number_format($total,0,',','.')}}VNĐ</span></li>
													
													@if(Session::get('coupon'))
													<li>
														@foreach(Session::get('coupon') as $key =>$cou)
															@if($cou['coupon_feature'] == 1)
																Giảm: {{$cou['coupon_number']}} %
																<p>
																	@php
																		$total_reduce = ($total*$cou['coupon_number'])/100;
																		$total_coupon = $total - $total_reduce;
																		//echo'<li>Số tiền giảm:'.number_format($total_reduce,0,',','.').'VNĐ</li>';
																		//echo'<li>Tổng tiền còn lại:'.number_format($total_coupon,0,',','.').'VNĐ</li>';
																	@endphp
																</p>
																@php
																	$total_after_coupon = $total_coupon;
																@endphp
															@elseif($cou['coupon_feature'] == 2)
																Giảm: {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
																<p>
																	@php
																		$total_coupon = $total-$cou['coupon_number'];
																		//echo'<li>Số tiền giảm:'.number_format($cou['coupon_number'],0,',','.').'VNĐ</li>';
																		//echo'<li>Tổng tiền còn lại:'.number_format($total_coupon,0,',','.').'VNĐ</li>';
																	@endphp
																</p>
																@php
																	$total_after_coupon = $total_coupon;
																@endphp
															@endif
														@endforeach
													</li>
													@endif
													<!-- <li>Thuế <span></span></li> -->
													@if(Session::get('fee'))
														<li>
															Phí vận chuyển: <span>{{number_format(Session::get('fee'),0,',','.')}} VNĐ</span>
															<a class="cart_quantity_delete" href="{{url('/cancel-fee')}}"><i class="fa fa-times"></i>Hủy phí vận chuyển</a>
														</li>
													@endif
													<li>Thành tiền:
														@php 
															if(Session::get('fee') && !Session::get('coupon')){
																$total_after = $total + Session::get('fee');
																echo number_format($total_after,0,',','.').'VNĐ';
															}elseif(!Session::get('fee') && Session::get('coupon')){
																$total_after = $total_after_coupon;
																echo number_format($total_after,0,',','.').'VNĐ';
															}elseif(Session::get('fee') && Session::get('coupon')){
																$total_after = $total_after_coupon;
																$total_after = $total_after + Session::get('fee');
																echo number_format($total_after,0,',','.').'VNĐ';
															}elseif(!Session::get('fee') && !Session::get('coupon')){
																$total_after = $total;
																echo number_format($total_after,0,',','.').'VNĐ';
															}
														@endphp
													</li>														
												</td>	
											</tr>
												
										</tbody>
									@else
										<tr>
											<td colspan="5">
												<center>
													<?php
														echo'Giỏ hàng trống';
													?>
													<i class="fa fa-shopping-cart"></i>
												</center>
											</td>
										</tr>
									@endif
								</table>
							</form>
							<table class="table table-condensed">
								@if(Session::get('cart'))
								<tr>
									<td colspan="3">
										<form method="POST" action="{{url('/check-coupon')}}">
											@csrf
											<input type="text" class="form-control" name="coupon_code" placeholder="Nhập mã giảm giá">
											<input type="submit" class="btn btn-default check_out" name="check_coupon" value="Tính mã giảm giá"></a>
										</form>
									</td>
									<td colspan="9"></td>
								</tr>
								@endif
							</table>
						</div>
					</div>













					
							
				</div>
			</div>
		</div> --}}
</section> <!--/#cart_items-->

@endsection
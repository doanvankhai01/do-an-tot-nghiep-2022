@extends('layout')
@section('content')
<hr>
<h2 class="title-product-home">Giỏ hàng của bạn</h2>
<section id="cart_items">
	<div class="container">
		<div class="">
				{{-- @if(session()->has('message'))
					<div class="alert alert-success">
						{!!session()->get('message')!!}
					</div>
				@elseif(session()->has('error'))
					<div class="alert alert-danger">
						{!!session()->get('error')!!}
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
								<div class="col-sm-6">
								</div>
								<div class="col-sm-4">
									@if(Session::get('coupon'))
										<a class="check_out a-cart-checkout-pagehome" href="{{url('/reset-coupon')}}">Xóa mã khuyến mãi</a>
									@endif
									@if(Session::get('customer_id'))
										<a class="check_out a-cart-checkout-pagehome" href="{{url('/checkout')}}">Đặt hàng</a>
									@else
										<a class="check_out a-cart-checkout-pagehome" href="{{url('/login-checkout')}}">Đặt hàng</a>
									@endif
									<input class="check_out btn-cart-update-checkout" type="submit" value="Cập nhật số lượng sản phẩm" name="update_qty" class="btn btn-default btn-sm">
								</div>
							</div> 
								{{-- <div class="row">
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
													@elseif($cou['coupon_feature'] == 2)
														&#8608; Được giảm: {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
														<p>
															@php
																$total_coupon = $total-$cou['coupon_number'];
																echo' &#8608;Tổng tiền còn lại sau khi giảm: '.number_format($total_coupon,0,',','.').'VNĐ';
															@endphp
														</p>
													@endif
												@endforeach
												
											@endif
											</li>
											<!-- <li>Thuế <span></span></li>
											<li>Phí vận chuyển <span>Free</span></li>
											<li>Tổng tiền đã thêm thuế <span></span></li> -->	
											<!-- <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a> -->
										</ul>
									</div>
									<div class="col-sm-3"></div>
									
								</div>															 --}}
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
						{{-- @if(Session::get('cart'))
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
							@if(Session::get('customer_id'))
								<a class="check_out a-cart-checkout-pagehome" href="{{url('/checkout')}}">Đặt hàng</a>
							@else
								<a class="check_out a-cart-checkout-pagehome" href="{{url('/login-checkout')}}">Đặt hàng</a>
							@endif
						@endif --}}
					</div>
					<div class="col-sm-4"></div>
				</div> 
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection
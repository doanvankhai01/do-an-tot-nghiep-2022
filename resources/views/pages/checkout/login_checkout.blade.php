@extends('layout')
@section('content')
<hr>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2 class="title-product-home">Đăng nhập tài khoản</h2>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{csrf_field()}}
							<input class="input-login-regiter-customer" type="text" name="email_account" placeholder="Tài khoản" />
							<input class="input-login-regiter-customer" type="password" name="password_account" placeholder="Password" />
							<button type="submit" class="btn-login-regiter-customer">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2 class="title-product-home">Đăng ký</h2>
						<form action="{{URL::to('/add-customer')}}" method="POST">
							{{ csrf_field() }}
							<input class="input-login-regiter-customer" type="text" name="customer_name" placeholder="Họ và tên"/>
							<input class="input-login-regiter-customer" type="email" name="customer_email" placeholder="Địa chỉ email"/>
							<input class="input-login-regiter-customer" type="password" name="customer_password" placeholder="Mật khẩu"/>
							<input class="input-login-regiter-customer" type="text" name="customer_phone" placeholder="Phone"/>
							<input class="input-login-regiter-customer" type="text" name="customer_address" placeholder="Địa chỉ"/>
							<button type="submit" class="btn-login-regiter-customer">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection
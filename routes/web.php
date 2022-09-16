<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;    
use App\Http\Controllers\AdminController;   
use App\Http\Controllers\AccountController; 
use App\Http\Controllers\CustomerController; 
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\BrandController; 
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CartController; 
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderBannerController;
use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\VisitorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {/* đường dẫn trống gọi tới trang layout.bland.php trong foder views*/
//     return view('layout');
// });
// Route::get('/trang-chu', function () {/* đường dẫn trống gọi tới trang layout.bland.php trong foder views*/
//     return view('layout');
// });

//HomeController---------------------------------------------------------------------------------------------------
Route::get('/', [HomeController::class,'index']);
Route::get('/trang-chu', [HomeController::class,'index']);
Route::post('/tim-kiem-theo-ten-san-pham-tren-page', [HomeController::class,'search']);
Route::get('/full-all-show-product', [HomeController::class,'full_all_show_product']);
//Phân loại sản phẩm theo danh mục và thương hiệu
Route::get('/danh-muc-san-pham/{category_id}', [HomeController::class,'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [HomeController::class,'show_brand_home']);
//Chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_id}', [HomeController::class,'details_product']);
//email
Route::get('/send-mail', [HomeController::class,'send_mail']);
//tìm kiếm tự động trên trang chủ
Route::post('/autocomplete-search-ajax', [HomeController::class,'autocomplete_search_ajax']);

//StatisticalController----------------------------------------------------------------------------
Route::post('/filter-statistical-by-day', [StatisticalController::class,'filter_statistical_by_day']);
Route::post('/load-sixty-day-statistical', [StatisticalController::class,'load_sixty_day_statistical']);
Route::post('/filter-statistical', [StatisticalController::class,'filter_statistical']);
Route::post('/show-visitor', [StatisticalController::class,'show_visitor']);
//AdminController--------------------------------------------------------------------------------------------------
Route::get('/admin', [AdminController::class,'index']);
Route::get('/dashboard', [AdminController::class,'show_dashboard']);
//Đăng nhập đăng xuất
Route::post('/admin-dashboard', [AdminController::class,'dashboard']);
Route::get('/log-out', [AdminController::class,'log_out']);


Route::get('/all-admin', [AdminController::class,'all_admin']);
Route::get('/add-admin', [AdminController::class,'add_admin']);
Route::post('/save-admin', [AdminController::class,'save_admin']);
// Route::get('/edit-admin/{admin_id}', [AdminController::class,'edit_admin']);
Route::post('/edit-admin', [AdminController::class,'edit_admin']);
Route::post('/update-admin', [AdminController::class,'update_admin']);
Route::post('/search-admin', [AdminController::class,'search_admin']);
Route::post('/autocomplete-search-admin-ajax', [AdminController::class,'autocomplete_search_admin_ajax']);

//thùng rác
Route::post('/unactive-waste-basket-admin', [AdminController::class,'unactive_waste_basket_admin']);
Route::post('/active-waste-basket-admin', [AdminController::class,'active_waste_basket_admin']);
Route::get('/waste-basket-admin', [AdminController::class,'waste_basket_admin']);

//NotificationController ============================================================
Route::post('/notification-product', [NotificationController::class,'notification_product']);
Route::post('/notification-new-order', [NotificationController::class,'notification_new_order']);
Route::post('/notification-view-order', [NotificationController::class,'notification_view_order']);

// AccountController ==============================================================================
//Trang quản lý admin
Route::get('/add-admin_account', [AccountController::class,'add_admin_account']);
Route::get('/all-admin_account', [AccountController::class,'all_admin_account']);
Route::post('/save-admin_account', [AccountController::class,'save_admin_account']);
//Hiển thị chi tiết và sửa xóa tài khoản admin
Route::get('/edit-admin_account/{admin_id}', [AccountController::class,'edit_admin_account']);
Route::post('/update-admin_account/{admin_id}', [AccountController::class,'update_admin_account']);
Route::get('/delete-admin_account/{admin_id}', [AccountController::class,'delete_admin_account']);

// CustomerController ==============================================================================
//Trang quản lý user
Route::get('/add-customer-account', [CustomerController::class,'add_customer_account']);
Route::get('/all-customer-account', [CustomerController::class,'all_customer_account']);
Route::post('/save-customer_account', [CustomerController::class,'save_customer_account']);
//Hiển thị chi tiết và sửa xóa tài khoản user
Route::get('/edit-customer-account/{customer_id}', [CustomerController::class,'edit_customer_account']);
Route::post('/update-customer-account/{customer_id}', [CustomerController::class,'update_customer_account']);
Route::get('/delete-customer-account/{customer_id}', [CustomerController::class,'delete_customer_account']);



//CategoryController--------------------------------------------------------------------------------------------------
Route::get('/add-category-product', [CategoryController::class,'add_category_product']);
Route::get('/all-category-product', [CategoryController::class,'all_category_product']);
Route::post('/save-category-product', [CategoryController::class,'save_category_product']);
//Bật tắt danh mục sản phẩm
Route::get('/active-category-product/{category_product_id}', [CategoryController::class,'active_category_product']);
Route::get('/unactive-category-product/{category_product_id}', [CategoryController::class,'unactive_category_product']);
//Hiển thị chi tiết và sửa xóa danh mục sản phẩm
Route::get('/edit-category-product/{category_product_id}', [CategoryController::class,'edit_category_product']);
// Route::post('/update-category-product/{category_product_id}', [CategoryController::class,'update_category_product']);
Route::post('/update-category-product', [CategoryController::class,'update_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryController::class,'delete_category_product']);
// Thùng rác
Route::get('/waste-basket-category', [CategoryController::class,'all_waste_basket_category']);
Route::get('/active-waste-basket-category/{category_id}', [CategoryController::class,'active_waste_basket_category']);
Route::get('/unactive-waste-basket-category/{category_id}', [CategoryController::class,'unactive_waste_basket_category']);

//BrandController----------------------------------------------------------------------------------------------
Route::get('/add-brand-product', [BrandController::class,'add_brand_product']);
Route::get('/all-brand-product', [BrandController::class,'all_brand_product']);
Route::post('/save-brand-product', [BrandController::class,'save_brand_product']);
//Bật tắt thương hiệu sản phẩm
Route::get('/active-brand-product/{brand_product_id}', [BrandController::class,'active_brand_product']);
Route::get('/unactive-brand-product/{brand_product_id}', [BrandController::class,'unactive_brand_product']);
//Hiển thị chi tiết và sửa xóa thương hiệu sản phẩm
Route::get('/edit-brand-product/{brand_product_id}', [BrandController::class,'edit_brand_product']);
// Route::post('/update-brand-product/{brand_product_id}', [BrandController::class,'update_brand_product']);
Route::post('/update-brand-product', [BrandController::class,'update_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandController::class,'delete_brand_product']);

//ProductController----------------------------------------------------------------------------------------------------------
Route::get('/add-product', [ProductController::class,'add_product']);
Route::get('/all-product', [ProductController::class,'all_product']);
Route::post('/save-product', [ProductController::class,'save_product']);
//Bật tắt sản phẩm
Route::get('/active-product/{product_id}', [ProductController::class,'active_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class,'unactive_product']);
//Hiển thị chi tiết và sửa xóa sản phẩm
Route::get('/edit-product/{product_id}', [ProductController::class,'edit_product']);
Route::post('/update-product/{product_id}', [ProductController::class,'update_product']);
Route::get('/delete-product/{product_id}', [ProductController::class,'delete_product']);
//Tìm kiếm 
Route::post('/search-product-on-admin-layout', [ProductController::class,'search_product_on_admin_layout']);
//Tìm kiếm tự động
Route::post('/autocomplete-search-product-admin-ajax', [ProductController::class,'autocomplete_search_product_admin_ajax']);
//Thùng rác
Route::get('/waste-basket-product', [ProductController::class,'waste_basket_product']);
Route::get('/active-waste-basket-product/{slider_id}', [ProductController::class,'active_waste_basket_product']);
Route::get('/unactive-waste-basket-product/{slider_id}', [ProductController::class,'unactive_waste_basket_product']);


// GalleryController----------------------------------------------------------------------------------------
Route::get('/manager-gallery/{product_id}', [GalleryController::class,'manager_gallery']);
Route::post('/all-gallery', [GalleryController::class,'all_gallery']);
Route::post('/add-gallery/{product_id}', [GalleryController::class,'add_gallery']);
Route::post('/update-name-gallery', [GalleryController::class,'update_name_gallery']);
Route::post('/update-image-gallery', [GalleryController::class,'update_image_gallery']);
Route::post('/delete-gallery', [GalleryController::class,'delete_gallery']);
//CouponController------------------------------------------------------------------------------------------------------------
Route::get('/add-coupon', [CouponController::class,'add_coupon']);
Route::post('/save-coupon', [CouponController::class,'save_coupon']);
Route::get('/all-coupon', [CouponController::class,'all_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class,'delete_coupon']);
//Thùng rác
Route::get('/waste-basket-coupon', [CouponController::class,'waste_basket_coupon']);
Route::get('/active-waste-basket-coupon/{coupon_id}', [CouponController::class,'active_waste_basket_coupon']);
Route::get('/unactive-waste-basket-coupon/{coupon_id}', [CouponController::class,'unactive_waste_basket_coupon']);

//CartController-giỏ hàng--------------------------------------------------------------------------------------------------------------
Route::post('/save-cart', [CartController::class,'save_cart']);
Route::get('/show-cart', [CartController::class,'show_cart']);
Route::get('/delete-to-cart/{rowId}', [CartController::class,'delete_to_cart']);
Route::post('/update-cart-quantity', [CartController::class,'update_cart_quantity']);
//Giỏ hàng ajax
Route::post('/add-cart-ajax', [CartController::class,'add_cart_ajax']);
Route::get('/show-cart-ajax', [CartController::class,'show_cart_ajax']);
Route::post('/update-cart-ajax', [CartController::class,'update_cart_ajax']);
Route::get('/delete-to-cart-ajax/{session_id}', [CartController::class,'delete_to_cart_ajax']);
Route::get('/delete-all-ajax', [CartController::class,'delete_all_ajax']);
//Coupon
Route::post('/check-coupon', [CartController::class,'check_coupon']);
Route::get('/reset-coupon', [CartController::class,'reset_coupon']);

//CheckoutController-thanh toán--------------------------------------------------------------------------------------------------------
//đăng nhập đăng kí đăng xuất
Route::post('/login-customer', [CheckoutController::class,'login_customer']);
Route::get('/login-checkout', [CheckoutController::class,'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class,'logout_checkout']);
Route::post('/add-customer', [CheckoutController::class,'add_customer']);
Route::get('/checkout', [CheckoutController::class,'checkout']);
Route::post('/save-checkout-customer', [CheckoutController::class,'save_checkout_customer']);
Route::get('/payment', [CheckoutController::class,'payment']);
Route::post('/order-place', [CheckoutController::class,'order_place']);
//Xử lí hiển thị tỉnh thành tại trang checkout-giỏ hàng
Route::post('/select-delivery-page-home', [CheckoutController::class,'select_delivery_page_home']);
Route::post('/calculate-delivery-fee', [CheckoutController::class,'calculate_delivery_fee']);
Route::get('/cancel-fee', [CheckoutController::class,'cancel_fee']);//Hủy phí vận chuyển
//Xử lí đặt hàng bằng ajax
Route::post('/confirm-order', [CheckoutController::class,'confirm_order']);


//OrderController-------------------------------------------------------------------------------------------------------------------
//Quản lí đơn hàng
// Route::get('/manager-order', [CheckoutController::class,'manager_order']);
// Route::get('/view-order/{order_id}', [CheckoutController::class,'view_order']);

Route::get('/manager-order', [OrderController::class,'manager_order']);
Route::get('/view-order/{order_code}', [OrderController::class,'view_order']);
Route::get('export-order/{checkout_code}', [OrderController::class,'export_order']);
//Xử lí số lượng đơn hàng
Route::post('update-order-status', [OrderController::class,'update_order_status']);
Route::post('update-order-quantity', [OrderController::class,'update_order_quantity']);
//Tìm kiếm đơn hàng
Route::post('/search-order-on-admin-layout', [OrderController::class,'search_order_on_admin_layout']);
//Tìm kiếm tự động
Route::post('/autocomplete-search-order-admin-ajax', [OrderController::class,'autocomplete_search_order_admin_ajax']);
// Thùng rác
Route::get('/waste-basket-order', [OrderController::class,'waste_basket_order']);
Route::get('/active-waste-basket-order/{order_code}', [OrderController::class,'active_waste_basket_order']);
Route::get('/unactive-waste-basket-order/{order_code}', [OrderController::class,'unactive_waste_basket_order']);
//Delivery AJAX----------------------------------------------------------------------------------------------------------------------
Route::get('/manager-delivery', [DeliveryController::class,'manager_delivery']);
Route::post('/select-delivery', [DeliveryController::class,'select_delivery']);
Route::post('/select-information-delivery', [DeliveryController::class,'select_information_delivery']);
Route::post('/insert-delivery', [DeliveryController::class,'insert_delivery']);
Route::post('/load-delivery', [DeliveryController::class,'load_delivery']);
Route::post('/update-delivery', [DeliveryController::class,'update_delivery']);

//SliderBannerController----------------------------------------------------------------------------------------------------------------
Route::get('/manager-slider', [SliderBannerController::class,'manager_slider']);
Route::get('/add-slider', [SliderBannerController::class,'add_slider']);
Route::post('/save-slider', [SliderBannerController::class,'save_slider']);
Route::get('/unactive-slider/{slider_id}', [SliderBannerController::class,'unactive_slider']);
Route::get('/active-slider/{slider_id}', [SliderBannerController::class,'active_slider']);
Route::get('/delete-slider/{slider_id}', [SliderBannerController::class,'delete_slider']);
// Thùng rác
Route::get('/all-waste-basket-slider', [SliderBannerController::class,'all_waste_basket_slider']);
Route::get('/active-waste-basket-slider/{slider_id}', [SliderBannerController::class,'active_waste_basket_slider']);
Route::get('/unactive-waste-basket-slider/{slider_id}', [SliderBannerController::class,'unactive_waste_basket_slider']);



// Authentication roles -phân quyền
Route::get('/register-auth',[AuthController::class,'register_auth']);
Route::post('/register',[AuthController::class,'register']);
Route::get('/log-out-auth',[AuthController::class,'log_out_auth']);
Route::get('/login-auth',[AuthController::class,'login_auth']);
Route::post('/login-at-auth',[AuthController::class,'login_at_auth']);
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\FormData;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;
use Session ;
session_start();
class ProductController extends Controller
{
    //Kiểm tra đăng nhập
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            Session::put('message','Vui lòng đăng nhập quyền Admin!');
            return Redirect::to('admin')->send();
        }
    }
    //Hiển thị form thêm sản phẩm
    public function add_product(){
        $this->AuthLogin();
        $cate_product = CategoryModel::orderby('category_id','desc')
        ->where('waste_basket_category',0)
        ->where('category_status',0)->get(); 
        $brand_product = BrandModel::orderby('brand_id','desc')
        // ->where('waste_basket_brand',0)
        ->where('brand_status',0)->get(); 
        return view('product.add_product')->with('cate', $cate_product)->with('brand',$brand_product);
    }
    //Hiển thị ra tất cả sản phẩm
    public function all_product(){
        $this->AuthLogin();
        // cách 1---------------------------------
    	// $all_product = ProductModel::orderby('tbl_product.product_id','desc')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//Hiển thị tên danh mục
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')//Hiển thị tên thương hiệu
        // ->where('waste_basket_product',0)
        // ->paginate(10);
        // Cách 2-------------------------------khộng chạy huhu
        // $all_product = ProductModel::orderby('product_id','desc')
        // ->with('category_model')
        // ->with('brand_model')
        // ->where('waste_basket_product',0)
        // ->paginate(10);


         // Lọc sản phẩm
         if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];//Lấy giá trị của ?sort_by trong đường dẫn
            if($sort_by=='tang_dan'){

                $all_product = ProductModel::orderby('product_price','asc')
                ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//Hiển thị tên danh mục
                ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')//Hiển thị tên thương hiệu
                ->where('waste_basket_product',0)
                ->paginate(10)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn
            }elseif($sort_by=='giam_dan'){

                $all_product = ProductModel::orderby('product_price','desc')
                ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//Hiển thị tên danh mục
                ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')//Hiển thị tên thương hiệu
                ->where('waste_basket_product',0)
                ->paginate(10)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn
            }elseif($sort_by=='a_den_z'){
        
                $all_product = ProductModel::orderby('product_name','asc')
                ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//Hiển thị tên danh mục
                ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')//Hiển thị tên thương hiệu
                ->where('waste_basket_product',0)
                ->paginate(10)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn
            }elseif($sort_by=='z_den_a'){

                $all_product = ProductModel::orderby('product_name','desc')
                ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//Hiển thị tên danh mục
                ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')//Hiển thị tên thương hiệu
                ->where('waste_basket_product',0)
                ->paginate(10)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn
            }
        }else{
 
            $all_product = ProductModel::orderby('product_id','desc')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//Hiển thị tên danh mục
            ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')//Hiển thị tên thương hiệu
            ->where('waste_basket_product',0)
            ->paginate(10);
        }
        // end lọc sản phẩm

    	return view('product.all_product')
        ->with('all_product', $all_product)
        ->with('i',(request()->input('page',1)-1)*10);
         //Cho i là số thứ tự khi phân trang
        //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
        //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
        //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
        //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 

    }



    //Thêm sản phẩm
    public function save_product(Request $request){
        $this->AuthLogin();
        // $data = array();
        // $data['product_name'] = $request->product_name;
        // $data['product_slug'] = $request->product_slug;
        // $data['product_price'] = $request->product_price;
        // $data['product_desc'] = $request->product_desc;
        // $data['product_content'] = $request->product_content;
        // $data['category_id'] = $request->product_cate;
        // $data['brand_id'] = $request->product_brand;
        // $data['product_status'] = $request->product_status;
        // $get_image = $request->file('product_image');

        $data = $request->all();
        $product = new ProductModel();
        $product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $product->product_status = $data['product_status'];
        $product->product_quantity = $data['product_quantity'];
        $product->waste_basket_product = 0;
        $product->product_quantity_sold = 0;
        $get_image = $request->file('product_image');
        
        $path_image_product = 'public/uploads/product';
        $path_image_gallery = 'public/uploads/gallery';

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();//lấy cả tên và đuôi file
            $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
            $new_image =$name_image.rand(0,999999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path_image_product,$new_image);
            // $data['product_image'] = $new_image;
            $product->product_image = $new_image;
            // DB::table('tbl_product')->insert($data);
            $product->save();

            $product_id = $product->id();
            
            Session::put('message','swal("Thêm sản phẩm thành công!", "Thêm sản phẩm thành công!","success")');
            return Redirect::to('all-product');
        }else{
            
            Session::put('message','swal("Không thể thêm sản phẩm!", "Sản phẩm không có hình ảnh!","error")');
            return redirect()->back();
        }
        
    }
    //Thêm sản phẩm ajax
    // public function save_product(Request $request){
    //     $this->AuthLogin();
    //     $data = $request->all();

    //     $product = new ProductModel();
    //     $product->product_name = $data['product_name'];
    //     $product->product_slug = $data['product_slug'];
    //     $product->product_price = $data['product_price'];
    //     $product->product_desc = $data['product_desc'];
    //     $product->product_content = $data['product_content'];
    //     $product->category_id = $data['category_id'];
    //     $product->brand_id = $data['brand_id'];
    //     $product->product_status = $data['product_status'];
    //     $product->product_quantity = $data['product_quantity'];
    //     $product->waste_basket_product = 0;
    //     $product->product_quantity_sold = 0;
    //     $formdata = new FormData();
    //     $get_image =  $formdata.get('product_image');
    //     // echo('<pre style="font-weight:bold;color:blue; position: absolute;z-index:9999;">');
	// 	// echo('<script>alert("'.$get_image.'");</script>');
	// 	// echo('</pre>');
    //     if($get_image){
    //         Session::put('message','swal("Có ảnh!", "Có ảnh !","error")');
    //         $get_name_image = $get_image->getClientOriginalName();//lấy cả tên và đuôi file
    //         $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
    //         $new_image =$name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
    //         $get_image->move('public/uploads/product',$new_image);
    //         // $data['product_image'] = $new_image;
    //         $product->product_image = $new_image;
    //         // DB::table('tbl_product')->insert($data);
    //         $product->save();
    //     }else{
    //         Session::put('message','swal("Không thể thêm sản phẩm!", "Sản phẩm không có hình ảnh!","error")');
    //         return redirect()->back();
    //     }
        
    // }
    //Hiện sản phẩm
    public function active_product($product_id){
        $this->AuthLogin();
        ProductModel::where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','swal("Hiện sản phẩm!", "","success")');
        return Redirect::to('all-product');
    }
    //Ẩn sản phẩm
    public function unactive_product($product_id){
        $this->AuthLogin();
        ProductModel::where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','swal("Ẩn sản phẩm!", "","error")');
        return Redirect::to('all-product');
    }
    //Chi tiết sản phẩm
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = CategoryModel::orderby('category_id','desc')
        ->where('waste_basket_category',0)
        ->where('category_status',0)->get(); 
        $brand_product = BrandModel::orderby('brand_id','desc')
        // ->where('waste_basket_brand',0) 
        ->where('brand_status',0)->get(); 
        $edit_product = ProductModel::where('product_id',$product_id)->get();
        $manager_product  = view('product.edit_product')
        ->with('edit_product',$edit_product)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin.admin_layout')->with('product.edit_product', $manager_product);
    }
    //Cập nhật sản phẩm
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        // $data = array();
        // $data['product_name'] = $request->product_name;
        // $data['product_slug'] = $request->product_slug;
        // $data['product_price'] = $request->product_price;
        // $data['product_desc'] = $request->product_desc;
        // $data['product_content'] = $request->product_content;
        // $data['category_id'] = $request->product_cate;
        // $data['brand_id'] = $request->product_brand;
        // $data['product_status'] = $request->product_status;
        // $get_image = $request->file('product_image');
        $data = $request->all();
        $product = ProductModel::find($product_id);;
        $product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $product->product_status = $data['product_status'];
        $product->product_quantity = $data['product_quantity'];
        $product->waste_basket_product = 0;
        $get_image = $request->file('product_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();//lấy cả tên và đuôi file
            $name_image = current(explode('.',$get_name_image));//lấy phần tên trước dấu ."chấm"
            $new_image =$name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            // $data['product_image'] = $new_image;
            $product->product_image = $new_image;
            // DB::table('tbl_product')->insert($data);
            $product->save();
            Session::put('message','swal("Cập nhật thành công!", "Đã cập nhật hình ảnh sản phẩm","success")');
            return Redirect::to('all-product');
        }else{
            $product->save();
            Session::put('message','swal("Cập nhật thành công!", "Hình ảnh không thay đổi","success")');
            return Redirect::to('all-product');
        }
    }
    //Tìm kiếm sản phẩm 
    public function search_product_on_admin_layout(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $keywords = $data['search_product_submit'];
        // echo '<pre>';
        // echo $keywords;
        // echo '</pre>';
        $all_product = ProductModel::orderby('tbl_product.product_id','desc')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//Hiển thị tên danh mục
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')//Hiển thị tên thương hiệu
        ->where('product_name','like','%'.$keywords.'%')
        ->where('waste_basket_product','0')
        // ->paginate(10);
        ->get();
        return view('product.search_product')
        ->with('all_product', $all_product)
        ->with('keywords', $keywords);
        // ->with('i',(request()->input('page',1)-1)*10);
    }
    //Tìm kiếm sản phẩm tự động
    public function autocomplete_search_product_admin_ajax(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = ProductModel::where('product_status',0)
            ->where('product_name','LIKE','%'.$data['query'].'%')
            ->where('waste_basket_product',0)
            ->limit(6)
            ->get();
            $output = '';
            // display:block đỗ dữ liệu list về dạng khối
            // position:relative là cố định dính liền với những đối tượng trên nó
            foreach($product as $key => $val){
                $output.='<a class="a-auto-complete" href="#"><img class="img-auto-complete" src="'.url("public/uploads/product/$val->product_image").'" >'
                    .$val->product_name.
                    '</a>';
            }
            $output .= '';
            echo $output;
        }else{
            alert('lỗi');
        }
    }
    //Xóa sản phẩm
    public function delete_product($product_id){
        $this->AuthLogin();
        ProductModel::where('product_id',$product_id)->delete();
        Session::put('message','swal("Xóa thành công!", "Xóa sản phẩm thành công!","success")');
        return Redirect::to('all-product');
    }

    //Thùng rác---------------------------------------------------------------
    // Hiển thị
    public function waste_basket_product(){
        $this->AuthLogin();
    	$all_product = ProductModel::orderby('tbl_product.product_id','desc')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')//Hiển thị tên danh mục
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')//Hiển thị tên thương hiệu
        ->where('waste_basket_product',1)
        ->paginate(10);
    	$manager_product  = view('product.waste_basket_product')
        ->with('all_product',$all_product)
        ->with('i',(request()->input('page',1)-1)*10);
        //Cho i là số thứ tự khi phân trang
        //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
        //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
        //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
        //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 
    	return view('admin.admin_layout')
        ->with('product.waste_basket_product', $manager_product);
    }

    // Xóa tạm thời 
    public function unactive_waste_basket_product($product_id){
        $this->AuthLogin();
        ProductModel::where('product_id',$product_id)
        ->update(['waste_basket_product'=>1]);
        Session::put('message','swal("Thông báo!", "Sản phẩm đã được chuyển vào thùng rác","success")');
        return Redirect::to('all-product');

    }
    //khôi phục
    public function active_waste_basket_product($product_id){
        $this->AuthLogin();
        ProductModel::where('product_id',$product_id)->update(['waste_basket_product'=>0]);
        Session::put('message','swal("Thông báo!", "Đã khôi phục sản phẩm","success")');
        return Redirect::to('waste-basket-product');
    }
}

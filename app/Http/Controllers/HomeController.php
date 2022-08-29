<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use App\Models\GalleryModel;
use App\Models\SliderBannerModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use Session ;
use Mail;//
session_start();
class HomeController extends Controller
{
    //Hiển thị trang chủ
    public function index(Request $request){
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
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        $all_product = DB::table('tbl_product')
        ->where('product_status','0')
        ->where('waste_basket_product','0')
        ->orderby('product_id','desc')
        ->limit(8)
        ->get(); 
        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('slider_status',0)
        ->where('waste_basket_slider',0)
        ->get();//Hiển thị Slider
        //cách 1: Gán biến bằng tên gọi mới và gọi tên mới tại form để chạy chương trình
    	return view('pages.products.home')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('all_product',$all_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
        //cách 2: Dùng trực tiếp biến đang có hiện tại
        // return view('pages.home')
        // ->with(compact('cate_product','brand_product','all_product'));
    }
    //Hiển thị tất cả sản phẩm
    public function full_all_show_product(Request $request){
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
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        // Lọc sản phẩm
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];//Lấy giá trị của ?sort_by trong đường dẫn
            if($sort_by=='tang_dan'){
                $all_product = DB::table('tbl_product')
                ->where('product_status','0')
                ->where('waste_basket_product','0') 
                ->orderby('product_price','asc')
                // ->get();
                ->paginate(8)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn sort_by
            }elseif($sort_by=='giam_dan'){
                $all_product = DB::table('tbl_product')
                ->where('product_status','0')
                ->where('waste_basket_product','0') 
                ->orderby('product_price','desc')
                // ->get();
                ->paginate(8)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn sort_by
            }elseif($sort_by=='a_den_z'){
                $all_product = DB::table('tbl_product')
                ->where('product_status','0')
                ->where('waste_basket_product','0') 
                ->orderby('product_name','asc')
                // ->get();
                ->paginate(8)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn sort_by
            }elseif($sort_by=='z_den_a'){
                $all_product = DB::table('tbl_product')
                ->where('product_status','0')
                ->where('waste_basket_product','0') 
                ->orderby('product_name','desc')
                // ->get();
                ->paginate(8)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn sort_by
            }
        }else{
            $all_product = DB::table('tbl_product')
            ->where('product_status','0')
            ->where('waste_basket_product','0') 
            ->orderby('product_id','desc')
            // ->get();
            ->paginate(8);
            // ->simplePaginate(8);
            // ->defaultSimpleView(8);
            
        }

        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('slider_status',0)
        ->where('waste_basket_slider',0)
        ->get();//Hiển thị Slider
        //cách 1: Gán biến bằng tên gọi mới và gọi tên mới tại form để chạy chương trình
    	return view('pages.products.full_all_product')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('all_product',$all_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
        //cách 2: Dùng trực tiếp biến đang có hiện tại
        // return view('pages.home')
        // ->with(compact('cate_product','brand_product','all_product'));
    }
    //Hiển thị danh mục trang home-----------------------------------------------------------------------------------------------------------
    public function show_category_home($category_id, Request $request){
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

        // Lọc sản phẩm
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];//Lấy giá trị của ?sort_by trong đường dẫn
            if($sort_by=='tang_dan'){
                //cách 1: sử dụng model-trong model product và category cần thiết lập hàm nối, ưng coi thì tự vào mà coi :>>
                $category_by_id = ProductModel::with('category_model')//gọi tới hàm category_model, nó được coi như join trong DB
                ->where('category_id',$category_id)
                ->where('waste_basket_product','0')
                ->where('product_status','0')
                ->orderBy('product_price','ASC')//Sắp giá tiền tăng dần, nhỏ đứng trước to đứng sau
                ->paginate(4)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn
                // ->limit(6)//lấy ra 6 giá trị tương ứng
                // ->get();

                //cách 2: sử dụng DB
                // $category_by_id = DB::table('tbl_product')
                // ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
                // ->where('tbl_product.category_id',$category_id)
                // ->where('product_status','0')
                // ->orderBy('product_price','ASC')//Sắp giá tiền tăng dần, nhỏ đứng trước to đứng sau
                // ->limit(6)//lấy ra 6 giá trị tương ứng
                // ->get();
            }elseif($sort_by=='giam_dan'){
                //cách 1: sử dụng model-trong model product và category cần thiết lập hàm nối, ưng coi thì tự vào mà coi :>>
                $category_by_id = ProductModel::with('category_model')//gọi tới hàm category_model, nó được coi như join trong DB
                ->where('category_id',$category_id)
                ->where('waste_basket_product','0')
                ->where('product_status','0')
                ->orderBy('product_price','DESC')//Sắp giá tiền tăng dần, nhỏ đứng trước to đứng sau
                ->paginate(4)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn
                // ->limit(6)//lấy ra 6 giá trị tương ứng
                // ->get();

                //Cách 2: sử dụng DB
                // $category_by_id = DB::table('tbl_product')
                // ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
                // ->where('tbl_product.category_id',$category_id)
                // ->where('product_status','0')
                // ->orderBy('product_price','DESC')//Sắp giá tiền giảm dần, to đứng trước nhỏ đứng sau
                // ->limit(6)//lấy ra 6 giá trị tương ứng
                // ->get();
            }elseif($sort_by=='a_den_z'){
                //cách 1: sử dụng model-trong model product và category cần thiết lập hàm nối, ưng coi thì tự vào mà coi :>>
                $category_by_id = ProductModel::with('category_model')//gọi tới hàm category_model, nó được coi như join trong DB
                ->where('category_id',$category_id)
                ->where('waste_basket_product','0')
                ->where('product_status','0')
                ->orderBy('product_name','ASC')
                ->paginate(4)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn
                // ->limit(6)//lấy ra 6 giá trị tương ứng
                // ->get();


                //cách 2 : sử dụng DB
                // $category_by_id = DB::table('tbl_product')
                // ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
                // ->where('tbl_product.category_id',$category_id)
                // ->where('product_status','0')
                // ->orderBy('product_name','ASC')
                // ->limit(6)//lấy ra 6 giá trị tương ứng
                // ->get();
            }elseif($sort_by=='z_den_a'){
                //cách 1: sử dụng model-trong model product và category cần thiết lập hàm nối, ưng coi thì tự vào mà coi :>>
                $category_by_id = ProductModel::with('category_model')//gọi tới hàm category_model, nó được coi như join trong DB
                ->where('category_id',$category_id)
                ->where('waste_basket_product','0')
                ->where('product_status','0')
                ->orderBy('product_name','DESC')
                ->paginate(4)
                ->appends(request()->query());//khi chuyển trang vẫn giữ nguyên đường dẫn
                // ->limit(6)//lấy ra 6 giá trị tương ứng
                // ->get();


                //cách 2: sử dụng DB
                // $category_by_id = DB::table('tbl_product')
                // ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
                // ->where('tbl_product.category_id',$category_id)
                // ->where('product_status','0')
                // ->orderBy('product_name','DESC')
                // ->limit(6)//lấy ra 6 giá trị tương ứng
                // ->get();
            }
        }else{
            //cách 1: sử dụng model-trong model product và category cần thiết lập hàm nối, ưng coi thì tự vào mà coi :>>
            $category_by_id = ProductModel::with('category_model')//gọi tới hàm category_model, nó được coi như join trong DB
            ->where('category_id',$category_id)
            ->where('waste_basket_product','0')
            ->where('product_status','0')
            // ->limit(4)//lấy ra 6 giá trị tương ứng
            // ->get();
            ->paginate(4);
            
            
            //cách 2: sử dụng DB
            // $category_by_id = DB::table('tbl_product')
            // ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
            // ->where('tbl_product.category_id',$category_id)
            // ->where('product_status','0')
            // ->limit(6)//lấy ra 6 giá trị tương ứng
            // ->get();
        }
        // end lọc sản phẩm
        //Lấy tên danh mục
        $category_name = DB::table('tbl_category_product')
        ->where('tbl_category_product.category_id',$category_id)
        ->limit(1)//lấy 1 giá trị thôi, vì nằm trong vòng lặp nên nó lặp nhiều lần 1 giá trị giống nhau
        ->get();
        //Hiển thị slider
        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('slider_status',0)
        ->where('waste_basket_slider',0)
        ->get();//Hiển thị Slider
        return view('pages.showmenu.show_category')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
        // ->with('i',(request()->input('page',1)-1)*8);
    }
    //Hiển thị thương hiệu trang home--------------------------------------------------------------------------------------------------------------------
    public function show_brand_home($brand_id, Request $request){
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
        $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')
        ->where('tbl_brand_product.brand_id',$brand_id)
        ->where('product_status','0')
        ->limit(6)
        ->get();
        $brand_name = DB::table('tbl_brand_product')
        ->where('tbl_brand_product.brand_id',$brand_id)
        ->limit(1)->get();
        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('slider_status',0)
        ->where('waste_basket_slider',0)
        ->get();//Hiển thị Slider
        return view('pages.showmenu.show_brand')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('brand_by_id',$brand_by_id)
        ->with('brand_name',$brand_name)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);
    }
    //Chi tiết sản phẩm--------------------------------------------------------------------------------------------------------------------------
    public function details_product($product_id, Request $request){
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
        $product_details = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)
        ->get();

        
        foreach($product_details as $key => $value){
            $category_id = $value->category_id;//lấy category id để hiển thị sản phẩm liên quan????
            $product_id = $value->product_id;//Lấy product id để hiển thị gallery
            
        }
        //Gallery-hiển thị hình ảnh phụ 
        $gallery = GalleryModel::where('product_id',$product_id)
        ->orderby('gallery_id','desc')
        // ->where('waste_basket_gallery','0')
        ->get();
       //Sản phẩm liên quan
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)
        ->where('product_status','0')
        ->whereNotIn('tbl_product.product_id',[$product_id])//lấy các sản phẩm trừ sản phẩm đã được chọn
        ->limit(3)->get();
        $all_slider = SliderBannerModel::orderBy('slider_id','DESC')
        ->where('slider_status',0)
        ->where('waste_basket_slider',0)
        ->get();//Hiển thị Slider
        return view('pages.products.show_details')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('product_details',$product_details)
        ->with('relate',$related_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('gallery',$gallery)
        ->with('all_slider',$all_slider);

    }


    // Tìm kiếm sản phẩm--------------------------------------------------------------------------------------------------------------------------------------------
    public function search(Request $request){
        //------------------------SEO-------------------------
        $meta_desc = "Chuyên cung cấp các mặt hàng gấu bông chất lượng cao!"; 
        $meta_keywords = "Gấu bông nhiều chủng loại, nhiều size, nhiều mẫu mã!";
        $meta_title = "TeddyShop";
        $url_canonical = $request->url();
        //------------------------SEO--------------------------
        $keywords = $request->keywords_submit;
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
        $search_product = DB::table('tbl_product')
        ->where('product_name','like','%'.$keywords.'%')
        ->where('waste_basket_product','0')
        ->where('product_status','0')
        // ->get();
        ->get(); 
        return view('pages.products.search')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('search_product',$search_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_slider',$all_slider);

    }
    //Tìm kiếm tự động
    public function autocomplete_search_ajax(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = ProductModel::where('product_status',0)
            ->where('product_name','LIKE','%'.$data['query'].'%')
            ->where('waste_basket_product','0')
            ->where('product_status','0')
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

    //Gửi mail
    public function send_mail(){
        $to_name = "XuKot";
        $to_email = "khaidoan0110@gmail.com";

        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>'Mail gửi về vấn đề hàng hóa');

        Mail::send('pages.mail.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');
            $message->from($to_email,$to_name);
        });
        //return redirect('/')->with('message','');
    }
}


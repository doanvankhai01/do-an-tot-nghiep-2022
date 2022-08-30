@extends('admin.admin_layout')
@section('admin_content')
<?php
  $message = Session::get("message");
  if($message){
      echo '<script type="text/javascript">window.setTimeout(function test(){'.$message.'},100);</script>';
      Session::put('message',null);
  ?>
  <?php
  }
?>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="h2-title">Liệt kê sản phẩm</h2>
    </div>
    <div class="row">
      <div class="col-sm-2">
        
        <form action="{{URL::to('/add-product')}}">
          <button class="btn-function-infomation" id="">
            <i class="fa fa-plus"></i>
            Thêm sản phẩm
          </button>
        </form>
      </div>
      <div class="col-sm-5">
        <form >
          @csrf
          <select name="sort" id="sort" class="btn-function-infomation">
              <option value="{{Request::url()}}?sort_by=none">--- Lọc theo ---</option>
              <option value="{{Request::url()}}?sort_by=tang_dan">Lọc theo giá từ nhỏ nhất đên lớn nhất</option>
              <option value="{{Request::url()}}?sort_by=giam_dan">Lọc theo giá từ lớn nhất đên nhỏ nhất</option>
              <option value="{{Request::url()}}?sort_by=a_den_z">Lọc theo tên từ A đến Z</option>
              <option value="{{Request::url()}}?sort_by=z_den_a">Lọc theo tên từ Z đến A</option>
              {{-- {{Request::url()}} là yêu cầu lấy đường dẫn hiện tại --}}
          </select>
          <p></p>
      </form>            
      </div>
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <div class="">
          <form action="{{URL::to('/search-product-on-admin-layout')}}" method="POST">
            @csrf
            <input type="hidden" value="{{URL::to('')}}" name="url" id="url" class="form-control url" placeholder="url">
            <div class="search_box pull-right">
              <input type="text" class="btn-function-infomation" name="search_product_submit" id="keywords_product" placeholder="Nhập tên sản phẩm">
              <input class="btn-function-infomation" name="search_items" type="submit" value="Tìm kiếm">
            </div>
            <div class="div-auto-complete-search" style="" id="search_product_admin_ajax"></div>
        </form>
        </div>
      </div>
      
    </div>
    <div class="">
      <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
      <a  class="link-href-admin" href="">Sản phẩm</a>
    </div>
    <div class="table-responsive">
      <div class="card">
        <div class="card-body">
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title" style="width:4.8%;">
                  STT
                </th>
                <th class="th-infomation-title">Tên sản phẩm</th>
                <th class="th-infomation-title" style="width:8.5%;">Hình sản phẩm</th>
                <th class="th-infomation-title">Giá</th>
                <th class="th-infomation-title">Số lượng</th>
                <th class="th-infomation-title">Danh mục</th>
                <th class="th-infomation-title">Nơi sản xuất</th>
                <th class="th-infomation-title" style="width:9.5%;">Thư viện ảnh</th>
                <th class="th-infomation-title" style="width:9.5%;">Kích hoạt/ Ẩn</th>
                <th class="th-infomation-title" style="width:13.0%;">Chức năng</th>
              </tr>
            </thead>
            <tbody>
             
              @foreach($all_product as $key => $pro)
              <tr>
                <td class="td-infomation-title">{{$i++ + 1;}}
                {{-- 
                  ++i tăng giá trị của i lên 1 và trả về giá trị mới đó.
                  i++ cũng tương tự nhưng giá trị trả về là giá trị ban đầu của i trước khi được tăng lên 1. 
                  =>Phân tích: i++ thì lấy từ 0 , tức là nếu cho i bằng 0 thì sẽ lấy giá trị khởi đầu là 0
                  nếu ++i thì bỏ qua giá trị khởi đầu 0, và lấy giá trị khởi đầu là 1 
                  tức là dễ hiểu nhất : i++ + 1 = ++i(hiểu theo cách lấy sô thứ tự tăng dần)
                --}}
                </td>
                <td class="td-infomation-title">{{ $pro->product_name }}</td>
                <td class="td-infomation-title"><img src="public/uploads/product/{{$pro->product_image}}" height="100" width="100"></td>
                <td class="td-infomation-title">{{number_format($pro->product_price,0,',','.')}} VNĐ</td>
                <td class="td-infomation-title">{{ $pro->product_quantity }}</td>
                <td class="td-infomation-title">{{ $pro->category_name }}</td>
                <td class="td-infomation-title">{{ $pro->brand_name }}</td>
                <td class="td-infomation-title">
                  <a class="edit-delete-function" href="{{URL::to('/manager-gallery/'.$pro->product_id)}}">Thư viện ảnh</span></a>
                </td>

                <td class="td-infomation-title"><span class="text-ellipsis">
                  <?php
                  if($pro->product_status==0){
                    ?>
                    <a class="a-an-kich-hoat" href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><i class="material-icons text-success">visibility</i><span class="an-kichhoat">Kích hoạt</span></a>
                    <?php
                    }else{
                    ?>  
                    <a class="a-an-kich-hoat" href="{{URL::to('/active-product/'.$pro->product_id)}}"><i class="material-icons text-danger">visibility_off</i><span class="an-kichhoat">Ẩn</span></a>
                    <?php
                  }
                  ?>
                </span></td>
              
                <td class="td-infomation-title">
                  <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>Chi tiết</a>
                    <a onclick="return confirm('Bạn có muốn xóa sản phẩm, sản phẩm sẽ được lưu trữ trong thùng rác?')"  href="{{URL::to('/unactive-waste-basket-product/'.$pro->product_id)}}" class="edit-delete-function" ui-toggle-class="">
                      <i class="material-icons text-danger">delete_forever</i>
                      Xóa
                    </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <footer class="panel-footer">
      <div class="product-paginate"> 
          {{$all_product->links()}}  
          {{-- links gọi các nút phân trang, chuyển trang và để định dạng cho đẹp thì vào App\Providers\AppServiceProvider để định dạng kiểu nút phân trang cho đẹp--}}
      </div>
    </footer>
  </div>
</div>
@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/filter.js')}}"></script>
<script src="{{asset('public/ajax/dashboard/auto_complete.js')}}"></script>
@endsection
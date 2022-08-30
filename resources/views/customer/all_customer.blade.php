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
      <h2 class="h2-title">Liệt kê danh sách người dùng</h2>
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
      <a  class="link-href-admin" href="">Quản lí người dùng</a>
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
                <th class="th-infomation-title" style="width:20%;">Tên người dùng</th>
                <th class="th-infomation-title" style="width:42%;">Email</th>
                <th class="th-infomation-title" style="width:20%;">Số điện thoại</th>
                <th class="th-infomation-title" style="width:13.2%;">Chức năng</th>
              </tr>
            </thead>
            <tbody>
             
              @foreach($all_customer as $key => $cus)
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
                <td class="td-infomation-title">{{ $cus->customer_name }}</td>
                <td class="td-infomation-title">{{ $cus->customer_email }}</td>
                <td class="td-infomation-title">{{ $cus->customer_phone }}</td>
              
                <td class="td-infomation-title">
                  <a href="{{URL::to('/edit-customer-account/'.$cus->customer_id)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>Chi tiết</a>
                    {{-- <a onclick="return confirm('Bạn có muốn xóa sản phẩm, sản phẩm sẽ được lưu trữ trong thùng rác?')"  href="{{URL::to('/unactive-waste-basket-customer/'.$cus->customer_id)}}" class="edit-delete-function" ui-toggle-class="">
                      <i class="material-icons text-danger">delete_forever</i>
                      Xóa
                    </a> --}}
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
          {{$all_customer->links()}}  
          {{-- links gọi các nút phân trang, chuyển trang và để định dạng cho đẹp thì vào App\Providers\AppServiceProvider để định dạng kiểu nút phân trang cho đẹp--}}
      </div>
    </footer>
  </div>
</div>
@endsection
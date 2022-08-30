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
      <h2 class="h2-title">Thùng rác: sản phẩm</h2>
    </div>
    <div class="row">
      <div class="col-sm-7">
      </div>
      <div class="col-sm-2">
        <select class="btn-function-infomation">>
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn-function-infomation">Apply</button>                
      </div>
      <div class="col-sm-3">
        <div class="">
          <input type="text" class="btn-function-infomation" placeholder="Tìm kiếm">
          <span class="">
            <button class="btn-function-infomation" type="button">Tìm kiếm</button>
          </span>
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
                <th class="th-infomation-title">Danh mục</th>
                <th class="th-infomation-title">Thương hiệu</th>
                <th class="th-infomation-title" style="width:20%;">Chức năng</th>
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
                
                <td class="td-infomation-title">{{ $pro->category_name }}</td>
                <td class="td-infomation-title">{{ $pro->brand_name }}</td>              
                <td class="td-infomation-title">
                  <a onclick="return confirm('Bạn có chắc là muốn xóa Slider này ko? Slider sẽ mất vĩnh viễn và không thể khôi phục lại!')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="material-icons text-danger">delete_forever</i>
                    Xóa vĩnh viễn
                  </a>
                  <a onclick="return confirm('Bạn có muốn khôi phục Slider này không?')" href="{{URL::to('/active-waste-basket-product/'.$pro->product_id)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="material-icons text-success">restore</i>
                    Khôi phục
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <br>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">  
          {{$all_product->links()}}  
          {{-- links gọi các nút phân trang, chuyển trang và để định dạng cho đẹp thì vào App\Providers\AppServiceProvider để định dạng kiểu nút phân trang cho đẹp--}}
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
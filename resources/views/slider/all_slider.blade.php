@extends('admin.admin_layout')
@section('admin_content')
<?php
  $message = Session::get("message");
  if($message){
      echo '<script type="text/javascript">window.setTimeout(function test(){'.$message.'},100);</script>';
      Session::put('message',null);
  }
?>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="h2-title">Slider Banner</h2>
    </div>
    <div class="row">
      <div class="col-sm-2">
        
        <form action="{{URL::to('/add-slider')}}">  
          <button class="btn-function-infomation" id="">
            <i class="fa fa-plus"></i>
            Thêm Slider Banner
          </button>
        </form>
      </div>
      <div class="col-sm-5">
        <select class="btn-function-infomation">>
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn-function-infomation">Apply</button>                
      </div>
      <div class="col-sm-2">
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
      <a  class="link-href-admin" href="">Slider</a>
    </div>
    <div class="table-responsive">
      <div class="card">
        <div class="card-body">
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title" style="width:5%;">STT</th>
                <th class="th-infomation-title">Tên slider</th>
                <th class="th-infomation-title">Hình ảnh</th>
                <th class="th-infomation-title">Mô tả</th>
                <th class="th-infomation-title">Đường dẫn URL</th>
                <th class="th-infomation-title" style="width:10.5%;">Ẩn/ Kích hoạt</th>
                <th class="th-infomation-title" style="width:10%;">Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach($all_slider as $key => $slid)
              <tr>
                <td class="td-infomation-title"><i>{{$i++ + 1}}</i></td>
                <td class="td-infomation-title">{{ $slid->slider_name }}</td>
                <td class="td-infomation-title"><img src="public/uploads/slider/{{ $slid->slider_image }}" height="150" width="250"></td>
                <td class="td-infomation-title">{{ $slid->slider_desc }}</td>
                <td class="td-infomation-title">{{ $slid->slider_slug }}</td>
                <td class="td-infomation-title"><span class="text-ellipsis">
                  <?php
                  if($slid->slider_status==0){
                    ?>
                    <a class="a-an-kich-hoat" href="{{URL::to('/unactive-slider/'.$slid->slider_id)}}"><i class="material-icons text-success">visibility</i><span class="an-kichhoat">Kích hoạt</span></a>
                    <?php
                    }else{
                    ?>  
                    <a class="a-an-kich-hoat" href="{{URL::to('/active-slider/'.$slid->slider_id)}}"><i class="material-icons text-danger">visibility_off</i><span class="an-kichhoat">Ẩn</span></a>
                    <?php
                  }
                  ?>
                </span></td>
              
                <td class="td-infomation-title">
                  {{-- <a href="{{URL::to('/edit-slider/'.$slid->slider_id)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>Chỉnh sửa
                  </a> --}}
                  <a onclick="return confirm('Bạn có muốn xóa sản phẩm, sản phẩm sẽ được lưu trữ trong thùng rác?')"  href="{{URL::to('/unactive-waste-basket-slider/'.$slid->slider_id)}}" class="edit-delete-function" ui-toggle-class="">
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
          {{$all_slider->links()}}  
          {{-- links gọi các nút phân trang, chuyển trang và để định dạng cho đẹp thì vào App\Providers\AppServiceProvider để định dạng kiểu nút phân trang cho đẹp--}}
      </div>
    </footer>
  </div>
</div>
@endsection
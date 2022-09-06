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
      <h2 class="h2-title">Liệt kê Thương hiệu sản phẩm</h2>
    </div>
    <div class="row">
      <div class="col-sm-2">
        
        <form action="{{URL::to('/add-brand-product')}}">
          
          <button class="btn-function-infomation" id="">
            <i class="fa fa-plus"></i>
            Thêm thương hiệu
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
      <a  class="link-href-admin" href="">Thương hiệu sản phẩm</a>
    </div>
    <div class="table-responsive">
      <div class="card">
        <div class="card-body">
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title" style="width:5%;">
                  <label class="">
                    STT
                  </label>
                </th>
                <th class="th-infomation-title" >Tên thương hiệu</th>
                <th class="th-infomation-title">Đường dẫn URL</th>
                <th class="th-infomation-title" style="width:10.5%;">Ẩn/ Kích hoạt</th>
                
                <th class="th-infomation-title" style="width:13.5%;"> Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach($all_brand_product as $key => $brand_pro)
              <tr>
                <td class="td-infomation-title">{{$i++ + 1;}}</td>
                <td class="td-infomation-title">{{ $brand_pro->brand_name }}</td>
                <td class="td-infomation-title">{{ $brand_pro->brand_slug }}</td>
                <td class="td-infomation-title"><span class="text-ellipsis">
                  <?php
                    //Nếu status = 0 thì hiển thị
                    if($brand_pro->brand_status==0){
                        ?>
                        <a class="a-an-kich-hoat" href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}"><i class="material-icons icon-color-infomation">visibility</i><span class="an-kichhoat">Kích hoạt</span></a>
                        <?php
                        //hiển thị ra icon hiển thị <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                        //khi click vào icon thì dẫn tới đường dẫn unactive-brand-product kèm theo id  là $brand_pro -> brand_id <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                        }else{
                        ?>  
                        <a class="a-an-kich-hoat" href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"><i class="material-icons icon-color-infomation">visibility_off</i><span class="an-kichhoat">Ẩn</span></a>
                        <?php
                        
                    }
                  ?>
                </span></td>
              
                <td class="td-infomation-title">
                  <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>Chỉnh sửa</a>
                  {{-- <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                  </a> --}}
                  <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
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
          {{$all_brand_product->links()}}  
          {{-- links gọi các nút phân trang, chuyển trang và để định dạng cho đẹp thì vào App\Providers\AppServiceProvider để định dạng kiểu nút phân trang cho đẹp--}}
      </div>
    </footer>
  </div>
</div>

@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/brand.js')}}"></script>
@endsection
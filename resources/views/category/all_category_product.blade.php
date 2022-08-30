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
    <div class="">
      <h2 class="h2-title">Liệt kê danh mục sản phẩm</h2>
    </div>
    <div class="row">
      <div class="col-sm-2">
        
        <form action="{{URL::to('/add-category-product')}}">
          <button class="btn-function-infomation" id="">
            <i class="fa fa-plus"></i>
            Thêm danh mục
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
      <a  class="link-href-admin" href="">Danh mục sản phẩm</a>
    </div>
    <div class="table-responsive">
      <div class="card">
        <div class="card-body">
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title" style="width:4%;">
                  <label class="">
                    STT
                  </label>
                </th>
                <th class="th-infomation-title" >Tên danh mục</th>
                <th class="th-infomation-title">Đường dẫn URL</th>
                <th class="th-infomation-title" style="width:10.5%;">Ẩn/ Kích hoạt</th>
                
                <th class="th-infomation-title" style="width:14%;"> Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach($all_category_product as $key => $cate_pro)
              <tr>
                <td class="td-infomation-title"><i>{{$i++ + 1;}}</i></td>
                <td class="td-infomation-title">{{ $cate_pro->category_name }}</td>
                <td class="td-infomation-title">{{ $cate_pro->category_slug }}</td>
                <td class="td-infomation-title"><span class="text-ellipsis">
                  <?php
                    //Nếu status = 0 thì hiển thị
                    if($cate_pro->category_status==0){
                        ?>
                        <a class="a-an-kich-hoat" href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><i class="material-icons text-success">visibility</i><span class="an-kichhoat">Kích hoạt</span></a>
                        <?php
                        //hiển thị ra icon hiển thị <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                        //khi click vào icon thì dẫn tới đường dẫn unactive-category-product kèm theo id  là $cate_pro -> category_id <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                        }else{
                        ?>  
                        <a class="a-an-kich-hoat" href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"><i class="material-icons text-danger">visibility_off</i><span class="an-kichhoat">Ẩn</span></a>
                        <?php
                        
                    }
                  ?>
                </span></td>
              
                <td class="td-infomation-title">
                  <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>Chỉnh sửa</a>
                  {{-- <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                  </a> --}}
                  <a onclick="return confirm('Bạn có muốn xóa sản phẩm, sản phẩm sẽ được lưu trữ trong thùng rác?')"  href="{{URL::to('/unactive-waste-basket-category/'.$cate_pro->category_id)}}" class="edit-delete-function" ui-toggle-class="">
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
          {{$all_category_product->links()}}  
          {{-- links gọi các nút phân trang, chuyển trang và để định dạng cho đẹp thì vào App\Providers\AppServiceProvider để định dạng kiểu nút phân trang cho đẹp--}}
      </div>
    </footer>
  </div>
</div>
@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/category.js')}}"></script>
@endsection
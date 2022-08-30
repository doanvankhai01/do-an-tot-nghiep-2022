// Thêm danh mục
$('.add_category').click(function(){
    var category_url = $('.url').val();
    var category_name = $('.category_name').val();
    var category_slug = $('.category_slug').val();
    var category_desc = CKEDITOR.instances['category_desc'].getData();
    var category_status = $('.category_status').val();
    var _token = $('input[name="_token"]').val();
    // alert(category_name);
    // alert(category_slug);
    // alert(category_desc);
    // alert(category_status);
    // alert(_token);
    // alert(category_url);
    if(category_name == '' || category_slug == '' || category_desc == '' || category_status == '' || category_url == '' || _token == '' ){
        swal("Thất bại!", "Có trường chưa đúng điều kiện!", "error");
        // window.setTimeout(function(){
        //     location.reload();
        // },3000);
    }else{
        $.ajax({
            url : category_url+"/save-category-product",
            method: 'POST',
            data:{
                category_name:category_name,
                category_slug:category_slug,
                category_desc:category_desc,
                category_status:category_status,
                _token:_token
            },
            success:function(data){
                swal("Thành công!", "Thêm danh mục thành công!", "success");
                // location.reload();
                window.location = category_url+"/all-category-product";
            }
        });
        // window.setTimeout(function(){
        //     location.reload();
        // },3000);
    }
});
// Cập nhật danh mục
$('.update_category').click(function(){
    var category_url = $('.url').val();
    var category_id = $('.category_id').val();
    var category_name = $('.category_name').val();
    var category_slug = $('.category_slug').val();
    var category_desc = CKEDITOR.instances['category_desc'].getData();
    var _token = $('input[name="_token"]').val();
    // alert(category_id);
    // alert(category_name);
    // alert(category_slug);
    // alert(category_desc);
    // alert(_token);
    // alert(category_url);
    if(category_name == '' || category_slug == '' || category_desc == '' || category_id == '' || category_url == '' || _token == '' ){
        swal("Thất bại!", "Có trường chưa đúng điều kiện!", "error");
        // window.setTimeout(function(){
        //     location.reload();
        // },3000);
    }else{
        $.ajax({
            url : category_url+"/update-category-product",
            method: 'POST',
            data:{
                category_id:category_id,
                category_name:category_name,
                category_slug:category_slug,
                category_desc:category_desc,
                _token:_token
            },
            success:function(data){
                swal("Thành công!", "Cập nhật danh mục thành công!", "success");
                // location.reload();
                window.location = category_url+"/all-category-product";
            }
            
        });
        // window.setTimeout(function(){
        //     location.reload();
        // },3000);
    }
});
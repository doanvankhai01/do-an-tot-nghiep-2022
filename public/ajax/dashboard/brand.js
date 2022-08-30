// Thêm thương hiệu
$('.add_brand_product').click(function(){
    var brand_url = $('.url').val();
    var brand_name = $('.brand_name').val();
    var brand_slug = $('.brand_slug').val();
    var brand_desc = CKEDITOR.instances['brand_desc'].getData();
    var brand_status = $('.brand_status').val();
    var _token = $('input[name="_token"]').val();
    // alert(brand_name);
    // alert(brand_slug);
    // alert(brand_desc);
    // alert(brand_status);
    // alert(_token);
    // alert(brand_url);
    // var save = brand_url+"/save-brand-product";
    // alert(save);
    if(brand_url == '' || brand_name == '' || brand_slug == '' || brand_desc == '' || brand_status == '' || _token == '' ){
        swal("Thất bại!", "Có trường chưa đúng điều kiện!", "error");
        // window.setTimeout(function(){
        //     location.reload();
        // },3000);
    }else{
        $.ajax({
            url : brand_url+"/save-brand-product",
            method: 'POST',
            data:{
                brand_name:brand_name,
                brand_slug:brand_slug,
                brand_desc:brand_desc,
                brand_status:brand_status,
                _token:_token
            },
            success:function(data){
                swal("Thành công!", "Thêm thương hiệu thành công!", "success");
                window.location = brand_url+"/all-brand-product";
            },
        });
        // window.setTimeout(function(){
        //     location.reload();
        // },3000);
    }
});
// Cập nhật thương hiệu
$('.btn_update_brand').click(function(){
    var brand_url = $('.url').val();
    var brand_id = $('.brand_id').val();
    var brand_name = $('.brand_name').val();
    var brand_slug = $('.brand_slug').val();
    var brand_desc = CKEDITOR.instances['brand_desc'].getData();
    var _token = $('input[name="_token"]').val();
    // alert(brand_id);
    // alert(brand_name);
    // alert(brand_slug);
    // alert(brand_desc);
    // alert(_token);
    if(brand_url == '' || brand_name == '' || brand_slug == '' || brand_desc == '' || brand_id == '' || _token == '' ){
        swal("Thất bại!", "Có trường chưa đúng điều kiện!", "error");
        // window.setTimeout(function(){
        //     location.reload();
        // },3000);
    }else{
        $.ajax({
            url : brand_url+"/update-brand-product",
            method: 'POST',
            data:{
                brand_id:brand_id,
                brand_name:brand_name,
                brand_slug:brand_slug,
                brand_desc:brand_desc,
                _token:_token
            },
            success:function(data){
                swal("Thành công!", "Cập nhật thương hiệu thành công!", "success");
                window.location = brand_url+"/all-brand-product";
            }
           
        });
        // window.setTimeout(function(){
        //     location.reload();
        // },3000);
    }
});
 //Tìm kiếm tự động tên sản phẩm-------------------------------------------------------------
 $('#keywords_product').keyup(function(){
    var auto_url = $('.url').val();
    var query = $(this).val();
    var _token = $('input[name="_token"]').val();
    // alert (url);
    // alert (query);
    // alert (_token);
    if(query != ''){
        // alert('chạy e êi ! ');
        $.ajax({
            url: auto_url+'/autocomplete-search-product-admin-ajax',
            method:"POST",
            data:{
                query:query,
                _token:_token
            },
            success:function(data){
                $('#search_product_admin_ajax').fadeIn();
                // Phương thức fadeIn () dần dần thay đổi độ mờ đối với các phần tử đã chọn, từ ẩn sang hiển thị (hiệu ứng mờ dần).
                $('#search_product_admin_ajax').html(data);
                // hiển thị dữ liệu về
            }
        });
    }
    else{
        $('#search_product_admin_ajax').fadeOut();
        // alert('ko chạy e êi !');
    }
});
// Click vào thì sẽ hiện nội dung ra 
$(document).on('click','.a-auto-complete',function(){
    $('#keywords_product').val($(this).text());//Hiển thị nội dung ra thẻ mang id #keyword
    $('#search_product_admin_ajax').fadeOut();//Tăt hiển thị auto-complete
});

//Tìm kiếm tự động mã đơn hàng------------------------------------------------------
$('#keywords_order').keyup(function(){
    var auto_url = $('.url').val();
    var query = $(this).val();
    var _token = $('input[name="_token"]').val();
    // alert (query);
    // alert (_token);
    if(query != ''){
        // alert('chạy e êi ! ');
        $.ajax({
            url: auto_url+"/autocomplete-search-order-admin-ajax",
            method:"POST",
            data:{
                query:query,
                _token:_token
            },
            success:function(data){
                $('#search_order_admin_ajax').fadeIn();
                // Phương thức fadeIn () dần dần thay đổi độ mờ đối với các phần tử đã chọn, từ ẩn sang hiển thị (hiệu ứng mờ dần).
                $('#search_order_admin_ajax').html(data);
                // hiển thị dữ liệu về
            }
        });
    }
    else{
        $('#search_order_admin_ajax').fadeOut();
        // alert('ko chạy e êi !');
    }
});
// Click vào thì sẽ hiện nội dung ra 
$(document).on('click','.a-auto-complete',function(){
    // $('#keywords_order').val($('#span-show-auto-complete').text());//Hiển thị nội dung ra thẻ mang id #keyword
    $('#keywords_order').val($(this).text());//Hiển thị nội dung ra thẻ mang id #keyword
    $('#search_order_admin_ajax').fadeOut();//Tăt hiển thị auto-complete
});
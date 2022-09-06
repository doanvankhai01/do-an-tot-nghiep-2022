$(document).ready(function(){
    //load dữ liệu 60 ngày gần nhất
    notification_product();
    notification_new_order();
    notification_view_order();
    //Lấy số lượng sản phẩm
    function notification_product(){
        // alert("Đc gòi ciu");
        var url = $('meta[name="url"]').attr('content')
        var _token = $('meta[name="csrf-token"]').attr('content')
        // alert(date_start);
        // alert(date_end);
        // alert(_token);
        // alert(url);

        $.ajax({
            url : url+'/notification-product',
            method: 'POST',
            data:{
                _token:_token
            },
            success:function(data){
                $('#notification_product').html(data);
            }
           
        });
    }
    //Lấy số lượng đơn hàng mới
    function notification_new_order(){
        // alert("Đc gòi ciu");
        var url = $('meta[name="url"]').attr('content') 
        var _token = $('meta[name="csrf-token"]').attr('content')

        // alert(date_start);
        // alert(date_end);
        // alert(_token);
        // alert(url);

        $.ajax({
            url : url+'/notification-new-order',
            method: 'POST',
            data:{
                _token:_token
            },
            success:function(data){
                $('#notification_new_order').html(data);
            }
           
        });
    }
    //Số lượng đơn hàng đã xem
    function notification_view_order(){
        // alert("Đc gòi ciu");
        var url = $('meta[name="url"]').attr('content')  
        var _token = $('meta[name="csrf-token"]').attr('content')
        // alert(date_start);
        // alert(date_end);
        // alert(_token);
        // alert(url);

        $.ajax({
            url : url+'/notification-view-order',
            method: 'POST',
            data:{
                _token:_token
            },
            success:function(data){
                $('#notification_view_order').html(data);
            }
           
        });
    }
});
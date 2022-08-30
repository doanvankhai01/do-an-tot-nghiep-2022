//đặt hàng
$(document).ready(function(){
    //Đặt hàng
    $('.send_order').click(function(){
        swal({
            title: "Xác nhận đặt hàng?",
            text: "Đơn hàng sẽ được gửi đi!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Vâng, đặt hàng!",
            cancelButtonText: "Hủy!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                var url = $('.url').val();
                var shipping_email = $('.shipping_email').val();
                var shipping_name = $('.shipping_name').val();
                var shipping_address = $('.shipping_address').val();
                var shipping_phone = $('.shipping_phone').val();
                var shipping_notes = $('.shipping_notes').val();
                var shipping_method = $('.payment_select').val();
                var order_feeship = $('.order_feeship').val();
                var order_coupon = $('.order_coupon').val();
                var _token = $('input[name="_token"]').val();
                if(order_feeship==''){
                    swal("Vui lòng kiểm tra lại!", "Vui lòng điền thông tin ship hàng!", "error");
                }else if(shipping_email == '' || shipping_name == '' || shipping_address == '' || shipping_phone == '' ){
                    swal("Vui lòng kiểm tra lại!", "Vui lòng điền đầy đủ các trường bắt buộc!", "error");
                }else if(shipping_notes == ''){
                    shipping_notes ='Không có ghi chú';
                    $.ajax({
                        url: url+'/confirm-order',
                        method: 'POST',
                        data:{
                            shipping_email:shipping_email,
                            shipping_name:shipping_name,
                            shipping_address:shipping_address,
                            shipping_phone:shipping_phone,
                            shipping_notes:shipping_notes,
                            shipping_method:shipping_method,
                            order_feeship:order_feeship,
                            order_coupon:order_coupon,
                            _token:_token
                        },
                        success:function(data){
                            swal("Đơn đã được gửi đi!", "Đơn hàng của bạn đã được gửi đi!Xin cám ơn quý khách!", "success");
                        }
                    });
                    window.setTimeout(function(){
                        location.reload();
                    },800);
                }else{
                    $.ajax({
                        url: url+'/confirm-order',
                        method: 'POST',
                        data:{
                            shipping_email:shipping_email,
                            shipping_name:shipping_name,
                            shipping_address:shipping_address,
                            shipping_phone:shipping_phone,
                            shipping_notes:shipping_notes,
                            shipping_method:shipping_method,
                            order_feeship:order_feeship,
                            order_coupon:order_coupon,
                            _token:_token
                        },
                        success:function(data){
                            swal("Đơn đã được gửi đi!", "Đơn hàng của bạn đã được gửi đi!Xin cám ơn quý khách!", "success");
                        }
                    });
                    window.setTimeout(function(){
                        location.reload();
                    },800);
                }
               
            } else {
                swal("Đã hủy đặt hàng!", "Đơn hàng đã được hủy!", "error");
            }
        });
    });
});
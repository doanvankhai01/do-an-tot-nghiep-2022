$(document).ready(function(){
    //Thêm sản phẩm vào giỏ hàng
    $('.add-to-cart').click(function(){
        var url = $('.url').val();
        var id = $(this).data('id_product');
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_quantity = $('.cart_product_quantity_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var _token = $('input[name="_token"]').val();
        // alert(cart_product_quantity);
        if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
            swal("Cảnh báo!", "Số lượng mua vượt quá giới hạn trong kho hàng!", "warning")
        }else{
            $.ajax({
                url: url+'/add-cart-ajax',
                method: 'POST',
                data:{
                    cart_product_id:cart_product_id,
                    cart_product_name:cart_product_name,
                    cart_product_image:cart_product_image,
                    cart_product_price:cart_product_price,
                    cart_product_quantity:cart_product_quantity,
                    cart_product_qty:cart_product_qty,
                    _token:_token
                },
                success:function(data){
                    swal({
                        title: "Đã thêm sản phẩm vào giỏ hàng",
                        text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                        titleColor:"#FF0000",
                        showCancelButton: true,
                        cancelButtonText: "Xem tiếp",
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Đi đến giỏ hàng",
                        closeOnConfirm: false
                    },
                    function() {
                        // window.location.href = url+'/show-cart-ajax';
                        window.location.href = url+'/checkout';
                    });
                }

            });
        }
    });
});
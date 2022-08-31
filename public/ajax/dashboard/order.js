//Hàm cập nhật số lượng đơn hàng
$('.update_quantity_order').click(function(){
    var url = $('.url').val();
    var order_product_id = $(this).data('product_id');
    var order_qty = $('.quantity_order_' + order_product_id).val(); //Số lượnd nhập/ đặt mua
    var order_code = $('.class_order_code').val();
    var _token = $('input[name ="_token"]').val();
    var order_qty_storage = $('.class_order_quantity_'+ order_product_id).val();//lấy số lượng trong kho 
    // alert(order_product_id);
    // alert(order_qty);
    // alert(order_code);
    // alert (url);
    if(parseInt(order_qty) > parseInt(order_qty_storage)){
        swal("Thất bại!", "Số lượng trong kho không đủ!", "error");
        window.setTimeout(function(){
            location.reload();
        },3000);
    }else{
        $.ajax({
            url : url +'/update-order-quantity',
            method: 'POST',
            data:{
                order_product_id:order_product_id,
                order_qty:order_qty,
                order_code:order_code,
                _token:_token
            },
            success:function(data){
                swal("Thành công!", "Cập nhật số lượng thành công!", "success");
                // location.reload();
            }
           
        });
        window.setTimeout(function(){
            location.reload();
        },3000);
    }
});
// //Hàm xử lí tình trạng đơn hàng
$('.function_order_status').change(function(){
    var url = $('.url').val();
    var order_status = $(this).val();
    var order_id = $(this).children(":selected").attr("id");//id đơn hàng 
    var _token = $('input[name ="_token"]').val();
    
    //Lấy ra số lượng
    quantity =[];
    $("input[name='product_sales_quantity']").each(function(){
        quantity.push($(this).val());
    });
    // Hàm $.each()có thể được sử dụng để lặp qua bất kỳ tập hợp nào, cho dù đó là một đối tượng hay một mảng.
    // Trong trường hợp của một mảng, mỗi lần gọi lại được truyền một chỉ số mảng và một giá trị mảng tương ứng.
    
    //lấy ra product,id sản phẩm
    order_product_id = [];
    $("input[name='order_product_id']").each(function(){
        order_product_id.push($(this).val());
    });

    //Lấy id sản phẩm
    x=0;
    for(i=0; i<order_product_id.length; i++){
        var order_qty = $('.quantity_order_'+order_product_id[i]).val();//lấy số lượng đặt hàng
        var order_qty_storage = $('.class_order_quantity_'+ order_product_id[i]).val();//lấy số lượng trong kho 
        if(parseInt(order_status) == 2){
            if(parseInt(order_qty) > parseInt(order_qty_storage)){
                x=x+1;
                if(x==1){
                    swal("Thất bại!", "Đơn hàng vượt quá số lượng trong kho!", "error");
                }
                window.setTimeout(function(){
                    location.reload();
                },800);
                $('.color_qty_'+order_product_id[i]).css('color','red');
                document.getElementById("color_qty_text_"+order_product_id[i]).innerHTML = "Hàng không đủ để bán!";
            }
            
        }
    }
    
    if(x<=0){
        $.ajax({
            url : url+'/update-order-status',
            method: 'POST',
            data:{
                order_status:order_status,
                order_id:order_id,
                _token:_token,
                quantity:quantity,
                order_product_id:order_product_id
            },
            success:function(data){
                alert("Thay đổi tình trạng đơn hàng thành công!");
                location.reload();
            }
        });
    }
    
});
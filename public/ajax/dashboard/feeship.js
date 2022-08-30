$(document).ready(function(){
    //Hàm lấy dữ liệu feeship ra bằng ajax
    fetch_delivery();//khi chạy trang thì trang sẽ load function này
    function fetch_delivery(){
        var url = $('.url').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url : url+'/load-delivery',
            method: 'POST',
            data:{
                _token:_token
            },
            success:function(data){
                $('#load_delivery').html(data);
            }
        });

    }
    //Cập nhật giá tiền
    $(document).on('blur','.feeship_edit', function(){
        //blur : khi bạn click vào phần tử, sau đó bạn lại kich ra ngoài phần tử thì blur sẽ kích hoặc chương trình
        var url = $('.url').val();
        var fee_feeship_id = $(this).data('fee_feeship_id');
        var fee_value = $(this).text();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url : url+'/update-delivery',
            method: 'POST',
            data:{
                fee_feeship_id:fee_feeship_id,
                fee_value:fee_value,
                _token:_token
            },
            success:function(data){
                fetch_delivery();//Sau khi cập nhật thành công thì load lại danh sách

            }
        });
        

    });
    //Thêm giá tiền ship hàng tùy theo khu vực
    $('.add_delivery').click(function(){
        var url = $('.url').val();
        var province = $('.province').val();//lấy dữ liệu từ class province
        var district = $('.district').val();//lấy dữ liệu từ class district
        var town = $('.town').val();//lấy dữ liệu từ class town
        var fee_ship = $('.fee_ship').val();//lấy dữ liệu từ class fee_ship
        var _token = $('input[name="_token"]').val();//Lấy _token
        // alert(province);
        // alert(district);
        // alert(fee_ship);
        // alert(_token);
        // alert(town);

        $.ajax({
            url : url+'/insert-delivery',
            method: 'POST',
            data:{
                province:province,
                district:district,
                town:town,
                fee_ship:fee_ship,
                _token:_token
            },
            success:function(data){
                fetch_delivery();//Sau khi thêm thành công thì load lại danh sách
                location.reload();
                // $('#load_delivery').html(data);
            }
        });

    });
    //Hiển thị Tỉnh,Huyện,Xã------------------------
    $('.choose').on('change',function(){
        var url = $('.url').val();
        //onchange: Xảy ra khi giá trị (value) của thẻ HTML đổi. Thường dùng trong các đối thẻ form input
        var action = $(this).attr('id');
        //attr() lấy thuộc tính của id là province
        var ma_id = $(this).val();
        //lấy id từ option của id province
        var _token = $('input[name="_token"]').val();
        //Lấy _token
        var result = '';
        // alert(action);
        // alert(ma_id);
        // alert(_token);

        if(action=='province'){
            result = 'district';

        }else{
            result = 'town';
        }
        $.ajax({
            url : url+'/select-delivery',
            method: 'POST',
            data:{
                action:action,
                ma_id:ma_id,
                _token:_token
            },
            success:function(data){
                $('#'+result).html(data);
                //alert(data);
            }
        });
    });

    //  //tìm kiếm :>>>>
     $('.search').on('change',function(){
        var url = $('.url').val();
        //onchange: Xảy ra khi giá trị (value) của thẻ HTML đổi. Thường dùng trong các đối thẻ form input
        var action = $(this).attr('id');
        //attr() lấy thuộc tính của id là province
        var ma_id = $(this).val();
        //lấy id từ option của id province
        var _token = $('input[name="_token"]').val();
        //Lấy _token
        // alert(action);
        // alert(ma_id);
        // alert(_token);
        $.ajax({
            url : url+'/select-information-delivery',
            method: 'POST',
            data:{
                action:action,
                ma_id:ma_id,
                _token:_token
            },
            success:function(data){
                $('#load_delivery').html(data);
            }
        });
    });
})
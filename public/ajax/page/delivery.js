$(document).ready(function(){
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
         if(action=='province'){
             result = 'district';
         }else{
             result = 'town';
         }
         $.ajax({
             url : url+'/select-delivery-page-home',
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
 });
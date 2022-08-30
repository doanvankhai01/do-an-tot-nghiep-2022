$(document).ready(function(){
    //Tính phí vận chuyển
    $('.calculate_delivery').click(function(){
         var url = $('.url').val();
         var province_id = $('.province').val();
         var district_id = $('.district').val();
         var town_id = $('.town').val();
         var _token = $('input[name="_token"]').val();
         //Lấy _token
         if(province_id ==""||district_id==""||town_id==""){
             alert("Vui lòng chọn nơi nhận hàng để tính phí vận chuyển!");
         }else{
             $.ajax({
                 url : url+'/calculate-delivery-fee',
                 method: 'POST',
                 data:{
                     province_id:province_id,
                     district_id:district_id,
                     town_id:town_id,
                     _token:_token
                 },
                 success:function(){
                     location.reload();
                 }
             });
         }
     });
 });
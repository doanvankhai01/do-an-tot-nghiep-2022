$('#keywords').keyup(function(){
    var url = $('.url').val();
    var query = $(this).val();
    var _token = $('input[name="_token"]').val();
    // alert (query);
    // alert (_token);
    // alert(url);
    if(query != ''){
        // alert('chạy e êi ! ');
        $.ajax({
            url: url+'/autocomplete-search-ajax',
            method:"POST",
            data:{
                query:query,
                _token:_token
            },
            success:function(data){
                $('#search_ajax').fadeIn();
                // Phương thức fadeIn () dần dần thay đổi độ mờ đối với các phần tử đã chọn, từ ẩn sang hiển thị (hiệu ứng mờ dần).
                $('#search_ajax').html(data);
                // hiển thị dữ liệu về
            }
        });
    }
    else{
        $('#search_ajax').fadeOut();
        // alert('ko chạy e êi !');
    }
});
// Click vào thì sẽ hiện nội dung ra 
$(document).on('click','.a-auto-complete',function(){
    $('#keywords').val($(this).text());//Hiển thị nội dung ra thẻ mang id #keyword
    $('#search_ajax').fadeOut();//Tăt hiển thị auto-complete
});
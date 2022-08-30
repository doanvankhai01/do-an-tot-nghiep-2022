$(document).ready(function(){
    var category_url = $('.url').val();
    $('#sort').on('change',function(){// Nếu slect mang id on(change)(có sự thay đổi) thì thi triển chương trình
        var url = $(this).val();//Bắt đường dẫn và lấy giá trị value trong option 
        // alert(url);
        if(url){
            window.location = url; // Refresh lại trang với đường dẫn URL đã lấy ra
        }
        return false;
    });
});
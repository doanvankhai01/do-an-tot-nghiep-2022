//Tự động nhảy slug
$('.admin_name').keyup(function(){
    // alert("phát hiện thay đổi");
    var slug;   
    //Lấy text từ thẻ input title 
    slug = document.getElementById("admin_name").value;//lấy dữ liệu
    slug = slug.toLowerCase();//chuyển tất cả từ viết hoa thành viết thường
    //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
    document.getElementById('admin_slug').value = slug;
});
//Thêm tài khoản có hình ảnh
$('.add_admin').click(function(){
    // alert("được");
    var url = $('meta[name="url"]').attr('content');
    var admin_name = $('.admin_name').val();
    var admin_slug = $('.admin_slug').val();
    var admin_birdthday = $('.admin_birdthday').val();
    var admin_address = $('.admin_address').val();
    var admin_phone = $('.admin_phone').val();
    var admin_image = document.getElementById('admin_file').files[0];
    var admin_email = $('.admin_email').val();
    var admin_password = $('.admin_password').val();
    var admin_status = $('.admin_status').val();

    // alert(url);
    // alert(admin_name);
    // alert(admin_slug);
    // alert(admin_birdthday);
    // alert(admin_address);
    // alert(admin_phone);
    // alert(admin_image);
    // alert(admin_email);
    // alert(admin_password);
    // alert(admin_status);
    
    var form_data = new FormData();//Tạo 1 form data mới

    form_data.append("admin_name",admin_name);
    form_data.append("admin_slug",admin_slug);
    form_data.append("admin_birdthday",admin_birdthday);
    form_data.append("admin_address",admin_address);
    form_data.append("admin_phone",admin_phone);
    form_data.append("file",admin_image);//Gán form_data vào một cái tên là file mang theo dữ liệu hình ảnh, để khi qua php sẽ gọi tới .append là gán
    form_data.append("admin_email",admin_email);
    form_data.append("admin_password",admin_password);
    form_data.append("admin_status",admin_status);

    $.ajax({
        url : url+'/save-admin',
        method: 'POST',
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //Khai báo header gọi tới meta csrf đã khai báo ở đầu admin_layout 
            //attr là hàm lấy giá trị,thuộc tính
        },
        data:form_data
            //Mọi dữ liệu đã nằm trong form_data, nên chỉ cần khai báo form_data là được
        ,
        contentType: false,
        //Khi gửi dữ liệu đến máy chủ, hãy sử dụng kiểu nội dung này.
        //dataType (mặc định: Intelligent Guess (xml, json, script hoặc html)).Loại: Chuỗi.Loại dữ liệu bạn đang mong đợi trả lại từ máy chủ.
        cache: false,
        // Nếu được đặt thành false, nó sẽ buộc các trang được yêu cầu không được trình duyệt lưu vào bộ nhớ cache.
        processData:false,
        //Theo mặc định, dữ liệu được chuyển vào datatùy chọn dưới dạng một đối tượng (về mặt kỹ thuật, bất kỳ thứ gì khác ngoài chuỗi) 
        //sẽ được xử lý và chuyển đổi thành chuỗi truy vấn, phù hợp với loại nội dung mặc định "application / x-www-form-urlencoded". 
        //Nếu bạn muốn gửi DOMDocument hoặc dữ liệu không được xử lý khác, hãy đặt tùy chọn này thành false.
        success:function(data){
            // swal("Đã thêm tài khoản!","Thêm tài khoản thành công thành công!", "success");
            location.replace(url+'/all-admin');//Sau khi cập nhật thành công thì load lại danh sách
        }
    });
});
//Mở form chỉnh sửa 
$(document).on('click','.edit_admin_account_lonely', function(){
    // alert('ok edit');
    var url = $('meta[name="url"]').attr('content');
    var admin_id = $(this).data('admin_id');
    var _token = $('meta[name="csrf-token"]').attr('content');
    // alert(admin_id);
    // alert(_token);
    $.ajax({
        url : url+'/edit-admin',
        method: 'POST',
        data:{
            admin_id:admin_id,
            _token:_token
        },
        success:function(data){
            $('#show_edit_admin').html(data);
        }
    });


});
//Mở form chỉnh sửa 
$(document).on('click','.edit_admin', function(){
    // alert('ok edit');
    var url = $('meta[name="url"]').attr('content');
    var admin_id = $(this).data('admin_id');
    var _token = $('meta[name="csrf-token"]').attr('content');
    // alert(admin_id);
    // alert(_token);
    $.ajax({
        url : url+'/edit-admin',
        method: 'POST',
        data:{
            admin_id:admin_id,
            _token:_token
        },
        success:function(data){
            $('#show_edit_admin').html(data);
        }
    });


});
//Cập nhật hình ảnh
$('.update_admin').click(function(){
    // alert("được");
    var url = $('meta[name="url"]').attr('content');
    var admin_id = $('.admin_id').val();
    var admin_name = $('.admin_name').val();
    var admin_slug = $('.admin_slug').val();
    var admin_birdthday = $('.admin_birdthday').val();
    var admin_address = $('.admin_address').val();
    var admin_phone = $('.admin_phone').val();
    var admin_image = document.getElementById('admin_file').files[0];
    var admin_email = $('.admin_email').val();
    var admin_password = $('.admin_password').val();
    var admin_status = $('.admin_status').val();

    // alert(url);
    // alert(admin_id);
    // alert(admin_name);
    // alert(admin_slug);
    // alert(admin_phone);
    // alert(admin_image);
    // alert(admin_email);
    // alert(admin_password);
    // alert(admin_status);
    
    var form_data = new FormData();//Tạo 1 form data mới
    form_data.append("admin_id",admin_id);
    form_data.append("admin_name",admin_name);
    form_data.append("admin_slug",admin_slug);
    form_data.append("admin_birdthday",admin_birdthday);
    form_data.append("admin_address",admin_address);
    form_data.append("admin_phone",admin_phone);
    form_data.append("file",admin_image);//Gán form_data vào một cái tên là file mang theo dữ liệu hình ảnh, để khi qua php sẽ gọi tới .append là gán
    form_data.append("admin_email",admin_email);
    form_data.append("admin_password",admin_password);
    form_data.append("admin_status",admin_status);

    $.ajax({
        url : url+'/update-admin',
        method: 'POST',
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //Khai báo header gọi tới meta csrf đã khai báo ở đầu admin_layout 
            //attr là hàm lấy giá trị,thuộc tính
        },
        data:form_data
            //Mọi dữ liệu đã nằm trong form_data, nên chỉ cần khai báo form_data là được
        ,
        contentType: false,
        //Khi gửi dữ liệu đến máy chủ, hãy sử dụng kiểu nội dung này.
        //dataType (mặc định: Intelligent Guess (xml, json, script hoặc html)).Loại: Chuỗi.Loại dữ liệu bạn đang mong đợi trả lại từ máy chủ.
        cache: false,
        // Nếu được đặt thành false, nó sẽ buộc các trang được yêu cầu không được trình duyệt lưu vào bộ nhớ cache.
        processData:false,
        //Theo mặc định, dữ liệu được chuyển vào datatùy chọn dưới dạng một đối tượng (về mặt kỹ thuật, bất kỳ thứ gì khác ngoài chuỗi) 
        //sẽ được xử lý và chuyển đổi thành chuỗi truy vấn, phù hợp với loại nội dung mặc định "application / x-www-form-urlencoded". 
        //Nếu bạn muốn gửi DOMDocument hoặc dữ liệu không được xử lý khác, hãy đặt tùy chọn này thành false.
        success:function(data){
            swal("Cập nhật thành công!","Cập nhật tài khoản thành công!", "success");
            location.replace(url+'/dashboard')//Sau khi cập nhật thành công thì load lại danh sách
        }
    });
});
//Tìm kiếm admin
$('.search_admin').click(function(){
    // alert("được");
    var url = $('meta[name="url"]').attr('content');
    var _token = $('meta[name="csrf-token"]').attr('content')
    var admin_name = $('.search_admin_name').val();

    $.ajax({
        url : url+'/search-admin',
        method: 'POST',
        data:{
            _token:_token,
            admin_name:admin_name
        },
        success:function(data){
            $('#show_search_admin').html(data);
        }
    });
});
 //Tìm kiếm tự động tên admin-------------------------------------------------------------
$('#keywords_admin').keyup(function(){
    // alert("oki gòi pa");
    var auto_url = $('meta[name="url"]').attr('content');;
    var query = $(this).val();
    var _token = $('input[name="_token"]').val();
    // alert (auto_url);
    // alert (query);
    // alert (_token);
    if(query != ''){
        // alert('chạy e êi ! ');
        $.ajax({
            url: auto_url+'/autocomplete-search-admin-ajax',
            method:"POST",
            data:{
                query:query,
                _token:_token
            },
            success:function(data){
                $('#search_admin_ajax').fadeIn();
                // Phương thức fadeIn () dần dần thay đổi độ mờ đối với các phần tử đã chọn, từ ẩn sang hiển thị (hiệu ứng mờ dần).
                $('#search_admin_ajax').html(data);
                // hiển thị dữ liệu về
            }
        });
    }
    else{
        $('#search_admin_ajax').fadeOut();
        // alert('ko chạy e êi !');
    }
});
// Click vào thì sẽ hiện nội dung ra 
$(document).on('click','.a-auto-complete',function(){
    $('#keywords_admin').val($(this).text());//Hiển thị nội dung ra thẻ mang id #keyword
    $('#search_admin_ajax').fadeOut();//Tăt hiển thị auto-complete
});
$(document).on('blur','.search_admin_name',function(){
    $('#search_admin_ajax').fadeOut();//Tăt hiển thị auto-complete
});

//Chuyển tài khoản vào thùng rác
$(document).on('click','.unactive_admin',function(){
    // alert("xóa chết mọe m luôn");
    var url = $('meta[name="url"]').attr('content');
    var admin_id = $(this).data('admin_id');
    var _token = $('meta[name="csrf-token"]').attr('content');
    
    swal({
        title: "Bạn chắc chứ?",
        text: "Nếu bạn xóa, tài khoản sẽ được lưu trữ trong thùng rác!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Vâng, xóa tài khoản!",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
            url : url+'/unactive-waste-basket-admin',
            method: 'POST',
            data:{
                admin_id:admin_id,
                _token:_token
            },
            success:function(data){
                swal("Đã xóa!", "Đã chuyển vào thùng rác!", "success")
                window.setTimeout(function(){
                    location.reload();
                },800);
            }
        });
      });
    // alert(admin_id);
    
});
//Khôi phục tài khoản trong thùng rác
$(document).on('click','.active_admin',function(){
    // alert("xóa chết mọe m luôn");
    var url = $('meta[name="url"]').attr('content');
    var admin_id = $(this).data('admin_id');
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url : url+'/active-waste-basket-admin',
        method: 'POST',
        data:{
            admin_id:admin_id,
            _token:_token
        },
        success:function(data){
            swal("Đã khôi phục!", "Đã khôi phục tài khoản!", "success")
            window.setTimeout(function(){
                location.reload();
            },800);
        }
      });
    // alert(admin_id);
    
});


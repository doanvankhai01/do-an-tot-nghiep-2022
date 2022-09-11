$(document).ready(function(){
    load_gallery();
    //Hàm load danh sách ảnh
    function load_gallery(){
        var pro_id = $(".pro_id").val();
        var url = $('.url').val();
        var _token = $('input[name ="_token"]').val();
        // alert(pro_id);
        // alert(url);
        $.ajax({
            url : url+'/all-gallery',
            method: 'POST',
            data:{
                pro_id:pro_id,
                url:url,
                _token:_token
            },
            success:function(data){
                $('#gallery_load').html(data);
            }
        });
    }
    //Hàm load file
    $('#file').change(function(){
        var error = '';
        var files = $('#file')[0].files;
        alert(files);
        if(files.length > 5 ){
            error +='<p>Chỉ được chọn tối đa 5 ảnh.ss</p>';
        }else if (files.length == ''){
            error += '<p>Bạn không được bỏ trống ảnh</p>';
        }else if (files.size > 2000000){
            error +='File ảnh quá lớn';
        }

        if(error ==''){
            
        }else{
            alert("Lỗi");
            $('#file').val('');
            $('#error_gallery').html('<span class="text-danger">'+error+'</span>')
            return false;
        }
    });
    //Hàm cập nhật tên hình ảnh
    $(document).on('blur','.edit_gallery_name',function(){
        // on('blur') là mỗi lần click ra ngoài thì thực thi chương trình
        var url = $('.url').val();
        var gallery_id = $(this).data('gallery_name');//Lấy dữ liệu của data đã truyền vào là id
        var gallery_name = $(this).text();
        var slug = gallery_name;
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

        var gallery_slug = slug;
        var _token = $('input[name="_token"]').val();
        // alert(gallery_name);
        // alert(gallery_slug);
        $.ajax({
            url : url+'/update-name-gallery',
            method: 'POST',
            data:{
                gallery_id:gallery_id,
                gallery_name:gallery_name,
                gallery_slug:gallery_slug,
                _token:_token
            },
            success:function(data){
                swal("Thành công!", "Cập nhật tên thành công!", "success")
                load_gallery();//Sau khi cập nhật thành công thì load lại danh sách

            }
        });
    });
    //Xóa hình ảnh
    $(document).on('click','.delete_gallery',function(){
        // alert("được");
        var url = $('.url').val();
        var gallery_id = $(this).data('gal_id');//Lấy dữ liệu của data đã truyền vào là id
        var _token = $('input[name="_token"]').val();
        // alert(gallery_id);
        // alert(url);
        // alert(_token);
        swal({
            title: "Bạn chắc chứ?",
            text: "Bạn sẽ không thể lấy lại hình ảnh này!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Vâng, tôi chắc!",
            cancelButtonText: "Không, huy bỏ!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm) {
            if (isConfirm) {
              
              $.ajax({
                url : url+'/delete-gallery',
                method: 'POST',
                data:{
                    gallery_id:gallery_id,
                    _token:_token
                },
                success:function(data){
                    swal("Đã xóa!","Hình ảnh đã được xóa!", "success");
                    load_gallery();//Sau khi cập nhật thành công thì load lại danh sách
    
                }
            });
            } else {
              swal("Đã hủy", "Đã hủy xóa", "error");
            }
          });
        
    });
    //Cập nhật hình ảnh
    $(document).on('change','.update_gallery',function(){
        // alert("được");
        var url = $('.url').val();
        var gallery_id = $(this).data('gal_id');//Lấy dữ liệu của data đã truyền vào là id
        var image = document.getElementById('file-'+gallery_id).files[0];
        // var _token = $('input[name="_token"]').val();
        // alert(gallery_id);
        // alert(url);
        // alert(_token);
        // alert(image);
        var form_data = new FormData();//Tạo 1 form data mới

        form_data.append("file",image);//Gán form_data vào một cái tên là file mang theo dữ liệu hình ảnh, để khi qua php sẽ gọi tới .append là gán
        form_data.append("gallery_id",gallery_id);

        $.ajax({
            url : url+'/update-image-gallery',
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
                swal("Đã cập nhật!","Câp nhật hình ảnh thành công!", "success");
                load_gallery();//Sau khi cập nhật thành công thì load lại danh sách
            }
        });
    });
});

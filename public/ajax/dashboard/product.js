// // Thêm sản phẩm
// $('.add_product').click(function(){
//     var product_url = $('.url').val();
//     var product_name = $('.product_name').val();
//     var product_slug = $('.product_slug').val();
//     var product_price = $('.product_price').val();
//     var product_quantity = $('.product_quantity').val();
//     var product_desc = CKEDITOR.instances['product_desc'].getData();
//     var product_content = CKEDITOR.instances['product_content'].getData();
//     var brand_id = $('.brand_id').val();
//     var category_id = $('.category_id').val();
//     var product_status = $('.product_status').val();
//     var _token = $('input[name="_token"]').val();
//     // Xử lý ảnh trước khi chuyển qua 
//     var product_image_data = $('.product_image').val();
//     var ext = product_image_data.substring(checkImage.lastIndexOf('.') + 1).toLowerCase();
        // var file_data = $('#file').prop('files')[0];
//     // alert (product_url);
//     // alert (product_name);
//     // alert (product_slug);
//     // alert (product_price);
//     // alert (product_quantity);
//     alert (type);
//     alert (product_image_data);
//     // alert (product_desc);
//     // alert (product_content);
//     // alert (brand_id);
//     // alert (category_id);
//     // alert (product_status);
//     // alert (_token);
//     if(product_url == '' || product_name == '' || product_slug == '' ||product_price == '' ||product_quantity == '' ||product_image == '' || product_desc == '' || product_content == '' || category_id == '' || brand_id == '' || product_status == '' || _token == '' ){
//         swal("Thất bại!", "Có trường còn trống!", "error");
//         window.setTimeout(function(){
//             location.reload();
//         },3000);
//     }else{
       
//             $.ajax({
//                 url : product_url+"/save-product",
//                 dataType: 'text',
//                 cache: false,
//                 contentType: false,
//                 processData: false,
//                 method: 'POST',
//                 data:{
//                     product_name:product_name,
//                     product_slug:product_slug,
//                     product_price:product_price,
//                     product_quantity:product_quantity,
//                     product_image:product_image,
//                     product_desc:product_desc,
//                     product_content:product_content,
//                     brand_id:brand_id,
//                     category_id:category_id,
//                     product_status:product_status,
//                     _token:_token
//                 },
//                 success:function(data){
//                     // swal("Thành công!", "Thêm thương hiệu thành công!", "success");
//                     // window.location = product_url+"/all-product";
//                     alert(data);
//                 },
//             });
//             window.setTimeout(function(){
//                 location.reload();
//             },3000);
//     }
// });


//Thêm sản phẩm có hình ảnh 
$(document).ready(function(){
 
    var i=0;
    var dataImage = new Array();
    var dataPosition = new Array();
    // Hàm lấy hình ảnh 
    $(".product_image").change(function(){
        var checkImage = this.value;
        alert (checkImage);
        var ext = checkImage.substring(checkImage.lastIndexOf('.') + 1).toLowerCase();
        alert (ext);
        var file = $('.product_image').prop('files')[0];
        // var file = document.getElementById('product_image').files[0];
        alert(file);
        if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
        {
            alert("có  file");
            var file = $('.product_image').prop('files')[0];
            change(this);//gọi tới hàm change
            // var file = document.getElementById('product_image').files[0];
            // dataImage[i]=file; //thêm push vào dữ liệu mảng
            // dataPosition[i]=i;  //thêm vị trí đẩy vào dataPosition
           //created html progress
            // var html_progress = '<div class="progress" style="margin-bottom:5px;"><div class="progress-bar" id="progress-'+i+'" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div></div>';
            var html_progress = "<p>Đã có hình ảnh "+i+"</p>"
            $(".show_progress").append(html_progress);
            i++;
            // alert("thêm ảnh tạm thành công ") ;
        }
        else{
            swal("Lỗi!", "Vui lòng thêm file hình ảnh!", "error")
        }
    });
    // Hàm đọc dữ liệu hiển thị hình ảnh
    var change = function(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var addImage = '<div class="row>"<div class="col-md-3"><img src='+e.target.result+'></dic></div>';
                
                //add image to div="showImage"
                $("#showImage").append(addImage);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    // Đẩy dữ liệu đi 
    $('.add_product').click(function(){

    });
    //Hàm đẩy hình ảnh đi 
    var upload = function(data,position){
        var formData = new FormData(); 
           //append data to formdata
            formData.append('image',data);
            var id = position;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'http://localhost:8000/form/upload',
                data:formData,
                contentType: false,
                dataType:'json',
                processData: false,
                cache:false,
                xhr: function () {
                    console.log(id);
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            if(percentComplete==100){
                                dataImage.splice(id, 1);
                                dataPosition.splice(id, 1);
                            }
                            $("#progress-"+id).text(percentComplete + '%');
                            $("#progress-"+id).css('width', percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success:function(data){
                    console.log(data);
                }
                
            });
    }

    // $("form#upload").submit(function( event ) {
    //         event.preventDefault();
    //         var k=0;
    //         for(k=0; k<dataImage.length;k++){
                 
    //             /**
    //              * Function Upload
    //              * params 1: data image
    //              * params 2: position[ progressbar-1 or progressbar-2,...]
    //              */
    //             upload(dataImage[k],dataPosition[k]);
    //         }   
    // });


});

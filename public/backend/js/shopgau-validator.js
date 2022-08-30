// //Hàm kiểm tra định dạng email
// // function isEmail(emailStr)
// // {
// //         var emailPat=/^(.+)@(.+)$/
// //         var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
// //         var validChars="\[^\\s" + specialChars + "\]"
// //         var quotedUser="(\"[^\"]*\")"
// //         var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
// //         var atom=validChars + '+'
// //         var word="(" + atom + "|" + quotedUser + ")"
// //         var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
// //         var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
// //         var matchArray=emailStr.match(emailPat)
// //         if (matchArray==null) {
// //                 return false
// //         }
// //         var user=matchArray[1]
// //         var domain=matchArray[2]
 
// //         // See if "user" is valid
// //         if (user.match(userPat)==null) {
// //             return false
// //         }
// //         var IPArray=domain.match(ipDomainPat)
// //         if (IPArray!=null) {
// //             // this is an IP address
// //                   for (var i=1;i<=4;i++) {
// //                     if (IPArray[i]>255) {
// //                         return false
// //                     }
// //             }
// //             return true
// //         }
// //         var domainArray=domain.match(domainPat)
// //         if (domainArray==null) {
// //             return false
// //         }
 
// //         var atomPat=new RegExp(atom,"g")
// //         var domArr=domain.match(atomPat)
// //         var len=domArr.length
 
// //         if (domArr[domArr.length-1].length<2 ||
// //             domArr[domArr.length-1].length>3) {
// //            return false
// //         }
 
// //         if (len<2)
// //         {
// //            return false
// //         }
 
// //         return true;
// // }


// //login
// function admin_login_formm() {
//     x = document.forms["login"]["email"].value;
//     y = document.forms["login"]["password"].value;

//     var filter =/^[^ ]+@[^ ]+\.[a-z]{2,5}$/;
//     if (x == ""|| !filter.test(x.value)) {
//         alert('Vui lòng nhập Email! YÊU CẦU: Email phải có Tên + số + @ + Tên miền email +.com(hoặc .vn,......)');
//         return false;
//     }
//     if (y == "") {
//         alert("Vui lòng nhập mật khẩu!");
//         return false;
//     }
// }
// //add category
// function add_cate_pro() {
//     x = document.forms["addCate"]["category_product_name"].value;
//     y = document.forms["addCate"]["category_product_desc"].value;
    
//     if (x == "" || x.length < 3) {
//         alert('Tên danh mục không để trống và có ít nhất 3 kí tự');
//         return false;
//     }

//     if (y == ""|| y.length < 10) {
//         alert("Mô tả danh mục không được để trống và có ít nhất 10 kí tự!");
//         return false;
//     }
    
// }
// //edit category
// function edit_cate_pro() {
//     x = document.forms["editCate"]["category_product_name"].value;
//     y = document.forms["editCate"]["category_product_desc"].value;
    
//     if (x == "" || x.length < 3) {
//         alert('Tên danh mục không để trống và có ít nhất 3 kí tự');
//         return false;
//     }

//     if (y == ""|| y.length < 10) {
//         alert("Mô tả danh mục không được để trống và có ít nhất 10 kí tự!");
//         return false;
//     }
// }
//Auto hiện URL
function Product(){
    var slug;   
    //Lấy text từ thẻ input title 
    slug = document.getElementById("product_name").value;//lấy dữ liệu
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
    document.getElementById('product_slug').value = slug;
}
function Gallery(){
    var slug;   
    //Lấy text từ thẻ input title 
    slug = document.getElementById("gallery_name").value;//lấy dữ liệu
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
    document.getElementById('gallery_slug').value = slug;
}
function Brand(){
    var slug;   
    //Lấy text từ thẻ input title 
    slug = document.getElementById("brand_name").value;//lấy dữ liệu
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
    document.getElementById('brand_slug').value = slug;
}
function Category(){
    var slug;   
    //Lấy text từ thẻ input title 
    slug = document.getElementById("category_name").value;//lấy dữ liệu
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
    document.getElementById('category_slug').value = slug;
}
function Slider(){
    var slug;   
    //Lấy text từ thẻ input title 
    slug = document.getElementById("slider_name").value;//lấy dữ liệu
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
    document.getElementById('slider_slug').value = slug;
}



// Validation =========================================================================================
//Đăng nhập đăng xuất admin--------------------------------------------------------------------------------------------------------------------------
function validation_login(){
    var form = document.getElementById("form_login_admin");
    var email = document.getElementById("email_login_admin").value;
    var email_error = document.getElementById("email_error_admin");
    var pattern_email = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    var password = document.getElementById("password_login_admin").value;
    var password_error = document.getElementById("password_error_admin");


    
    //email
    if(email.match(pattern_email)){//email đủ
        // form.classList.add("valid");//classic gọi đến lớp trong css
        // form.classList.add("invalid");
        email_error.innerHTML = "Email chính xác!.<i class='fa fa-check'></i>";
        email_error.style.color = "#00ff00";
        email_error.style.fontFamily = "Courier New";
        email_error.style.fontSize ="12px";
        form.style.height ="400px";
    }else{//email ko đúng
        // form.classList.add("valid");
        // form.classList.add("invalid");
        email_error.innerHTML = "Địa chỉ Email chưa đúng!.<i class='fa fa-times'></i>";
        email_error.style.color = "#ff0000";
        email_error.style.fontFamily = "Courier New";
        email_error.style.fontSize ="12px";
        form.style.height ="400px";
    }
    if(email == ""){//trống
        // form.classList.remove("valid");
        // form.classList.remove("invalid");
        email_error.innerHTML = "Vui lòng nhập Email!<i class='fa fa-times'></i>";
        email_error.style.color = "#ff0000";
        email_error.style.fontFamily = "Courier New";
        email_error.style.fontSize ="12px";
        form.style.height ="400px";
    }
    //password
    if(password.length < 6){
        password_error.innerHTML = "Mật khẩu cần ít nhất 6 kí tự! <i class='fa fa-times'></i>";
        password_error.style.color = "#ff0000";
        password_error.style.fontFamily = "Courier New";
        password_error.style.fontSize ="12px";
        form.style.height ="400px";
        
    }else{
        password_error.innerHTML = "";
        // password_error.innerHTML = "Mật khẩu cần ít nhất 6 kí tự! <i class='fa fa-check'></i>";
        // password_error.style.color = "#00ff00";
        // password_error.style.fontFamily = "Courier New";
        // password_error.style.fontSize ="12px";
    }
    if(password == ""){//trống
        // form.classList.remove("valid");
        // form.classList.remove("invalid");
        password_error.innerHTML = "Vui lòng nhập mật khẩu!<i class='fa fa-times'></i>";
        password_error.style.color = "#ff0000";
        password_error.style.fontFamily = "Courier New";
        password_error.style.fontSize ="12px";
        form.style.height ="400px";
    }

}
//Đăng nhập đúng
//Đăng nhập sai
function login_admin_error(){
    var form = document.getElementById("form_login_admin");
    var login_error = document.getElementById("error_login_logout");
    //arlert('Đăng nhập thất bại!Vui lòng kiểm tra lại');
    login_error.innerHTML = "Đăng nhập thất bại, vui lòng kiểm tra lại!<i class='fa fa-times'></i>";
    login_error.style.color = "#ff0000";
    login_error.style.fontFamily = "Courier New";
    login_error.style.fontSize ="18px";
    login_error.style.marginLeft ="5%";
    form.style.height ="400px";
}
function logout_admin(){
    var logout = document.getElementById("error_login_logout");
    //arlert('Đăng nhập thất bại!Vui lòng kiểm tra lại');
    logout.innerHTML= "Đăng xuất thành công!<i class='fa fa-check'></i>";
    logout.style.color = "#ff0000";
    logout.style.fontFamily = "Courier New";
    logout.style.fontSize ="18px";
    logout.style.marginLeft ="5%";
    form.style.height ="400px";
}
//Danh mục sản phẩm--------------------------------------------------------------------------------------------------------------------------------------------------------------------
function validation_category(){
    var form = document.getElementById("add_category");
    var category_name = document.getElementById("category_name").value;
    //CKEDITOR.instances[textarea.category_name].updateElement();
    var category_desc = CKEDITOR.instances['category_desc'].getData( ).replace( /<[^>]*>/gi, '' ).length;
    // var category_desc = document.getElementById("category_desc").value;

    var category_name_error = document.getElementById("category_name_error");
    var category_desc_error = document.getElementById("category_desc_error");

    if(category_name.length <3 ){
        category_name_error.innerHTML = "Tên danh mục phải có từ 3 kí tự trở lên!.<i class='fa fa-times'></i>";
        category_name_error.style.color = "#ff0000";
        category_name_error.style.fontFamily = "Courier New";
        category_name_error.style.fontSize ="12px";
          
    }else{
        category_name_error.innerHTML = "";
    }
    if(category_name == ""){//
        category_name_error.innerHTML="Vui lòng nhập tên danh mục!<i class='fa fa-times'></i>";
        category_name_error.style.color = "#ff0000";
        category_name_error.style.fontFamily = "Courier New";
        category_name_error.style.fontSize ="12px";
    }

   
    if(category_desc == ""){//trống
        category_desc_error.innerHTML="Vui lòng nhập mô tả danh mục!<i class='fa fa-times'></i>";
        category_desc_error.style.color = "#ff0000";
        category_desc_error.style.fontFamily = "Courier New";
        category_desc_error.style.fontSize ="12px";
    } else{
        category_desc_error.innerHTML = "";
    }
}

//Brand Product----------------------------------------------------------------------------------
function validation_brand(){
    var form = document.getElementById("add_brand");
    var brand_name = document.getElementById("brand_name").value;
    //var brand_desc = document.getElementById("brand_desc").value;
    var brand_desc = CKEDITOR.instances['brand_desc'].getData( ).replace( /<[^>]*>/gi, '' ).length;

    var brand_name_error = document.getElementById("brand_name_error");
    var brand_desc_error = document.getElementById("brand_desc_error");

    if(brand_name.length <3 ){
        brand_name_error.innerHTML = "Tên thương hiệu phải có từ 3 kí tự trở lên!.<i class='fa fa-times'></i>";
        brand_name_error.style.color = "#ff0000";
        brand_name_error.style.fontFamily = "Courier New";
        brand_name_error.style.fontSize ="12px";
          
    }else{
        brand_name_error.innerHTML = "";
    }
    if(brand_name == ""){//
        brand_name_error.innerHTML="Vui lòng nhập tên thương hiệu!<i class='fa fa-times'></i>";
        brand_name_error.style.color = "#ff0000";
        brand_name_error.style.fontFamily = "Courier New";
        brand_name_error.style.fontSize ="12px";
    }


    if(brand_desc == ""){//trống
        brand_desc_error.innerHTML="Vui lòng nhập mô tả thương hiệu!<i class='fa fa-times'></i>";
        brand_desc_error.style.color = "#ff0000";
        brand_desc_error.style.fontFamily = "Courier New";
        brand_desc_error.style.fontSize ="12px";
    }else{
        brand_desc_error.innerHTML = "";
    }
}

//product
function validation_product(){
    var product_name = document.getElementById("product_name").value;
    var product_price = document.getElementById("product_price").value;
    var product_image = document.getElementById("product_image").value;
    var product_desc = document.getElementById("product_desc").value;
    var product_content = document.getElementById("product_content").value;

    var product_name_error = document.getElementById("product_name_error");
    var product_price_error = document.getElementById("product_price_error");
    var product_image_error = document.getElementById("product_image_error");
    var product_desc_error = document.getElementById("product_desc_error");
    var product_content_error = document.getElementById("product_content_error");

    //name
    if(product_name.length <3 ){
        product_name_error.innerHTML = "Tên sản phẩm phải có từ 3 kí tự trở lên!.<i class='fa fa-times'></i>";
        product_name_error.style.color = "#ff0000";
        product_name_error.style.fontFamily = "Courier New";
        product_name_error.style.fontSize ="12px";
          
    }else{
        product_name_error.innerHTML = "";
    }
    if(product_name == ""){//trống
        product_name_error.innerHTML="Vui lòng nhập tên sản phẩm!<i class='fa fa-times'>";
        product_name_error.style.color = "#ff0000";
        product_name_error.style.fontFamily = "Courier New";
        product_name_error.style.fontSize ="12px";
    }
    //price
    var pattern_price = /^[0-9]{4,9}$/;
    if(product_price.length >=15){
        product_price_error.innerHTML="Số tiền quá lớn!<i class='fa fa-times'>";
        product_price_error.style.color = "#ff0000";
        product_price_error.style.fontFamily = "Courier New";
        product_price_error.style.fontSize ="12px";
    }
    if(product_price <=1000){
        product_price_error.innerHTML="Số tiền phải ít nhất 1000 đồng!<i class='fa fa-times'>";
        product_price_error.style.color = "#ff0000";
        product_price_error.style.fontFamily = "Courier New";
        product_price_error.style.fontSize ="12px";
    }
    if(product_price.match(pattern_price)){//trống
        product_price_error.innerHTML="";
    }else{
        product_price_error.innerHTML = "Số tiền không có chữ kí tự đặc biệt, khoảng trắng, phải từ 1.000 đồng trở lên và không quá 999.999.999 đồng!.<i class='fa fa-times'></i>";
        product_price_error.style.color = "#ff0000";
        product_price_error.style.fontFamily = "Courier New";
        product_price_error.style.fontSize ="12px";
    }
    if(product_price == ""){//trống
        product_price_error.innerHTML="Vui lòng nhập số tiền!<i class='fa fa-times'>";
        product_price_error.style.color = "#ff0000";
        product_price_error.style.fontFamily = "Courier New";
        product_price_error.style.fontSize ="12px";
    }
    //image
    if(product_image==""){//trống
        product_image_error.innerHTML = "Ảnh không được để trống.<i class='fa fa-times'></i>";
        product_image_error.style.color = "#ff0000";
        product_image_error.style.fontFamily = "Courier New";
        product_image_error.style.fontSize ="12px";
        
    }else{
        product_image_error.innerHTML="";
    }
    // if(product_image == ""){//trống
    //     product_image_error.innerHTML="";
    // }
    //desc
    if(product_desc.length <15 ){
        product_desc_error.innerHTML = "Mô tả sản phẩm phải có từ 15 kí tự trở lên!.<i class='fa fa-times'></i>";
        product_desc_error.style.color = "#ff0000";
        product_desc_error.style.fontFamily = "Courier New";
        product_desc_error.style.fontSize ="12px";
          
    }else{
        product_desc_error.innerHTML = "";
    }
    if(product_desc == ""){//trống
        product_desc_error.innerHTML="Vui lòng nhập mô tả sản phẩm!<i class='fa fa-times'>";
        product_desc_error.style.color = "#ff0000";
        product_desc_error.style.fontFamily = "Courier New";
        product_desc_error.style.fontSize ="12px";
    }
    //content
    if(product_content.length <15 ){
        product_content_error.innerHTML = "Nội dung sản phẩm phải có từ 15 kí tự trở lên!.<i class='fa fa-times'></i>";
        product_content_error.style.color = "#ff0000";
        product_content_error.style.fontFamily = "Courier New";
        product_content_error.style.fontSize ="12px";
          
    }else{
        product_content_error.innerHTML = "";
    }
    if(product_content == ""){//trống
        product_content_error.innerHTML="Vui lòng nhập nội dung sản phẩm!<i class='fa fa-times'>";
        product_content_error.style.color = "#ff0000";
        product_content_error.style.fontFamily = "Courier New";
        product_content_error.style.fontSize ="12px";
    }
    

}
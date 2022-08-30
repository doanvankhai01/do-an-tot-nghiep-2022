window.onscroll = function() {menuScrollFunction()};//Khi lướt màn hình thì thực hiện chương trình
var navbar = document.getElementById("class-menu-menu");
// Lấy id
var sticky = navbar.offsetTop;// Ý nghĩa: Cho sticky lấy navbar(menu) là tính khoảng cách pixel của vị trí trên cùng so với vị trí hiện tại của menu
// Thuộc tính offsetTop trả về vị trí trên cùng (tính bằng pixel) so với vị trí chính.
// Giá trị trả về bao gồm:
    //-> vị trí trên cùng và lề của phần tử
    //-> phần đệm trên cùng, thanh cuộn và đường viền của cha mẹ
// Thuộc tính offsetTop ở chế độ chỉ đọc.
function menuScrollFunction() {
if (window.pageYOffset >= sticky) {//Nếu số pixel đã cuộn nhiều hơn hoặc bằng khoảng cách pixel thì gọi class css sticky
// Thuộc tính pageXOffset trả về các pixel mà tài liệu đã cuộn từ góc trên bên trái của cửa sổ.
// Tài sản pageXOffset bằng scrollXtài sản.
// Thuộc tính pageXOffset ở chế độ chỉ đọc.
    navbar.classList.add("sticky")
} else {//nếu nhỏ hơn thì xóa class css sticky
    navbar.classList.remove("sticky");
}
}   
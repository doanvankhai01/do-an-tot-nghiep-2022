$(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,//chạy nhiều hình ảnh 
        item:1,// số hình ảnh chạy khi click
        loop:true,// có vòng lặp 
        thumbItem:5,//Hiển thị số ảnh trong vòng lặp 
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
});
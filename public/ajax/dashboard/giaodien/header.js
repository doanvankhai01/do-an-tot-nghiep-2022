// Xử lí cuộn màn hình
window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
        if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
            document.getElementById("menu-menu-menu").style.height = "60px";
            
            document.getElementById("btn-info-title-1").style.padding = "2%";
            document.getElementById("btn-info-title-1").style.width = "100%";
            document.getElementById("btn-info-title-1").style.margin = "3%"

            document.getElementById("btn-info-title-2").style.padding = "2%";
            document.getElementById("btn-info-title-2").style.width = "100%";
            document.getElementById("btn-info-title-2").style.margin = "3%";

            document.getElementById("btn-info-title-3").style.padding = "2%";
            document.getElementById("btn-info-title-3").style.width = "100%";
            document.getElementById("btn-info-title-3").style.margin = "3%";

            document.getElementById("btn-info-title-4").style.padding = "2%";
            document.getElementById("btn-info-title-4").style.width = "100%";
            document.getElementById("btn-info-title-4").style.margin = "3%";

            document.getElementById("logo-background-admin").style.height = "4.5%";
            document.getElementById("logo-img").style.width = "15%";
            document.getElementById("img-scroll").style.marginBottom = "0%";
            

        } else {
            document.getElementById("menu-menu-menu").style.height = "115px";
            
            document.getElementById("btn-info-title-1").style.padding = "7%";
            document.getElementById("btn-info-title-1").style.width = "100%";
            document.getElementById("btn-info-title-1").style.margin = "7%";

            document.getElementById("btn-info-title-2").style.padding = "7%";
            document.getElementById("btn-info-title-2").style.width = "100%";
            document.getElementById("btn-info-title-2").style.margin = "7%";

            document.getElementById("btn-info-title-3").style.padding = "7%";
            document.getElementById("btn-info-title-3").style.width = "100%";
            document.getElementById("btn-info-title-3").style.margin = "7%";

            document.getElementById("btn-info-title-4").style.padding = "7%";
            document.getElementById("btn-info-title-4").style.width = "100%";
            document.getElementById("btn-info-title-4").style.margin = "7%";
            
            document.getElementById("logo-background-admin").style.height = "10%";
            document.getElementById("logo-img").style.width = "25%";
            document.getElementById("img-scroll").style.marginBottom = "15%";
            
        }
        }
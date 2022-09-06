$(document).ready(function(){
    //load dữ liệu 60 ngày gần nhất
    chart60daysorder();
    //Lấy dữu liệu lượng truy cập
    show_visitor();
    //load toàn bộ dữ liệu tìm kiếm và truyền vào biểu đồ
    var chart = new Morris.Bar({
        element: 'mychart',
        //Cấu hình giao diện
        barColors:['#A0522D', '#A0522D','#F4A460','#CD853F'],   
        //Biểu đồ cột
        stacked:false,//chồng cột
        gridTextColor:"blueviolet",//màu chữ tại trục
        //gridLineColor: 'blueviolet',//thay màu thanh ngang, nhưng chỉ đc với Line và Area
        gridColor:"blueviolet",
        //gridTextFamily:none,//font chữ
        gridTextWeight:'bold',
        hideHover:'auto',//tự động đóng mở chú thích
        parseTime: false,
        // xkey: 'period',
        xkey: 'date',
        ykeys: ['order', 'sales', 'profit', 'quantity'],
        labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng'],
        
      });
    //Lấy dữ liệu doanh số 60 ngày
    function chart60daysorder(){
        // alert("Đc gòi ciu");
        var url = $('.url').val();  
        var _token = $('input[name="_token"]').val();

        // alert(date_start);
        // alert(date_end);
        // alert(_token);
        // alert(url);

        $.ajax({
            url : url+'/load-sixty-day-statistical',
            method: 'POST',
            dataType: 'JSON',
            data:{
                _token:_token
            },
            success:function(data){
            //    location.reload(chart.setData(data)).parseTime(false);
               chart.setData(data);
                //lưu ý: data ko phải là 1 biến, mà là cả 1 function bên controller
               //location.reload().parseTime(false);
            }
           
        });
    }
    //Thống kê doanh thu theo ngày đã định
    $('.btn-search-statistical').click(function(){
        var url = $('.url').val();
        var date_start = $('.date-start').val();
        var date_end = $('.date-end').val();
    //  var date_start = $('#datepicker1').val();
    //  var date_end = $('#datepicker2').val();
        var _token = $('input[name="_token"]').val();
        // alert(date_start);
        // alert(date_end);
        // alert(_token);
        // alert(url);
        $.ajax({
            url : url+'/filter-statistical-by-day',
            method: 'POST',
            dataType: 'JSON',
            data:{
                date_start:date_start,
                date_end:date_end,
                _token:_token
            },
            success:function(data){
            //    location.reload(chart.setData(data)).parseTime(false);
               chart.setData(data)
                //lưu ý: data ko phải là 1 biến, mà là cả 1 function bên controller
               //location.reload().parseTime(false);
            }
           
        });
        
    });
    //Thống kê doanh thu bằng cách lọc
    $('.filter-statistical').change(function(){
        var url = $('.url').val();
        var filter_statistical = $(this).val();//lấy chính dữ liệu thay đổi
        var _token = $('input[name="_token"]').val();
        // alert(filter_thirty);
        // alert(_token);
        // alert(url);
        $.ajax({
            url : url+'/filter-statistical',
            method: 'POST',
            dataType: 'JSON',//trả về kiểu
            data:{
                filter_statistical:filter_statistical,
                _token:_token
            },
            success:function(data){
            //    location.reload(chart.setData(data)).parseTime(false);
               chart.setData(data)
                //lưu ý: data ko phải là 1 biến, mà là cả 1 function bên controller
               //location.reload().parseTime(false);
            }
           
        });
        
    });
    //Lấy dữ liệu lượng truy cập
    function show_visitor(){
        // alert("Đc gòi ciu");
        var url = $('.url').val();  
        var _token = $('input[name="_token"]').val();

        // alert(date_start);
        // alert(date_end);
        // alert(_token);
        // alert(url);

        $.ajax({
            url : url+'/show-visitor',
            method: 'POST',
            dataType: 'JSON',
            data:{
                _token:_token
            },
            success:function(data){
            //    location.reload(chart.setData(data)).parseTime(false);
               chart.setData(data);
                //lưu ý: data ko phải là 1 biến, mà là cả 1 function bên controller
               //location.reload().parseTime(false);
            }
           
        });
    }
});
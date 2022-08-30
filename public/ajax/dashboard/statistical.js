$(document).ready(function(){
    // chart30daysorder();
    //load toàn bộ dữ liệu và truyền vào biểu đồ
    var chart = new Morris.Bar({
        
        element: 'myfirstchart',
        //Cấu hình giao diện
        lineColors:['#A0522D', 'blueviolet','#A0522D','#A0522D','#A0522D'],
        // data:[{order: '20'}, {sales:'30'}, {profit:'50'}, {quantity:'40'}],
        // dành riêng cho biểu đồ đường
        // pointFillColors:["white"],//nền tròn
        // pointStrokeColors:['blueviolet'],//viền nền tròn
        // fillOpactity:0.3,

        hideHover:'auto',//tự động đóng mở chú thích
        parseTime: false,
        xkey: 'period',
        ykeys: ['order', 'sales', 'profit', 'quantity'],
        labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng'],
        
      });
    // function chart30daysorder(){}
    //Thống kê doanh thu theo ngày đã định
    $('#btn-filter-statistical').click(function(){
        // alert("Đc gòi ciu");
        var url = $('.url').val();
        // var date_start = $('#date-start').val();
        // var date_end = $('#date-end').val();
        var date_start = $('#datepicker1').val();
        var date_end = $('#datepicker2').val();
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
});
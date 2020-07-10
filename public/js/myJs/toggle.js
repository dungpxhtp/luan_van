$(document).ready(function(){
    if($("#status").is(":checked"))
    {
        $(".status").text('Đang Hoạt Động');
    }else
    {
        $(".status").text('Tắt Hoạt Động');
    }
    $('#status').click(function(){
        if($("#status").is(":checked"))
        {
            $(".status").text('Đang Hoạt Động');
        }else
        {
            $(".status").text('Tắt Hoạt Động');
        }
    });
    if($("#serinumber").is(":checked"))
    {
        $(".serinumber").text('Có Số SeriNumber');
    }else
    {
        $(".serinumber").text('Không Có Số Serinumber');
    }
    $('#serinumber').click(function(){
        if($("#serinumber").is(":checked"))
        {
            $(".serinumber").text('Có số Serinumber');
        }else
        {
            $(".serinumber").text('Không có số Serinumber');
        }
    });
});

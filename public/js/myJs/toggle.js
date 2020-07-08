$(document).ready(function(){
    if($("#status").is(":checked"))
    {
        $(".custom-control-label").text('Đang Hoạt Động');
    }else
    {
        $(".custom-control-label").text('Tắt Hoạt Động');
    }
    $('#status').click(function(){
        if($("#status").is(":checked"))
        {
            $(".custom-control-label").text('Đang Hoạt Động');
        }else
        {
            $(".custom-control-label").text('Tắt Hoạt Động');
        }
    });
});

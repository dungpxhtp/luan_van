$(document).ready(function(){
    $('#price').keyup(function(){

        if (($.trim($('#price').val()) == ''))
          {
            $('.price-formart').text('');


          }else
          {
            var x=$(this).val();

            var formart = parseInt(x).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});

            $('.price-formart').text("Tiền : " + formart);
          }

    });
});


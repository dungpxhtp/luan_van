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

    $('#price_km').keyup(function(){

        if (($.trim($('#price_km').val()) == ''))
          {
            $('.price-formart-km').text('');


          }else
          {
            var x=$(this).val();

            var formart = parseInt(x).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});

            $('.price-formart-km').text("Tiền : " + formart);
          }

    });
});


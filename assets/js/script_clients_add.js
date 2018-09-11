$(function(){

    $('input[name=phone]').mask('00-0000-0000', {reverse:true, placeholder:"(00)0000-0000"});
    $('input[name=address_zipcode]').mask('00000-000', {reverse:true, placeholder:"00000-000"});
    $('input[name=cpf]').mask('000.000.000-00', {reverse:true, placeholder:"000.000.000-00"});

});

$('input[name=address_zipcode]').on('blur', function () {
    var cep = $(this).val();

    $.ajax({
        url: 'http://api.postmon.com.br/v1/cep/'+cep,
        type:'GET',
        dataType: 'json',
        success:function(json) {
            if (typeof json.logradouro != 'undefinedd') {
                $('input[name=address]').val(json.logradouro);
                $('input[name=address_neighb]').val(json.bairro);
                $('input[name=address_city]').val(json.cidade);
                $('input[name=address_state]').val(json.estado);
                $('input[name=address_country]').val("Brasil");
                $('input[name=address_number]').focus();
            }
        }
    });
});


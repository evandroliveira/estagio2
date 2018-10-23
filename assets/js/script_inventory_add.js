$(function(){

	$('input[name=price]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"R$ 0,00"});
    $('input[name=price_sale]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"R$ 0,00"});

});
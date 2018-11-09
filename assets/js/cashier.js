$(function(){

    $('input[name=opening_balance]').mask('000.000.000.000,00', {reverse:true, placeholder:"0,00"});
    $('input[name=final_balance]').mask('000.000.000.000,00', {reverse:true, placeholder:"0,00"});
    $('input[name=difference]').mask('000.000.000.000,00', {reverse:true, placeholder:"0,00"});

});

function caixa() {
    var n1 = parseInt(document.getElementById('n1').value, 10);
    var n2 = parseInt(document.getElementById('n2').value, 10);


   document.getElementById('result').value = n2 - n1;
}
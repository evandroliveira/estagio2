$(function(){

    $('input[name=opening_balance]').mask('000.000.000.000,00', {reverse:true, placeholder:"0,00"});
    $('input[name=final_balance]').mask('000.000.000.000,00', {reverse:true, placeholder:"0,00"});
    $('input[name=difference]').mask('000.000.000.000,00', {reverse:true, placeholder:"0,00"});

});

function caixa() {
    var n1 = parseFloat(document.getElementById('n1').value.replace('.', '').replace(',', '.'));
    var n2 = parseFloat(document.getElementById('n2').value.replace('.', '').replace(',', '.'));

    var diferenca = n2 - n1;
   document.getElementById('result').value = diferenca.toFixed(2);
}
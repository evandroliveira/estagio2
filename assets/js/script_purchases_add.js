function calcular() {
    var n1 = parseFloat(document.getElementById('n1').value.replace('.', '').replace(',', '.'));
    var n1 = parseFloat(document.getElementById('n2').value.replace('.', '').replace(',', '.'));

    var diferenca = n1 - n2;
    document.getElementById('resultado').value = diferenca.toFixed(2);


}

function parcelas() {
    var n3 = parseInt(document.getElementById('n3').value, 10);
    var resultado = parseFloat(document.getElementById('resultado').value.replace('.', '').replace(',', '.'));

    var valor = resultado / n3;

    document.getElementById('result_parcelas').value = valor.toFixed(2);
}


function selectProvider(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).html();

    $('.searchresults').hide();
    $('#provider_name').val(name);
    $('input[name=provider_id]').val(id);
}
function updateSubtotal(obj) {
    var quant = $(obj).val();
    if(quant <= 0) {
        $(obj).val(1);
        quant = 1;
    }

    var price = $(obj).attr('data-price');
    var subtotal = price * quant;

    $(obj).closest('tr').find('.subtotal').html('R$ '+subtotal);

    updateTotal();

}
function updateTotal() {
    //inicia com total 0
    var total = 0;
    var valor_parcel = 0;
    //vai dar um loop em cada item do carrinho
    for(var q=0;q<$('.p_quant').length;q++) {
        //seleciona o item
        var quant = $('.p_quant').eq(q);
        //pega o preço e a quantidade e faz a mutiplicação
        var price = quant.attr('data-price');
        var subtotal = price * parseInt(quant.val());
        //pega o valor e soma com subtotal
        total += subtotal;

    }
    //a variavel total vai ter a soma de todos os itens do carrinho
    $('input[name=total_price]').val(total);
}
function excluirProd(obj) {
    $(obj).closest('tr').remove();
}

function addProd(obj) {
    $('#add_prod').val('');
    var id = $(obj).attr('data-id');
    var name = $(obj).attr('data-name');
    var price = $(obj).attr('data-price');

    $('.searchresults').hide();
    //criando o html e adicionando ele na tabela 
    if( $('input[name="quant['+id+']"]').length == 0 ) {
        var tr =
            '<tr>'+ //adicionando o produto na tabela
            '<td>'+name+'</td>'+
            '<td>'+      //quant vai ser um array
            '<input type="number" name="quant['+id+']" class="p_quant" value="1" onchange="updateSubtotal(this)" data-price="'+price+'" />'+
            '</td>'+
            '<td>R$ '+price+'</td>'+
            '<td class="subtotal">R$ '+price+'</td>'+
            '<td><a href="javascript:;" onclick="excluirProd(this)">Excluir</a></td>'+
            '</tr>';

        $('#products_table').append(tr);
    }

    updateTotal();

}

$(function(){

    $('input[name=total_price]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});

    $('.client_add_button').on('click', function(e){
        e.preventDefault();

        var name = $('#provider_name').val();
        if(name != '' && name.length >= 4) {

            if(confirm('Você deseja adicionar um fornecedor com nome: '+name+' ?')) {

                $.ajax({
                    url:BASE_URL+'/ajax/add_provider',
                    type:'POST',
                    data:{name:name},
                    dataType:'json',
                    success:function(json) {
                        $('.searchresults').hide();
                        $('input[name=provider_id]').val(json.id);
                    }
                });

                return false;

            }
        }

    });

    $('#provider_name').on('keyup', function(){
        var datatype = $(this).attr('data-type');
        var q = $(this).val();

        if(datatype != '') {
            $.ajax({
                url:BASE_URL+'/ajax/'+datatype,
                type:'GET',
                data:{q:q},
                dataType:'json',
                success:function(json) {
                    if( $('.searchresults').length == 0 ) {
                        $('#provider_name').after('<div class="searchresults"></div>');
                    }
                    $('.searchresults').css('left', $('#provider_name').offset().left+'px');
                    $('.searchresults').css('top', $('#provider_name').offset().top+$('#provider_name').height()+3+'px');

                    var html = '';

                    for(var i in json) {
                        html += '<div class="si"><a href="javascript:;" onclick="selectProvider(this)" data-id="'+json[i].id+'">'+json[i].name+'</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }

    });

    $('#add_prod').on('keyup', function(){
        var datatype = $(this).attr('data-type');
        var q = $(this).val();

        if(datatype != '') {
            $.ajax({
                url:BASE_URL+'/ajax/'+datatype,
                type:'GET',
                data:{q:q},
                dataType:'json',
                success:function(json) {
                    if( $('.searchresults').length == 0 ) {
                        $('#add_prod').after('<div class="searchresults"></div>');
                    }
                    $('.searchresults').css('left', $('#add_prod').offset().left+'px');
                    $('.searchresults').css('top', $('#add_prod').offset().top+$('#add_prod').height()+3+'px');

                    var html = '';

                    for(var i in json) {
                        html += '<div class="si"><a href="javascript:;" onclick="addProd(this)" data-id="'+json[i].id+'" data-price="'+json[i].price+'" data-name="'+json[i].name+'">'+json[i].name+' - R$ '+json[i].price+'</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }

    });

    $(function () {
       PagSeguroDirectPayment.getInstallments({

       });
    });

});









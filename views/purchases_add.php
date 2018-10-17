<h1>Compras - Adicionar</h1>

<form method="POST">
	<label for="provider_name">Nome do Fornecedor</label><br/>
	<input type="hidden" name="provider_id" />
	<input type="text" name="provider_name" id="provider_name" data-type="search_provider" /> <button class="provider_add_button">+</button>
	<div style="clear:both"></div>
	<br/><br/>

	<label for="status">Status da Compra</label><br/>
	<select name="status" id="status">
		<option value="0">A Prazo</option>
		<option value="1">À Vista</option>
<!--		<option value="2">Cancelado</option>-->
	</select><br/><br/>
    <input type="hidden" name="id_movimento," value="1">
    <input type="hidden" name="descricao_movimento" value="Compra">


    <label for="total_price">Preço da Compra: </label><br>
    <input type="text" name="total_price" value="total_price" id="n1" disabled="disabled"/><br><br>

    <fieldset>
        <legend>Parcelas</legend>

            <label for="vencimento_movimento" style="color: red;">Vencimento</label>
            <input  type="date" name="vencimento_movimento"  style="width: 150px;"/>

            <label for="pagamento_movimento" style="margin-left: 10px;">Pagamento</label>
            <input  type="text" name="pagamento_movimento" value="" id="n2" onblur="calcular();" style="width: 180px;"/>

            <label for="valor_movimento" style="margin-left: 15px;">Valor do movimento</label>
            <input  type="text" name="valor_movimento"  id="resultado" disabled="disabled" style="width: 180px;"/><br><br>

            <label for="qtde_parcel" >Qtde. Parcelas</label>
            <input  type="number" name="qtde_parcel" value="1"  id="n3" onblur="parcelas();" style="width: 180px;"/>

            <label for="valor_parcelas" style="margin-left: 10px;" >Valor das parcelas</label>
            <input  type="text" name="valor_parcelas"  id="result_parcelas" disabled="disabled" style="width: 180px;"/>

    </fieldset>

	<h4>Produtos</h4>

	<fieldset>
		<legend>Adicionar Produto</legend>

		<input type="text" id="add_prod" data-type="search_products" />
	</fieldset>

	<table border="0" width="100%" id="products_table">
		<tr>
			<th>Nome do Produto</th>
			<th style="size: 40px;">Quantidade</th>
			<th>Preço Unit.</th>
			<th>Sub-Total</th>
			<th>Excluir</th>
		</tr>
	</table>

	<hr/>
	<input type="submit" value="Finalizar Compra" />
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_purchases_add.js"></script>
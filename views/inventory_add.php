<h1>Produtos - Adicionar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">

	<label for="name">Nome<span style="color: #FF0000;"> @</span></label><br/>
	<input type="text" name="name" required /><br/><br/>

	<label for="price">Preço de Custo<span style="color: #FF0000;"> @ $</span></label><br/>
    <input type="text" name="price" required /><br/><br/>

    <label for="price_sale">Preço de Venda<span style="color: #FF0000;"> @ $</span></label><br/>
    <input type="text" name="price_sale" required /><br/><br/>

	<label for="quant">Quantidade em Estoque<span style="color: #FF0000;"> @</span></label><br/>
	<input type="number" name="quant" required /><br/><br/>

	<label for="min_quant">Quantidade Mínima em Estoque<span style="color: #FF0000;"> @</span></label><br/>
	<input type="number" name="min_quant" required /><br/><br/>

	<input type="submit" value="Adicionar" />

</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_inventory_add.js"></script>
<h1>Relatório de Estoque</h1>
<form method="GET" onsubmit="return openPopup(this)">
	<div style="clear:both"></div>

	<div style="text-align:left">
		<input type="submit" value="Produtos abaixo do estoque" />
	</div>

</form>
<form method="GET" onsubmit="return openPopupe(this)">
    <div style="clear:both"></div>

    <div style="text-align:left">
        <input type="submit" value="Produtos em estoque" />
    </div>

</form>
<form method="GET" onsubmit="return openPopupev(this)">
    <div style="clear:both"></div>

    <div style="text-align:left">
        <input type="submit" value="Produtos mais vendidos" />
    </div>

</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_inventory.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_estoque.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_mais_vendidos.js"></script>
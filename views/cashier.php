<h1>Caixa</h1>

<div class="db-row row1">
	<div class="grid-1">
		<div class="button"><a href="<?php echo BASE_URL; ?>/cashier/add">Adicionar Movimento</a></div><br><br>
		<div class="db-grid-area">
			<form method="POST">
				<fieldset>
					<legend>Entradas e Saidas</legend>
					<h4>Entradas:</h4><?php$data['revenue'] = $s->getTotalCaixa(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());?>

				</fieldset>
			</form>

		</div>
	</div>
	
</div>





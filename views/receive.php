<h1>Contas a Receber</h1>



<table border="0" width="100%">
	<tr>
		<th>Nome do Cliente</th>
		<th>Data</th>
		<th>Status</th>
		<th>Valor</th>
		<th>Ações</th>
	</tr>
	<?php foreach($receive_list as $receive): ?>
	<tr>
		<td><?php echo $receive['name']; ?></td>
		<td><?php echo date('d/m/Y', strtotime($receive['date_sale'])); ?></td>
		<td><?php echo $statuses[$receive['status']]; ?></td>
		<td>R$ <?php echo number_format($receive['total_price'], 2, ',', '.'); ?></td>
		<td>
			<div class="button button_small"><a href="<?php echo BASE_URL; ?>/sales/edit/<?php echo $receive['id']; ?>">Pagar</a></div>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<h1>Vendas</h1>

<div class="button"><a href="<?php echo BASE_URL; ?>/sales/add">Adicionar Venda</a></div>

<table border="0" width="100%">
	<tr>
		<th>Nome do Cliente</th>
		<th>Data</th>
		<th>Status</th>
        <th>Valor</th>
        <th>Qtde. Parcelas</th>
        <th>Valor das parcelas</th>
	</tr>
	<?php foreach($sales_list as $sale_item): ?>
	<tr>
		<td><?php echo $sale_item['name']; ?></td>
		<td><?php echo date('d/m/Y', strtotime($sale_item['date_sale'])); ?></td>
		<td style="width: 200px;"><?php echo $statuses[$sale_item['status']]; ?></td>
		<td>R$ <?php echo number_format($sale_item['total_price'], 2, ',', '.'); ?></td>
        <td><?php echo $sale_item['total_parcel']; ?></td>
        <td>R$ <?php echo number_format($sale_item['value_parcel'], 2, ',', '.'); ?></td>
		
	</tr>
	<?php endforeach; ?>
</table>
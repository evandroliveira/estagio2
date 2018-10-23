<style type="text/css">
    th { text-align:left; }
</style>
<h1>Relatório de Compras</h1>

<fieldset>
    <?php
    if(isset($filters['provider_name']) && !empty($filters['provider_name'])) {
        echo "Filtrado pelo cliente: ".$filters['prvider_name']."<br/>";
    }
    if(!empty($filters['period1']) && !empty($filters['period2'])) {
        echo "Filtrado no período: ".date('d/m/Y', strtotime($filters['period1']))." a ".date('d/m/Y', strtotime($filters['period2']))."<br/>";
    }
    if($filters['status'] != '') {
        echo "Filtrado com status: ".$statuses1[$filters['status']];
    }
    ?>
</fieldset>
<br/>
<table border="0" width="100%">
    <tr>
        <th>Nome do Fornecedor</th>
        <th>Data</th>
        <th>Status</th>
        <th>Valor</th>
    </tr>
    <?php foreach($purchases_list as $purchase_item): ?>
        <tr>
            <td><?php echo $purchase_item['name']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($sale_item['date_purchase'])); ?></td>
            <td><?php echo $statuses[$purchase_item['status']]; ?></td>
            <td>R$ <?php echo number_format($purchase_item['total_price'], 2, ',', '.'); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
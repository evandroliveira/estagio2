<style type="text/css">
    th { text-align:left; }
</style>
<h1>Relatório de Compras</h1>

<fieldset>
    <?php
        if (isset($filters['provider_name']) && !empty($filters['provider_name'])) {
            echo "Filtrado pelo cliente: ".$filters['provider_name'];
        }
        if (!empty($filters['periodo1']) && !empty($filters['periodo2'])) {
            echo "No período: ".date('d/m/Y', strtotime($filters['periodo1']))." a ".date('d,m,Y', strtotime($filters['periodo2']))."<br>";
        }
        if ($filters['status'] != '') {
            echo "Filtrado com status: ".$statuses[$filters['status']];
        }

    ?>
</fieldset>

<table border="0" width="100%">
    <tr>
        <th>Nome do Fornecedor</th>
        <th>Data da compra</th>
        <th>Status</th>
        <th>Valor</th>
    </tr>
    <?php foreach($purchases_list as $purchase_item): ?>
        <tr>
            <td><?php echo $purchase_item['name']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($purchase_item['date_purchase'])); ?></td>
            <td><?php echo $statuses[$purchase_item['status']]; ?></td>
            <td>R$ <?php echo number_format($purchase_item['total_price'], 2, ',', '.'); ?></td>
        </tr>

    <?php endforeach; ?>
</table>


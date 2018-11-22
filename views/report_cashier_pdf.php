<style type="text/css">
    th { text-align:left; }
</style>
<h1>Relatório de Movimentação</h1>

<fieldset>
    <?php
    if(!empty($filters['period1']) && !empty($filters['period2'])) {
        echo "Filtrado no período: ".date('d/m/Y', strtotime($filters['period1']))." a ".date('d/m/Y', strtotime($filters['period2']))."<br/>";
    }
    ?>
</fieldset>
<br/>
<table border="0" width="100%">
    <tr>
        <th>Data</th>
        <th>Aberto</th>
        <th>fechado</th>
        <th>Movimento</th>
    </tr>
    <?php foreach($cashier_list as $cashier_item): ?>
        <tr>
            <td><?php echo date('d/m/Y', strtotime($cashier_item['date_cashier'])); ?></td>
            <td>R$ <?php echo number_format($cashier_item['opening_balance'], 2, ',', '.'); ?></td>
            <td>R$ <?php echo number_format($cashier_item['final_balance'], 2, ',', '.'); ?></td>
            <td>R$ <?php echo number_format($cashier_item['dif'], 2, ',', '.'); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
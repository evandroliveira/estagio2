<h1>Contas a Pagar</h1>



<table border="0" width="100%">
    <tr>
        <th>Nome do Fornecedor</th>
        <th>Data</th>
        <th>Status</th>
        <th>Valor</th>
        <th>Ações</th>
    </tr>
    <?php foreach($pay_list as $pay): ?>
        <tr>
            <td><?php echo $pay['name']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($pay['date_purchase'])); ?></td>
            <td><?php echo $statuses[$pay['status']]; ?></td>
            <td>R$ <?php echo number_format($pay['total_price'], 2, ',', '.'); ?></td>
            <td>
                <div class="button button_small"><a href="<?php echo BASE_URL; ?>/purchases/edit/<?php echo $pay['id']; ?>">Pagar</a></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
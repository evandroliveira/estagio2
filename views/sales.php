<h1>Vendas - Contas a Receber</h1>
<input type="text" id="busca" data-type="search_clients" />

<div class="button"><a href="<?php echo BASE_URL; ?>/sales/add">Adicionar Venda</a></div>

<table border="0" width="100%">
    <tr>
        <th>Nome do Cliente</th>
        <th>Data</th>
        <th>Status</th>
        <th>Valor</th>
        <th>Ações</th>
    </tr>
    <?php foreach($sales_list as $sales_item): ?>
        <tr>
            <td><?php echo $sales_item['name']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($sales_item['date_sale'])); ?></td>
            <td><?php echo $statuses[$sales_item['status']]; ?></td>
            <td>R$ <?php echo number_format($sales_item['total_price'], 2, ',', '.'); ?></td>
            <td>
                <div class="button button_small"><a href="<?php echo BASE_URL; ?>/sales/edit/<?php echo $sales_item['id']; ?>">Visualizar</a></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
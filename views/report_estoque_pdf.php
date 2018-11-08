<style type="text/css">
    th { text-align:left; }
</style>
<h1>Relatório de Estoque</h1>
<br/>
<table border="0" width="100%">
    <tr>
        <th>Nome</th>
        <th>Preço de Compra</th>
        <th>Preço de Venda</th>
        <th>Quantidade</th>
        <th>Lucro</th>
    </tr>
    <?php foreach($estoque_list as $product): ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td>R$ <?php echo number_format($product['price'], 2, ',', '.'); ?></td>
            <td>R$ <?php echo number_format($product['price_sale'], 2, ',', '.'); ?></td>
            <td><?php echo $product['quant']; ?></td>
            <td><?php echo number_format($product['dif'], 2, ",", "."); ?></td>

        </tr>
    <?php endforeach; ?>
</table>
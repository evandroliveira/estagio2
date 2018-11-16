<style type="text/css">
    th { text-align:left; }
</style>
<h1>Relatório de Produtos mais vendidos</h1>
<br/>
<table border="0" width="100%">
    <tr>
        <th>Nome</th>
        <th>Quantidade</th>
    </tr>
    <?php foreach($vendidos_list as $product): ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['qtde']; ?></td>

        </tr>
    <?php endforeach; ?>
</table>
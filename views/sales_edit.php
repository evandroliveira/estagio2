<h1>Compras - Editar</h1>
<strong>Nome do Cliente: </strong>
<?php echo $cliente; ?><br/><br/>

<strong>Data da Venda: </strong>
<?php echo $data_venda; ?><br/><br/>

<strong>Total da Venda: </strong>
R$ <?php echo number_format($total, 2); ?><br/><br/>

<strong>Status da Venda: </strong>
<?php echo ($status) ? 'Pago' : 'Não pago'; ?>
<br/><br/>
<hr/>

<table border="0" width="100%">
    <tr>
        <th>N.</th>
        <th>Valor</th>
        <th>Data de Vencimento</th>
        <th>Data de Pagamento</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($parcelas as $parcela): ?>
        <tr>
            <td><?php echo $parcela['n']; ?></td>
            <td><?php echo $parcela['valor']; ?></td>
            <td><?php echo $parcela['vencimento']; ?></td>
            <td><?php echo $parcela['pagamento']; ?></td>
            <td><?php echo ($parcela['status']) ? 'Pago' : 'Não pago'; ?></td>
            <td>
                <div class="button button_small">
                    <?php if(!$parcela['status']){ ?>
                        <a href="<?php echo BASE_URL; ?>/purchases/payParcela/<?php echo $parcela['id']; ?>">Pagar</a>
                    <?php }else{ ?>
                        Já pago
                    <?php } ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
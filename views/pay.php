<h1>Contas a Pagar</h1>



<table border="0" width="100%">
    <tr>
        <th>Nome do Fornecedor</th>
        <th>Data de vencimento</th>
        <th>Nº da parcela</th>
        <th>Valor</th>
        <th>Ações</th>
    </tr>
    <?php foreach($pay_list as $pay): ?>
        <tr>
            <td><?php echo $pay['name']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($pay['vencimento_movimento'])); ?></td>
            <td><?php echo $pay['n_parcel']; ?> </td>
            <td>R$ <?php echo number_format($pay['valor_movimento'], 2, ',', '.'); ?></td>
            <td>
                <div class="button button_small"><a href="<?php echo BASE_URL; ?>/purchases/edit/<?php echo $pay['id_parcela']; ?>">Pagar</a></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
<?php for($q=1;$q<=$p_count;$q++): ?>
    <div class="pag_item <?php echo ($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/pay?p=<?php echo $q; ?>"> <?php echo $q; ?></a></div>
<?php endfor; ?>
    <div style="clear: both"></div>
</div>

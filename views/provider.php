<?php
if (isset($return) && !empty($return)) { ?>
    <div style="width: 40%; border-radius: 5px; padding: 15px;color: white; background:<?php echo ($return['tipo'] == 'erro') ? '#B22222' : '#228B22'; ?>">
        <?php echo $return['msg']; ?>
    </div>
<?php } ?>

<h1>Fornecedores</h1>
<?php if($edit_permission): ?>
    <div class="button"><a href="<?php echo BASE_URL; ?>/provider/add">Adicionar Fornecedor</a></div>
<?php  endif; ?>
<input type="text" id="busca" data-type="search_provider" />

<table border="0" width="100%">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Cidade</th>
        <th>Ações</th>
    </tr>
    <?php foreach($provider_list as $p): ?>
        <tr>
            <td><?php echo $p['name']; ?></td>
            <td width="110"><?php echo $p['phone']; ?></td>
            <td width="250"><?php echo $p['address_city']; ?></td>
            <td width="160" style="text-align:center">
                <?php if($edit_permission): ?>
                    <div class="button button_small"><a href="<?php echo BASE_URL; ?>/provider/edit/<?php echo $p['id']; ?>">Editar</a></div>
                    <div class="button button_small"><a href="<?php echo BASE_URL; ?>/provider/delete/<?php echo $p['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div>
                <?php else: ?>
                    <div class="button button_small"><a href="<?php echo BASE_URL; ?>/provider/view/<?php echo $p['id']; ?>">Visualizar</a></div>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
    <?php for($q=1;$q<=$p_count;$q++): ?>
        <div class="pag_item <?php echo ($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/provider?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>
    <?php endfor; ?>
    <div style="clear:both"></div>
</div>














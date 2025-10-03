<!-- puxando o cabeçalho da pasta partials header.php que é o nome do view que vou usar -->
<?php $render('header'); ?>


<div class="p-3 mb-2 bg-primary text-white">
    <h1>Usuários Cadastrados</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php foreach($data as $usuario): ?>
        <tr>
            <td>
                <?=$usuario['id'];?>
            </td>
            <td>
                <?=$usuario['nome'];?>
            </td>
            <td>
                <?=$usuario['email'];?>
            </td>
            <td>
                <a href="/edit/<?=$usuario['id'];?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="/delete/<?=$usuario['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
            </td>
        </tr>
            <?php endforeach; ?>
    </table>
    
</div>





<?php $render('footer'); ?>
<style type="text/css">
    th { text-align:left; }
</style>
<h1>Relatório de Clientes</h1>
<br/>
<table border="0" width="100%">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Cidade</th>
    </tr>
    <?php foreach($clients_list as $client): ?>
        <tr>
            <td><?php echo $client['name']; ?></td>
            <td><?php echo $client['phone']; ?></td>
            <td width="200"><?php echo $client['address_city']; ?></td>

        </tr>
    <?php endforeach; ?>
</table>
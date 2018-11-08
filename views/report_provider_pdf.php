<style type="text/css">
    th {text-align: left; }

</style>
<h1>Relatório de Fornecedores</h1>

<table border="0" width="100%">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Cidade</th>
    </tr>

    <?php foreach ($provider_list as $provider): ?>
        <tr>
            <td><?php echo $provider['name']; ?></td>
            <td><?php echo $provider['phone']; ?></td>
            <td><?php echo $provider['address_city']; ?></td>
        </tr>
    <?php endforeach;?>
</table>
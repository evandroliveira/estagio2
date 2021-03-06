<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="../assets/js/jquery-1.7.1.min.js"></script>
</head>
<h1>Clientes - Adicionar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
    <div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST" name="form1"   onsubmit="return validar()">

    <label for="name">Nome <span style="color: red;"> @</span></label><br/>
    <input type="text" name="name" required /><br/><br/>

    <label for="email">E-mail<span style="color: red;"> #</span></label><br/>
    <input type="email" name="email"  /><br/><br/>

    <label for="phone">Telefone<span style="color: red;"> #</span></label><br/>
    <input type="text" name="phone" onblur="ValidaTelefone(form1.phone)" /><br/><br/>

    <label for="cpf">CPF<span style="color: red;"> #</span></label><br/>
    <input type="text" id="cpf" name="cpf" onBlur="ValidarCPF(cpf);"/><br/><br/>

    <label for="stars">Estrelas</label><br/>
    <select name="stars" id="stars">
        <option value="1"> 1 Estrela</option>
        <option value="2"> 2 Estrela</option>
        <option value="3" selected="selected"> 3 Estrela</option>
        <option value="4"> 4 Estrela</option>
        <option value="5"> 5 Estrela</option>
    </select><br/><br/>

    <label for="internal_obs">Observações Internas</label><br/>
    <textarea name="internal_obs" id="internal_obs"></textarea><br><br>

    <label for="address_zipcode">CEP</label><br/>
    <input type="text" name="address_zipcode" /><br/><br/>

    <label for="address">Endereço<span style="color: red;"> *</span></label><br/>
    <input type="text" name="address"/><br/><br/>

    <label for="address_number">Número</label><br/>
    <input type="text" name="address_number"/><br/><br/>

    <label for="address2">Complemento</label><br/>
    <input type="text" name="address2"/><br/><br/>

    <label for="address_neighb">Bairro<span style="color: red;"> *</span></label><br/>
    <input type="text" name="address_neighb"/><br/><br/>

    <label for="address_city">cidade<span style="color: red;"> *</span></label><br/>
    <input type="text" name="address_city"/><br/><br/>

    <label for="address_state">Estado<span style="color: red;"> *</span></label><br/>
    <input type="text" name="address_state"/><br/><br/>

    <label for="address_country">Pais<span style="color: red;"> *</span></label><br/>
    <input type="text" name="address_country"/><br/><br/>

    <input type="submit" value="Adicionar" />

</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php BASE_URL; ?>../assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php BASE_URL; ?>../assets/js/mascaraValidacao.js"></script>
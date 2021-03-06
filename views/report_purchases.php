<h1>Relatório de Compras</h1>

<form method="GET" onsubmit="return openPopup(this)">
    <div class="report-grid-4">
        Nome do Fornecedor
        <input type="text" name="provider_name"/>
    </div>
    <div class="report-grid-4">
        Período:<br>
        <input type="date" name="periodo1"><br>
        até:<br>
        <input type="date" name="periodo2">
    </div>
    <div class="report-grid-4">
        Status da compra:<br>
        <select name="status">
            <option value="">Todos os status</option>
            <?php foreach ($statuses as $statusKey => $statusValue): ?>
                <option value="<?php echo $statusKey; ?>"><?php echo $statusValue; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="report-grid-4">
        Ordenação:<br>
        <select name="order">
            <option value="date_desc">Mais Recente</option>
            <option value="date_asc">Mais Antigo</option>
            <option value="status">Status da venda</option>
        </select>
    </div>

    <div style="clear:both"></div>
    <input type="submit" value="Gerar Relatório">

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_purchases.js"></script>
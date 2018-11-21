<h1>Relatório de movimentações</h1>
<form method="GET" onsubmit="return openPopup(this)">

    <div class="report-grid-4">
        Período:<br/>

        <input type="date" name="period1" /><br/>
        até<br/>
        <input type="date" name="period2" />
    </div>


    <div style="clear:both"></div>

    <div style="text-align:center; position: absolute; margin-left: 70px;">
        <input type="submit" value="Gerar Relatório" s/>
    </div>
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_cashier.js"></script>
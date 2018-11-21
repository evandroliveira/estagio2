<h4 style="font-size: 18px; margin-top: 0">Caixa</h4>
<div class="grid-caixa">
           <a href="<?php echo BASE_URL; ?>/cashier_open" class="button">Abrir</a>

            <a href="<?php echo BASE_URL; ?>/cashier_open/close/<?php echo $movimento ?>" class="button" style="background: #AA0000;">Fechar</a>

</div>

<div class="db-row row1">
    <div class="grid-1">
        <div class="db-grid-area">
            <div class="db-grid-area-count">R$ <?php echo number_format($movimento, 2); ?></div>
            <div class="db-grid-area-legend">Movimento</div>
        </div>
    </div>
    <div class="grid-1">
        <div class="db-grid-area">
            <div class="db-grid-area-count" style="color: red;">R$ <?php echo number_format($saida, 2); ?></div>
            <div class="db-grid-area-legend">Saída</div>
        </div>
    </div>
    <div class="grid-1">
        <div class="db-grid-area">
            <div class="db-grid-area-count" style="color: blue;">R$ <?php echo number_format($entrada, 2); ?></div>
            <div class="db-grid-area-legend">Entrada </div>
        </div>
    </div>
</div>

<div class="db-row row2">
    <div class="grid-2">
        <div class="db-info">
            <div class="db-info-title">Entrada e saida dos últimos 7 dias</div>
            <div class="db-info-body" style="height: 300px">
                <canvas id="rel1"></canvas>
            </div>
        </div>
    </div>

</div>


</div>
<script type="text/javascript">
    var days_list = <?php echo json_encode($days_list); ?>;
    var input_list = <?php echo json_encode(array_values($input_list)); ?>;
</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/cashier.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_cashier.js"></script>





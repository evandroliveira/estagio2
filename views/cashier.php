<h4 style="font-size: 18px; margin-top: 0">Caixa</h4>
<div class="grid-caixa">
    <form>
        <input type="text" value="<?=date('d/m/Y')?>">
        <label>Saldo Inicial:</label>
        <input type="text" name="opening_balance" id="n1" >

        <label>Saldo Final:</label>
        <input type="text" name="final_balance" id="n2" onblur="caixa();" >

        <label>Diferença</label>
        <input type="text" name="difference" id="result"  >

        <input type="submit" value="Abrir" >
    </form>
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
            <div class="db-info-title">Entrada e saida do dia</div>
            <div class="db-info-body" style="height: 300px">
                <canvas id="rel1"></canvas>
            </div>
        </div>
    </div>
    <div class="grid-1">
        <div class="db-info">
            <div class="db-info-title">Movimentação</div>
            <div class="db-info-body">
                <canvas id="rel2" height="300"></canvas>
            </div>
        </div>
    </div>
</div>


</div>
<script type="text/javascript">
    var dia_lista = <?php echo json_encode($dia_lista) ?>;
</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/cashier.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_cashier.js"></script>





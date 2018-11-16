<h1>Caixa</h1>

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
<!--
<div class="db-row">
    <div class="grid-2">
        <div class="db-info">
            <div class="db-info-title">Movimento do dia</div>
            <div class="formulario">
                <form method="POST">
                    <label>Data:</label>
                    <input type="date" name="date_cashier">

                    <label>Status:</label>
                    <select name="status" style="width: 200px;">
                        <option></option>
                        <option value="0">Fechado</option>
                        <option value="1">Aberto</option>
                    </select><br><br>

                    <label>Saldo Inicial:</label>
                    <input type="text" name="opening_balance" id="n1" style="color: #006600" >

                    <label>Saldo Final:</label>
                    <input type="text" name="final_balance" id="n2" onblur="caixa();" style="color: #006600"><br><br>

                    <label>Diferença</label>
                    <input type="text" name="difference" id="result"  style="color: #006600"><br><br>



                </form>
            </div><!--db-info-body -->
<!--  </div><!--db-info -->
    </div><!--grid-2 -->
    <div class="grid-1">
        <div class="db-info">
            <div class="db-info-title">Saldo Inicial</div>
            <div class="db-info-body">
                <form method="GET">
                    <input type="text" name="opening_balance">
                </form>

            </div>
        </div>
    </div>-->


</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>../assets/js/cashier.js"></script>





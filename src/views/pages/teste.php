<?php
// /c:/xampp/htdocs/backend/src/views/pages/teste.php
// Página simples para sortear quem joga com quem entre 3 times.

function getPostTeam($key, $default) {
    return trim($_POST[$key] ?? $default) ?: $default;
}

$team1 = getPostTeam('team1', 'Time 1');
$team2 = getPostTeam('team2', 'Time 2');
$team3 = getPostTeam('team3', 'Time 3');

$results = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sortear'])) {
    $teams = [$team1, $team2, $team3];
    shuffle($teams); // embaralha
    // Definimos uma partida entre os dois primeiros e o terceiro fica de folga
    $match = [$teams[0], $teams[1]];
    $bye = $teams[2];
    $results = [
        'partida' => $match,
        'folga' => $bye
    ];
}
?><!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Sortear adversários - 3 times</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif; max-width:700px; margin:30px auto; padding:10px;}
        label {display:block; margin-top:10px;}
        input[type="text"] {width:100%; padding:8px; box-sizing:border-box;}
        button {margin-top:12px; padding:10px 14px;}
        .result {margin-top:20px; padding:12px; border:1px solid #ddd; background:#f9f9f9;}
    </style>
</head>
<body>
    <h2>Sortear adversários (3 times)</h2>
    <form method="post" action="">
        <label for="team1">Time 1</label>
        <input id="team1" name="team1" type="text" value="<?php echo htmlspecialchars($team1, ENT_QUOTES); ?>">

        <label for="team2">Time 2</label>
        <input id="team2" name="team2" type="text" value="<?php echo htmlspecialchars($team2, ENT_QUOTES); ?>">

        <label for="team3">Time 3</label>
        <input id="team3" name="team3" type="text" value="<?php echo htmlspecialchars($team3, ENT_QUOTES); ?>">

        <button type="submit" name="sortear">Sortear</button>
    </form>

    <?php if ($results): ?>
        <div class="result">
            <h3>Resultado do sorteio</h3>
            <p><strong>Partida:</strong> <?php echo htmlspecialchars($results['partida'][0], ENT_QUOTES); ?> x <?php echo htmlspecialchars($results['partida'][1], ENT_QUOTES); ?></p>
            <p><strong>Folga:</strong> <?php echo htmlspecialchars($results['folga'], ENT_QUOTES); ?></p>

            <form method="post" action="" style="margin-top:10px;">
                <!-- Mantém os nomes para novo sorteio -->
                <input type="hidden" name="team1" value="<?php echo htmlspecialchars($team1, ENT_QUOTES); ?>">
                <input type="hidden" name="team2" value="<?php echo htmlspecialchars($team2, ENT_QUOTES); ?>">
                <input type="hidden" name="team3" value="<?php echo htmlspecialchars($team3, ENT_QUOTES); ?>">
                <button type="submit" name="sortear">Sortear novamente</button>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
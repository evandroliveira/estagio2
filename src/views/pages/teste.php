<?php
// URL da API para obter a cotação do dólar
$apiUrl = "https://api.exchangerate-api.com/v4/latest/USD";

// Fazendo a requisição para a API
$response = file_get_contents($apiUrl);

// Verificando se a resposta foi obtida com sucesso
if ($response !== false) {
    // Decodificando o JSON retornado pela API
    $data = json_decode($response, true);

    // Verificando se a cotação do BRL (Real Brasileiro) está disponível
    if (isset($data['rates']['BRL'])) {
        $dollarToBrl = $data['rates']['BRL'];
        echo "A cotação atual do dólar para o real é: R$ " . number_format($dollarToBrl, 2, ',', '.');
    } else {
        echo "Não foi possível obter a cotação do dólar para o real.";
    }
} else {
    echo "Erro ao acessar a API de cotação.";
}
?>
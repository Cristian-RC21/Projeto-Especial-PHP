<?php
session_start();

// Verifica se o cliente está logado
if (!isset($_SESSION['clienteNome'])) {
    header("Location: index.php");
    exit();
}

// Armazenamento dos monitoramentos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $peso = $_POST['peso'];
    $observacoes = $_POST['observacoes'];
    $nomeCliente = $_SESSION['clienteNome'];

    $monitoramento = [
        'nome' => $nomeCliente,
        'peso' => $peso,
        'observacoes' => $observacoes
    ];

    // Adiciona o monitoramento à sessão
    $_SESSION['monitoramentos'][] = $monitoramento;

    // Exibe a página de dados computados
    header("Location: dados_computados.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Automonitoramento</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="monitoramento-container">
        <h2>Ficha de Automonitoramento</h2>
        <form method="POST" action="">
            <div class="input-group">
                <label for="peso">Peso (kg)</label>
                <input type="number" id="peso" name="peso" required>
            </div>
            <div class="input-group">
                <label for="observacoes">Observações</label>
                <textarea id="observacoes" name="observacoes" required></textarea>
            </div>
            <button type="submit" class="btn">Salvar</button>
        </form>
    </div>
</body>
</html>

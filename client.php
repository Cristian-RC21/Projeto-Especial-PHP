<?php
session_start();

// Verifica se o cliente está logado
if (!isset($_SESSION['clienteNome'])) {
    header("Location: index.php");
    exit();
}

// Armazenamento dos agendamentos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $nomeCliente = $_SESSION['clienteNome'];

    $agendamento = [
        'nome' => $nomeCliente,
        'data' => $data,
        'hora' => $hora
    ];

    // Adiciona o agendamento à sessão
    $_SESSION['agendamentos'][] = $agendamento;

    // Redireciona para a página de monitoramento
    header("Location: monitoramento.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Consulta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="agendar-container">
        <h2>Agendar Consulta</h2>
        <form method="POST" action="">
            <div class="input-group">
                <label for="data">Data</label>
                <input type="date" id="data" name="data" required>
            </div>
            <div class="input-group">
                <label for="hora">Hora</label>
                <input type="time" id="hora" name="hora" required>
            </div>
            <button type="submit" class="btn">Agendar</button>
        </form>
    </div>
</body>
</html>

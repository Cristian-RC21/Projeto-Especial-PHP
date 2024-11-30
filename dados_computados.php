<?php
session_start();

// Verifica se o cliente está autenticado
if (!isset($_SESSION['clienteNome'])) {
    // Redireciona para a página de login se o cliente não estiver autenticado
    header("Location: login.php");
    exit();
}

// Recupera os dados dos agendamentos e monitoramentos da sessão
$agendamentos = isset($_SESSION['agendamentos']) ? $_SESSION['agendamentos'] : [];
$monitoramentos = isset($_SESSION['monitoramentos']) ? $_SESSION['monitoramentos'] : [];
$nomeCliente = $_SESSION['clienteNome'];

// Filtra o último agendamento e monitoramento do cliente
$ultimoAgendamento = null;
foreach ($agendamentos as $agendamento) {
    if ($agendamento['nome'] === $nomeCliente) {
        $ultimoAgendamento = $agendamento;
    }
}

$ultimoMonitoramento = null;
foreach ($monitoramentos as $monitoramento) {
    if ($monitoramento['nome'] === $nomeCliente) {
        $ultimoMonitoramento = $monitoramento;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Computados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dados-computados-container">
        <h2>Dados Computados</h2>
        
        <!-- Exibe o último agendamento -->
        <div id="agendamentos">
            <h3>Último Agendamento</h3>
            <?php if ($ultimoAgendamento): ?>
                <p>Último Agendamento: <?php echo htmlspecialchars($ultimoAgendamento['data']); ?> às <?php echo htmlspecialchars($ultimoAgendamento['hora']); ?></p>
            <?php else: ?>
                <p>Nenhum agendamento encontrado.</p>
            <?php endif; ?>
        </div>

        <!-- Exibe o último monitoramento -->
        <div id="monitoramentos">
            <h3>Último Monitoramento</h3>
            <?php if ($ultimoMonitoramento): ?>
                <p>Último Monitoramento: Peso: <?php echo htmlspecialchars($ultimoMonitoramento['peso']); ?>kg - Observação: <?php echo htmlspecialchars($ultimoMonitoramento['observacoes']); ?></p>
            <?php else: ?>
                <p>Nenhum monitoramento encontrado.</p>
            <?php endif; ?>
        </div>

        <!-- Botão Voltar -->
        <button onclick="window.location.href='index.php'" class="btn-voltar">Voltar ao Início</button>
    </div>
</body>
</html>


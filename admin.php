<?php
session_start();

// Verifica se o usuário está logado como administrador
if (!isset($_SESSION['clienteNome']) || $_SESSION['clienteNome'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Função para limpar os dados armazenados
function apagarDados() {
    unset($_SESSION['agendamentos']);
    unset($_SESSION['monitoramentos']);
    echo "<script>alert('Todos os dados foram apagados.'); window.location.reload();</script>";
}

// Verifica se o botão de apagar dados foi pressionado
if (isset($_POST['apagar'])) {
    apagarDados();
}

// Exibe os dados de agendamentos e monitoramentos
$agendamentos = isset($_SESSION['agendamentos']) ? $_SESSION['agendamentos'] : [];
$monitoramentos = isset($_SESSION['monitoramentos']) ? $_SESSION['monitoramentos'] : [];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-dashboard">
        <h2>Painel do Administrador</h2>
        
        <div id="agendamentos">
            <h3>Agendamentos dos Clientes</h3>
            <?php
                // Exibe os agendamentos dos clientes
                foreach ($agendamentos as $agendamento) {
                    echo "<p>Agendamento: {$agendamento['data']} às {$agendamento['hora']}</p>";
                }
            ?>
        </div>

        <div id="monitoramentos">
            <h3>Monitoramentos dos Clientes</h3>
            <?php
                // Exibe os monitoramentos dos clientes
                foreach ($monitoramentos as $monitoramento) {
                    echo "<p>Monitoramento: Peso: {$monitoramento['peso']}kg - Observações: {$monitoramento['observacoes']}</p>";
                }
            ?>
        </div>

        <form method="POST">
            <button type="submit" name="apagar" class="btn-apagar">Apagar Todos os Dados</button>
        </form>
    </div>
</body>
</html>

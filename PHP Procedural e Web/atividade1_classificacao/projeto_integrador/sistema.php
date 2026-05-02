<?php
// 1. Início da Sessão
session_start();

// Configurações de "Banco de Dados" (Simulado)
$usuario_correto = "aluno";
$senha_correta = "php123";

// 2. Lógica de Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: sistema.php");
    exit();
}

// 3. Processamento de Login e Criação de Cookie
if (isset($_POST['login'])) {
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['senha'] ?? '';

    if ($user === $usuario_correto && $pass === $senha_correta) {
        $_SESSION['usuario_logado'] = $user;
        // Cria cookie de 7 dias para lembrar que o usuário já visitou o sistema
        setcookie("ultimo_acesso", date("d/m/Y H:i"), time() + (7 * 24 * 60 * 60));
        header("Location: sistema.php");
        exit();
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}

// 4. Lógica da Atividade 1 (Classificação Acadêmica) integrada
$resultado_cadastro = "";
if (isset($_POST['cadastrar_nota']) && isset($_SESSION['usuario_logado'])) {
    $nome_aluno = htmlspecialchars($_POST['nome_aluno']);
    $nota = floatval($_POST['nota']);
    
    function calcularSituacao($n) {
        if ($n >= 7) return "<span style='color:green'>Aprovado</span>";
        if ($n >= 5) return "<span style='color:orange'>Recuperação</span>";
        return "<span style='color:red'>Reprovado</span>";
    }
    
    $situacao = calcularSituacao($nota);
    $resultado_cadastro = "O aluno <strong>$nome_aluno</strong> obteve nota $nota e está: $situacao";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Desafio Integrador - PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        .container { max-width: 500px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .alerta { color: red; }
        .sucesso { background: #e7f3fe; padding: 10px; margin-top: 10px; border-radius: 4px; }
        header { margin-bottom: 20px; border-bottom: 2px solid #eee; }
    </style>
</head>
<body>

    <?php if (isset($_COOKIE['ultimo_acesso'])): ?>
        <p><small>Seu último acesso a este sistema foi em: <?php echo $_COOKIE['ultimo_acesso']; ?></small></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION['usuario_logado'])): ?>
        <div class="container">
            <h2>Login do Sistema</h2>
            <?php if (isset($erro)) echo "<p class='alerta'>$erro</p>"; ?>
            <form method="POST">
                <label>Usuário:</label><br>
                <input type="text" name="usuario" required><br><br>
                <label>Senha:</label><br>
                <input type="password" name="senha" required><br><br>
                <button type="submit" name="login">Entrar</button>
            </form>
        </div>

    <?php else: ?>
        <header>
            <h1>Bem-vindo, <?php echo $_SESSION['usuario_logado']; ?>!</h1>
            <a href="?logout=1">Sair do Sistema</a>
        </header>

        <div class="container">
            <h3>Cadastro de Notas (Atividade 1 & 2 Integradas)</h3>
            <form method="POST">
                <label>Nome do Aluno:</label><br>
                <input type="text" name="nome_aluno" required><br><br>
                <label>Nota Final:</label><br>
                <input type="number" step="0.1" name="nota" min="0" max="10" required><br><br>
                <button type="submit" name="cadastrar_nota">Registrar e Validar</button>
            </form>

            <?php if ($resultado_cadastro): ?>
                <div class="sucesso">
                    <?php echo $resultado_cadastro; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>
</html>
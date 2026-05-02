<?php
$nome_usuario = "João";
// 7 dias = 60s * 60m * 24h * 7d
setcookie("usuario_nome", $nome_usuario, time() + (86400 * 7), "/");

if (isset($_COOKIE['usuario_nome'])) {
    echo "Olá " . $_COOKIE['usuario_nome'] . ", bom te ver de novo!";
} else {
    echo "Bem-vindo, visitante!";
}
?>
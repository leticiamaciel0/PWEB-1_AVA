<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}
echo "Bem-vindo à área restrita!";
?>
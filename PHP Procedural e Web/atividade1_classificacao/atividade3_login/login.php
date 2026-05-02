<?php
session_start();
if ($_POST['usuario'] == 'admin' && $_POST['senha'] == '123') {
    $_SESSION['logado'] = true;
    header("Location: restrita.php");
}
?>
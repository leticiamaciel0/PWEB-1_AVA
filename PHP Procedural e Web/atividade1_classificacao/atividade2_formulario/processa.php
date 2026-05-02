<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    echo "<h3>Dados Recebidos:</h3>";
    echo "Nome: $nome <br> E-mail: $email";
}
?>
<?php
function verificarSituacao($nota) {
    if ($nota >= 7) return "Aprovado";
    if ($nota >= 5) return "Recuperação";
    return "Reprovado";
}

$notas = [8.5, 4.0, 6.2]; // Exemplo de repetição

foreach ($notas as $n) {
    echo "Nota: $n - Situação: " . verificarSituacao($n) . "<br>";
}
?>
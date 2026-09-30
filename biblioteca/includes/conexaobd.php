<?php
try {
    // Parâmetros: host, usuario, senha, nome_do_banco
    $conn = new mysqli('localhost', 'root', '', 'biblioteca');

    // Define o charset UTF-8 para evitar problemas de acentuação
    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    die("Erro ao conectar no banco de dados " . $e);
}
?>


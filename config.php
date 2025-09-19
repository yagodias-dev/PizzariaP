<?php
// Configurações do banco de dados para XAMPP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzaria_primicia";

// Criar conexão
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Função para sanitizar dados de entrada
function sanitizar($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Função para converter preço de string para float
function converterPreco($preco) {
    $preco = str_replace(',', '.', $preco);
    return floatval($preco);
}
?>
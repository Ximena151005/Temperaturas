<?php

// 1. Obtener datos del POST
$lug = $_POST["lug"];

// 2. Configuración de la conexión
$host = 'localhost';
$db   = 'temperaturas_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {

    // 3. Crear conexión
    $pdo = new PDO($dsn, $user, $pass, $options);

    // 4. Verificar si ya existe
    $sql = "SELECT idlugares FROM lugares WHERE nombrelugar = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lug]);

    while ($row = $stmt->fetch()) {
        echo "LUGAR YA EXISTE EN LA BD";
        exit;
    }

    // 5. Insertar
    $sqlInsert = "INSERT INTO lugares (nombrelugar) VALUES (?)";
    $stmt = $pdo->prepare($sqlInsert);
    $stmt->execute([$lug]);

    echo "DATOS INGRESADOS CORRECTAMENTE";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
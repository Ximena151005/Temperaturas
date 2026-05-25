<?php

// 🔹 Validar que lleguen datos
if (!isset($_POST["ubi"], $_POST["tem"], $_POST["cor"], $_POST["pas"])) {
    die("Faltan datos");
}

// 🔹 Recibir datos del ESP32
$ubi = $_POST["ubi"];
$tem = $_POST["tem"];
$cor = $_POST["cor"];
$pas = $_POST["pas"];

date_default_timezone_set('America/Mazatlan');

// 🔹 Conexión a la BD
$host = 'localhost';
$db   = 'temperaturas_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {

    $pdo = new PDO($dsn, $user, $pass, $options);

    // 🔹 1. Verificar que el lugar exista
    $stmt = $pdo->prepare("SELECT idlugares FROM lugares WHERE idlugares = ?");
    $stmt->execute([$ubi]);

    if (!$stmt->fetch()) {
        echo "ESE LUGAR NO EXISTE";
        exit;
    }

    // 🔹 2. Verificar usuario
    $stmt = $pdo->prepare("SELECT nombre FROM usuarios WHERE email = ? AND password = ?");
    $stmt->execute([$cor, $pas]);

    if ($stmt->fetch()) {

        // 🔹 3. Insertar temperatura
        $sql = "INSERT INTO temperatura (ubicacion, temperatura, fecha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $fecha = date("Y-m-d H:i:s");

        $stmt->execute([$ubi, $tem, $fecha]);

        echo "Registro insertado correctamente";

    } else {
        echo "ERROR DE CORREO O PASSWORD";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
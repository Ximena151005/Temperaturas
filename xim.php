<?php

$cor = $_POST["cor"];
$nom = $_POST["nom"];

// Configuración de la conexión
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

    // 1. Conexión
    $pdo = new PDO($dsn, $user, $pass, $options);

    date_default_timezone_set('America/Mazatlan');

    $email = $_POST['cor'];
    $nombre = $_POST['nom'];

    // 🔎 VERIFICACIÓN estilo profe (pero segura)
    $stmt = $pdo->prepare("SELECT nombre FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);

    // Si encuentra registros (como el while del profe)
    if ($row = $stmt->fetch()) {
        echo "correo ya existe " . $email;
        exit;
    }

    // 2. Generar contraseña
    $pas = bin2hex(random_bytes(16));

    // 3. Insertar usuario
    $sql = "INSERT INTO usuarios (email, password, nombre) 
            VALUES (?,?,?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $pas, $nombre]);

    echo "Registro insertado correctamente";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
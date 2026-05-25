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

    $pdo = new PDO($dsn, $user, $pass, $options);

    date_default_timezone_set('America/Mazatlan');

    $email = $_POST['cor'];
    $nombre = $_POST['nom'];

    // 🔎 Verificar si el correo ya existe
    $verificar = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $verificar->execute([$email]);

    if ($verificar->rowCount() > 0) {

        echo "⚠️ Este correo ya está registrado. Usa otro correo.";

    } else {

        // Generar contraseña aleatoria
        $pas = bin2hex(random_bytes(16));

        // Insertar usuario
        $sql = "INSERT INTO usuarios (email, password, nombre) 
                VALUES (?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $pas, $nombre]);

        echo "✅ Registro insertado correctamente";

    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
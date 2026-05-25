<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md">

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
];

try {

    $pdo = new PDO($dsn, $user, $pass, $options);

    // ❌ ERROR: correo ya existe
    $stmt = $pdo->prepare("SELECT nombre FROM usuarios WHERE email=?");
    $stmt->execute([$cor]);

    if ($row = $stmt->fetch()) {
        echo '
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-xl shadow-md">
            <h2 class="font-bold text-lg mb-2">Error</h2>
            <p>El correo ya existe: <strong>'.$row["nombre"].'</strong></p>
        </div>';
        exit;
    }

    // INSERTAR
    $sql = "INSERT INTO usuarios(email, password, nombre) VALUES (?,?,?)";
    $stmt = $pdo->prepare($sql);

    $pas = bin2hex(random_bytes(16));
    $stmt->execute([$cor, $pas, $nom]);

   
    echo '
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl shadow-md">
        <h2 class="font-bold text-lg mb-2">Registro exitoso</h2>
        <p><strong>Correo:</strong> '.$cor.'</p>
        <p><strong>Password generado:</strong> '.$pas.'</p>
    </div>';

} catch (\PDOException $e) {
    echo '
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-6 py-4 rounded-xl shadow-md">
        <h2 class="font-bold text-lg mb-2">Error del sistema</h2>
        <p>'.$e->getMessage().'</p>
    </div>';
}
?>

</div>

</body>
</html>
























<!-- 

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
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {

    // 2. Crear conexión PDO
    $pdo = new PDO($dsn, $user, $pass, $options);

    $stmt = $pdo->query("SELECT nombre FROM usuarios WHERE email=?");
    $stmt->execute([$cor]);

    while ($row = $stmt->fetch()) {
        echo "correo ya existe ".$row["nombre"];
        exit;
    }

    // 3. Preparar la consulta
    $sql = "INSERT INTO usuarios(email, password, nombre) VALUES (?,?,?)";
    $stmt = $pdo->prepare($sql);

    $pas = bin2hex(random_bytes(16));

    // 4. Ejecutar con los datos
    $stmt->execute([$cor, $pas, $nom]);

   
    $stmt = $pdo->query("SELECT email, password FROM usuarios WHERE email='$cor'");

    while ($row = $stmt->fetch()) {
        echo "correo registrado: " . $row["email"];
        echo "<br>";
        echo "correo registrado, tu password es: " . $row["password"];
        exit;
    }

    echo "Datos insertados correctamente <BR>";

} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?> -->
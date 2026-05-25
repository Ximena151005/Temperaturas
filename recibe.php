<?php

// 1. Obtener datos del POST
$ubi = $_POST["ubi"];
$tem = $_POST["tem"];
$cor = $_POST["cor"];
$pas = $_POST["pas"];

date_default_timezone_set('America/Mazatlan');

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
    $si=0;
    $sql = "SELECT idlugares FROM lugares WHERE idlugares = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ubi]);
    while ($row = $stmt->fetch())
    {
        $si=1;
    }

    if($si==0)
        {
            echo "ESE LUGAR NO EXISTE EN LA BD";
            exit;
        }




    $sql = "SELECT nombre FROM usuarios WHERE email = ? AND password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cor, $pas]);

    $usuario = $stmt->fetch();

    if ($usuario) {

        // 5. Datos a insertar
        $ubicacion = $ubi;
        $temperatura = $tem;
        $fecha = date("Y-m-d H:i:s");

        // 6. Insertar temperatura
        $sqlInsert = "INSERT INTO temperatura (ubicacion, temperatura, fecha) 
                      VALUES (:ubicacion, :temperatura, :fecha)";

        $stmtInsert = $pdo->prepare($sqlInsert);

        $stmtInsert->execute([
            ':ubicacion' => $ubicacion,
            ':temperatura' => $temperatura,
            ':fecha' => $fecha
        ]);

        echo " Registro insertado correctamente";

    } else {
        echo " ERROR DE CORREO O PASSWORD";
    }

} catch (PDOException $e) {
    echo " Error: " . $e->getMessage();
}
?>
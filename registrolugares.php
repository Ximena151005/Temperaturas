
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Lugar</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.2);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            text-align: left;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            outline: none;
            transition: 0.3s;
        }

        input[type="text"]:focus {
            border-color: #4facfe;
            box-shadow: 0 0 5px rgba(79,172,254,0.5);
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #4facfe;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #00c6ff;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Registrar Lugar</h2>

        <form method="POST" action="guardalugares.php">
            <label>NOMBRE LUGAR:</label>
            <input type="text" name="lug" placeholder="Escribe el lugar">

            <input type="submit" value="Enviar">
        </form>
    </div>

</body>
</html>






<!-- <form method="POST" action="guardalugares.php">
    <label>NOMBRE LUGAR:</label>
    <input type="text" name="lug"><br>

    <input type="submit" value="Enviar">
</form>  -->
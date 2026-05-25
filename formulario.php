<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <form method="POST" action="nuevo.php" 
          class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">

        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">
            Registro
        </h2>

        <!-- Correo -->
        <label class="block mb-2 text-gray-600 font-semibold">
            CORREO:
        </label>
        <input type="email" name="cor" 
               class="w-full mb-4 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

        <!-- Nombre -->
        <label class="block mb-2 text-gray-600 font-semibold">
            NOMBRE:
        </label>
        <input type="text" name="nom" 
               class="w-full mb-6 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

        <!-- Botón -->
        <input type="submit" value="Enviar"
               class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300 cursor-pointer">

    </form>

</body>
</html>





<!-- <form method="POST" action="nuevo.php">
    <label>CORREO:</label>
    <input type="email" name="cor"><br>

    <label>NOMBRE:</label>
    <input type="text" name="nom"><br>

    <input type="submit" value="Enviar">
</form> -->
 



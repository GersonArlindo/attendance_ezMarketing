<?php
    // Importar la extensión PDO
    // require_once 'pdo.php';

    // // Variables de configuración de conexión
    // $username = "arlindo";
    // $database = "attendance_db.db";
    // $dsn = "sqlite:https://dbhub.io/file/$username/$database";

    // // Crear una nueva instancia de PDO
    // try {
    //     $pdo = new PDO($dsn);
    // } catch (PDOException $e) {
    //     echo "Error al conectarse a la base de datos: " . $e->getMessage();
    //     exit();
    // }

    // // Ejecutar consultas en la base de datos
    // $query = "SELECT * FROM tabla";
    // $result = $pdo->query($query);
    // while ($row = $result->fetch()) {
    //     echo $row['columna'] . "<br>";
    // }

    // // Cerrar conexión a la base de datos
    // $pdo = null;

    // Importar la extensión PDO

    // Importar la extensión PDO
    //require_once 'pdo.php';

    // Variables de configuración de conexión
    $username = "arlindo";
    $database = "attendance_db.db";
    $dsn = "sqlite:http://dbhub.io/$username/$database";

    // Crear una nueva instancia de PDO
    try {
        $pdo = new PDO($dsn);
    } catch (PDOException $e) {
        echo "Error al conectarse a la base de datos: " . $e->getMessage();
        exit();
    }

    // Verificar conexión
    if ($pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) === 'SQLite Database opened successfully') {
        echo "Conexión a la base de datos realizada con éxito.";
    } else {
        echo "Error al conectarse a la base de datos.";
    }

    // Cerrar conexión a la base de datos
    $pdo = null;
?>


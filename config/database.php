<?php
//Configuración de base de datos Azure SQL

// Configuración de Azure SQL Database
define('DB_SERVER', '1536271azure.database.windows.net');
define('DB_USERNAME', 'tiendacomputadora');
define('DB_PASSWORD', 'OmegaZero3juan*');
define('DB_NAME', 'tiendacomputadora');

// Crear conexión PDO con SQL Server
try {
    $pdo = new PDO(
        "sqlsrv:server=" . DB_SERVER . ",1433;Database=" . DB_NAME . ";LoginTimeout=30;TrustServerCertificate=1;Encrypt=1",
        DB_USERNAME,
        DB_PASSWORD,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );
    
    if (DEBUG_MODE) {
        echo "<!-- Conexión a base de datos exitosa -->";
    }
    
} catch (PDOException $e) {
    if (DEBUG_MODE) {
        die("Error de conexión: " . $e->getMessage());
    } else {
        error_log("Error de conexión BD: " . $e->getMessage());
        die("Error al conectar con la base de datos. Por favor, intente más tarde.");
    }
}
?>
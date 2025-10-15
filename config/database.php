<?php
// config/database.php - Configuración de base de datos Azure SQL


if ($isAzure) {
    // En Azure: usar variables de entorno
    define('DB_SERVER', getenv('DB_SERVER'));
    define('DB_USERNAME', getenv('DB_USERNAME'));
    define('DB_PASSWORD', getenv('DB_PASSWORD'));
    define('DB_NAME', getenv('DB_NAME'));
} else {
    // En local: usar valores hardcoded
    define('DB_SERVER', '1536271azure.database.windows.net');
    define('DB_USERNAME', 'tiendacomputadora');
    define('DB_PASSWORD', 'OmegaZero3juan*');
    define('DB_NAME', 'tiendacomputadora');
}

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
    
    
} catch (PDOException $e) {
    error_log("Error de conexión BD: " . $e->getMessage());
    
    if (defined('DEBUG_MODE') && DEBUG_MODE) {
        die("Error de conexión: " . $e->getMessage());
    } else {
        die("Error al conectar con la base de datos.");
    }
}
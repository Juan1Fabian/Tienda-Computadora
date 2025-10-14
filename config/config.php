<?php
// Configuración general de la aplicación

// URL base de la aplicación
$base_url = '/S+/';

// Configuración de la aplicación
define('APP_NAME', 'CRUD Computadoras');
define('APP_VERSION', '1.0.0');

// Zona horaria
date_default_timezone_set('America/Mexico_City');

// Configuración de errores (cambiar a false en producción)
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Incluir configuración de base de datos
require_once __DIR__ . '/database.php';
?>

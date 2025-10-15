<?php
// Configuración general de la aplicación

// Detectar si estamos en Azure
$isAzure = getenv('WEBSITE_SITE_NAME') !== false;

// URL base de la aplicación
if ($isAzure) {
    $base_url = '/'; // En Azure la app está en la raíz
} else {
    $base_url = '/Tienda-Computadora/'; // En local
}

// Configuración de la aplicación
define('APP_NAME', 'CRUD Computadoras');
define('APP_VERSION', '1.0.0');

// Zona horaria
date_default_timezone_set('America/Lima');

// En Azure, mejor dejarlo en false para producción
define('DEBUG_MODE', $isAzure ? false : true);

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
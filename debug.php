<?php
echo "<h2>Verificación Azure</h2>";
echo "En Azure: " . (getenv('WEBSITE_SITE_NAME') ? 'SÍ' : 'NO') . "<br><br>";

echo "<h3>Variables configuradas:</h3>";
echo "DB_SERVER: " . (getenv('DB_SERVER') ?: 'NO CONFIGURADO') . "<br>";
echo "DB_USERNAME: " . (getenv('DB_USERNAME') ?: 'NO CONFIGURADO') . "<br>";
echo "DB_NAME: " . (getenv('DB_NAME') ?: 'NO CONFIGURADO') . "<br>";
echo "DB_PASSWORD: " . (getenv('DB_PASSWORD') ? 'CONFIGURADO ✅' : 'NO CONFIGURADO ❌') . "<br><br>";

echo "<h3>Extensiones PHP:</h3>";
echo "pdo_sqlsrv: " . (extension_loaded('pdo_sqlsrv') ? '✅' : '❌') . "<br>";
echo "sqlsrv: " . (extension_loaded('sqlsrv') ? '✅' : '❌') . "<br><br>";

echo "<h3>Archivos:</h3>";
echo "config.php existe: " . (file_exists('config/config.php') ? '✅' : '❌') . "<br>";
echo "database.php existe: " . (file_exists('config/database.php') ? '✅' : '❌') . "<br><br>";

try {
    require_once 'config/config.php';
    echo "<h3>✅ Conexión a BD exitosa!</h3>";
} catch (Exception $e) {
    echo "<h3>❌ Error: " . $e->getMessage() . "</h3>";
}
?>
# 💻 CRUD Tienda de Computadoras

Sistema de gestión de inventario de computadoras con PHP y Azure SQL Database.

## 📋 Descripción

Aplicación web CRUD para administrar un catálogo de computadoras con especificaciones técnicas, precios y control de stock.

## ✨ Funcionalidades

- ➕ Crear nuevas computadoras
- 📋 Listar todas las computadoras
- 🔍 Ver detalles completos
- ✏️ Editar información
- 🗑️ Eliminar registros

## 🛠️ Tecnologías

- PHP 8.2.12
- Azure SQL Database
- Bootstrap 5
- PDO con drivers SQLSRV

## 📦 Requisitos

1. XAMPP con PHP 8.2+
2. Microsoft ODBC Driver 18 for SQL Server
3. Drivers PHP para SQL Server (5.12.0)
4. Visual C++ Redistributable

## 🚀 Instalación Rápida

### 1. Instalar Drivers

**Drivers PHP:**
- Descarga: https://github.com/microsoft/msphpsql/releases
- Copia `php_sqlsrv_82_ts.dll` y `php_pdo_sqlsrv_82_ts.dll` a `C:\xampp\php\ext\`

**Agregar a `php.ini`:**
```ini
extension=php_sqlsrv_82_ts.dll
extension=php_pdo_sqlsrv_82_ts.dll
```

**ODBC Driver:**
- Descarga e instala: https://go.microsoft.com/fwlink/?linkid=2249004

### 2. Configurar Base de Datos

✅ **El proyecto ya está configurado con Azure SQL Database**

La conexión está establecida en `config/database.php`:
- Servidor: `1536271azure.database.windows.net`
- Base de datos: `tiendacomputadora`
- Conexión mediante PDO con drivers SQLSRV

**Nota:** Las credenciales están configuradas y la base de datos está operativa.

### 3. Iniciar Aplicación

```bash
# Inicia Apache en XAMPP
http://localhost/Tienda-Computadora/
```

## 📁 Estructura

```
Tienda-Computadora/
├── assets/              # CSS, JS, imágenes
├── config/              # Configuración y conexión BD
├── Database/            # La tabla computadoras
├── includes/            # Header y footer
├── pages/               # CRUD (listado, agregar, editar, ver)
└── index.php
```

## 🌐 Deploy en Azure App Service

### Ventajas
- Drivers ya instalados
- Sin configuración manual

### Pasos
1. Crear App Service en Azure
2. Configurar variables de entorno (DB_SERVER, DB_USERNAME, etc.)
3. Habilitar extensiones: `pdo_sqlsrv`, `sqlsrv`
4. Desplegar código (Git/FTP)

## 🔒 Seguridad

- PDO con prepared statements
- Validación con `htmlspecialchars()`
- Conexión cifrada a Azure
- **⚠️ No subir credenciales a repositorios públicos**

## 🐛 Problemas Comunes

| Error | Solución |
|-------|----------|
| "could not find driver" | Instalar drivers PHP SQLSRV |
| "ODBC Driver not found" | Instalar ODBC Driver 17 |
| "unsupported attribute" | Usar `LoginTimeout` en DSN, no en opciones PDO |
| Error de conexión Azure | Verificar firewall y credenciales |

**Versión:** 1.0.0 | **Stack:** PHP + Azure SQL Database
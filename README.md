# CRUD de Computadoras - PHP Puro + Bootstrap

Una aplicación web simple para gestionar un inventario de computadoras, desarrollada en PHP puro con Bootstrap 5 para el diseño.

## Características

- ✅ **Crear** nuevas computadoras
- ✅ **Leer** lista de computadoras y ver detalles
- ✅ **Actualizar** información de computadoras existentes
- ✅ **Eliminar** computadoras del inventario
- 🎨 Interfaz moderna con Bootstrap 5
- 📱 Diseño responsivo
- ✔️ Validación de formularios
- 🔒 Uso de PDO para seguridad contra SQL injection

## Requisitos

- XAMPP (Apache + MySQL + PHP)
- PHP 7.4 o superior
- MySQL/MariaDB

## Instalación

1. **Clonar/Copiar archivos** en la carpeta `htdocs` de XAMPP:
   ```
   c:\xampp\htdocs\S+\
   ```

2. **Crear la base de datos**:
   - Abrir phpMyAdmin (http://localhost/phpmyadmin)
   - Crear una nueva base de datos llamada `computadoras_db`
   - Importar o ejecutar el archivo `tabla_computadoras.sql`

3. **Configurar conexión** (opcional):
   - Editar `config.php` si necesitas cambiar los datos de conexión
   - Por defecto usa: host=localhost, user=root, password=vacío

4. **Acceder a la aplicación**:
   ```
   http://localhost/S+/
   ```

## Estructura de Archivos

```
S+/
├── config/
│   ├── config.php      # Configuración general de la aplicación
│   └── database.php    # Configuración de base de datos
├── views/
│   ├── listado.php     # Página principal (listado de computadoras)
│   ├── agregar.php     # Formulario para agregar computadora
│   ├── editar.php      # Formulario para editar computadora
│   └── ver.php         # Ver detalles de computadora
├── includes/
│   ├── header.php      # Header común con navegación
│   └── footer.php      # Footer común
├── assets/
│   └── style.css       # Estilos personalizados
├── index.php           # Archivo principal (redirige al listado)
├── tabla_computadoras.sql  # Script de base de datos
└── README.md           # Este archivo
```

## Funcionalidades

### Página Principal (views/listado.php)
- Lista todas las computadoras en una tabla responsiva
- Botones de acción: Ver, Editar, Eliminar
- Mensajes de confirmación para operaciones exitosas
- Contador total de computadoras
- Navegación integrada con navbar

### Agregar Computadora (views/agregar.php)
- Formulario completo con validación
- Campos obligatorios marcados con *
- Selects predefinidos para marca, categoría y RAM
- Validación tanto del lado cliente como servidor
- Header y footer comunes

### Editar Computadora (views/editar.php)
- Formulario prellenado con datos existentes
- Mismas validaciones que el formulario de agregar
- Muestra fecha de registro original
- Interfaz consistente con el resto de la aplicación

### Ver Detalles (views/ver.php)
- Vista detallada de una computadora específica
- Especificaciones técnicas en tarjetas visuales
- Botones de acción: Editar y Eliminar
- Diseño mejorado con estilos personalizados

## Campos de la Base de Datos

- **id**: Identificador único (auto-increment)
- **nombre**: Nombre del modelo
- **marca**: Marca del fabricante
- **categoria**: Gaming, Desktop, Laptop, etc.
- **procesador**: Modelo del procesador
- **ram_gb**: Cantidad de RAM en GB
- **almacenamiento**: Tipo y capacidad de almacenamiento
- **tarjeta_grafica**: Modelo de tarjeta gráfica
- **precio**: Precio en formato decimal
- **stock**: Cantidad disponible
- **descripcion**: Descripción opcional
- **fecha_agregado**: Timestamp de creación

## Arquitectura y Organización

### Separación de Responsabilidades
- **config/**: Configuraciones de la aplicación y base de datos
- **views/**: Páginas de la interfaz de usuario
- **includes/**: Componentes reutilizables (header, footer)
- **assets/**: Recursos estáticos (CSS, JS, imágenes)

### Ventajas de la Nueva Estructura
- ✅ **Mantenibilidad**: Código organizado y fácil de mantener
- ✅ **Reutilización**: Header y footer comunes en todas las páginas
- ✅ **Escalabilidad**: Fácil agregar nuevas funcionalidades
- ✅ **Separación**: Lógica separada de la presentación
- ✅ **Configuración centralizada**: Un solo lugar para configuraciones

## Tecnologías Utilizadas

- **Backend**: PHP 8+ con PDO
- **Frontend**: Bootstrap 5.3.0 + CSS personalizado
- **Iconos**: Bootstrap Icons
- **Base de datos**: MySQL/MariaDB
- **Servidor**: Apache (XAMPP)
- **Arquitectura**: MVC simplificado

## Seguridad

- Uso de **PDO con prepared statements** para prevenir SQL injection
- **Validación de datos** tanto en cliente como servidor
- **Escape de HTML** para prevenir XSS
- **Validación de tipos** para parámetros numéricos

## Personalización

Para personalizar la aplicación:

1. **Agregar nuevas marcas**: Editar los arrays en `agregar.php` y `editar.php`
2. **Modificar campos**: Actualizar la estructura de la tabla y los formularios
3. **Cambiar estilos**: Personalizar las clases de Bootstrap o agregar CSS custom
4. **Agregar funcionalidades**: Implementar búsqueda, filtros, paginación, etc.

## Posibles Mejoras

- [ ] Sistema de búsqueda y filtros
- [ ] Paginación para listas grandes
- [ ] Subida de imágenes para computadoras
- [ ] Exportar datos a Excel/PDF
- [ ] Sistema de usuarios y autenticación
- [ ] API REST para integración con otras aplicaciones
- [ ] Dashboard con estadísticas

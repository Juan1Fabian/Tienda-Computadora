<?php
require_once '../config/config.php';

// Configuración de la página
$page_title = 'Editar Computadora - ' . APP_NAME;

$error = '';
$computadora = null;

// Obtener ID de la computadora
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: listado.php");
    exit;
}

$id = (int)$_GET['id'];

// Obtener datos de la computadora
try {
    $stmt = $pdo->prepare("SELECT * FROM computadoras WHERE id = ?");
    $stmt->execute([$id]);
    $computadora = $stmt->fetch();
    
    if (!$computadora) {
        header("Location: listado.php");
        exit;
    }
} catch(PDOException $e) {
    $error = "Error al obtener datos: " . $e->getMessage();
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $marca = trim($_POST['marca']);
    $categoria = trim($_POST['categoria']);
    $procesador = trim($_POST['procesador']);
    $ram_gb = (int)$_POST['ram_gb'];
    $almacenamiento = trim($_POST['almacenamiento']);
    $tarjeta_grafica = trim($_POST['tarjeta_grafica']);
    $precio = (float)$_POST['precio'];
    $stock = (int)$_POST['stock'];
    $descripcion = trim($_POST['descripcion']);

    // Validaciones básicas
    if (empty($nombre) || empty($marca) || empty($categoria) || empty($procesador) || $ram_gb <= 0 || $precio <= 0) {
        $error = 'Por favor, completa todos los campos obligatorios correctamente.';
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE computadoras SET nombre = ?, marca = ?, categoria = ?, procesador = ?, ram_gb = ?, almacenamiento = ?, tarjeta_grafica = ?, precio = ?, stock = ?, descripcion = ? WHERE id = ?");
            $stmt->execute([$nombre, $marca, $categoria, $procesador, $ram_gb, $almacenamiento, $tarjeta_grafica, $precio, $stock, $descripcion, $id]);
            
            header("Location: listado.php?success=updated");
            exit;
        } catch(PDOException $e) {
            $error = "Error al actualizar: " . $e->getMessage();
        }
    }
}
// Incluir header
require_once '../includes/header.php';
?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil"></i> Editar Computadora #<?php echo $computadora['id']; ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="listado.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Volver al listado
                            </a>
                        </div>

                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre *</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" 
                                           value="<?php echo htmlspecialchars($_POST['nombre'] ?? $computadora['nombre']); ?>" 
                                           required>
                                    <div class="invalid-feedback">
                                        Por favor ingresa el nombre de la computadora.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="marca" class="form-label">Marca *</label>
                                    <select class="form-select" id="marca" name="marca" required>
                                        <option value="">Seleccionar marca...</option>
                                        <?php 
                                        $marcas = ['ASUS', 'Dell', 'Apple', 'Lenovo', 'HP', 'Acer', 'MSI'];
                                        $marca_actual = $_POST['marca'] ?? $computadora['marca'];
                                        foreach ($marcas as $marca): ?>
                                            <option value="<?php echo $marca; ?>" <?php echo ($marca_actual == $marca) ? 'selected' : ''; ?>>
                                                <?php echo $marca; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor selecciona una marca.
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="categoria" class="form-label">Categoría *</label>
                                    <select class="form-select" id="categoria" name="categoria" required>
                                        <option value="">Seleccionar categoría...</option>
                                        <?php 
                                        $categorias = ['Gaming', 'Desktop', 'Laptop', 'Workstation', 'Ultrabook'];
                                        $categoria_actual = $_POST['categoria'] ?? $computadora['categoria'];
                                        foreach ($categorias as $categoria): ?>
                                            <option value="<?php echo $categoria; ?>" <?php echo ($categoria_actual == $categoria) ? 'selected' : ''; ?>>
                                                <?php echo $categoria; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor selecciona una categoría.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="procesador" class="form-label">Procesador *</label>
                                    <input type="text" class="form-control" id="procesador" name="procesador" 
                                           value="<?php echo htmlspecialchars($_POST['procesador'] ?? $computadora['procesador']); ?>" 
                                           placeholder="Ej: Intel Core i7-12700H" required>
                                    <div class="invalid-feedback">
                                        Por favor ingresa el procesador.
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="ram_gb" class="form-label">RAM (GB) *</label>
                                    <select class="form-select" id="ram_gb" name="ram_gb" required>
                                        <option value="">Seleccionar...</option>
                                        <?php 
                                        $ram_opciones = [4, 8, 16, 32, 64];
                                        $ram_actual = $_POST['ram_gb'] ?? $computadora['ram_gb'];
                                        foreach ($ram_opciones as $ram): ?>
                                            <option value="<?php echo $ram; ?>" <?php echo ($ram_actual == $ram) ? 'selected' : ''; ?>>
                                                <?php echo $ram; ?> GB
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona la cantidad de RAM.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="precio" class="form-label">Precio ($) *</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" 
                                           value="<?php echo $_POST['precio'] ?? $computadora['precio']; ?>" 
                                           placeholder="0.00" required>
                                    <div class="invalid-feedback">
                                        Por favor ingresa un precio válido.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" min="0" class="form-control" id="stock" name="stock" 
                                           value="<?php echo $_POST['stock'] ?? $computadora['stock']; ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="almacenamiento" class="form-label">Almacenamiento</label>
                                <input type="text" class="form-control" id="almacenamiento" name="almacenamiento" 
                                       value="<?php echo htmlspecialchars($_POST['almacenamiento'] ?? $computadora['almacenamiento']); ?>" 
                                       placeholder="Ej: SSD NVMe 512GB">
                            </div>

                            <div class="mb-3">
                                <label for="tarjeta_grafica" class="form-label">Tarjeta Gráfica</label>
                                <input type="text" class="form-control" id="tarjeta_grafica" name="tarjeta_grafica" 
                                       value="<?php echo htmlspecialchars($_POST['tarjeta_grafica'] ?? $computadora['tarjeta_grafica']); ?>" 
                                       placeholder="Ej: NVIDIA GeForce RTX 4060">
                            </div>

                            <div class="mb-4">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" 
                                          placeholder="Descripción opcional de la computadora"><?php echo htmlspecialchars($_POST['descripcion'] ?? $computadora['descripcion']); ?></textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="listado.php" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-check-circle"></i> Actualizar Computadora
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> 
                            <strong>Fecha de registro:</strong> <?php echo date('d/m/Y H:i', strtotime($computadora['fecha_agregado'])); ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
$extra_js = '
<script>
    // Validación de Bootstrap
    (function() {
        "use strict";
        window.addEventListener("load", function() {
            var forms = document.getElementsByClassName("needs-validation");
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener("submit", function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                }, false);
            });
        }, false);
    })();
</script>';
require_once '../includes/footer.php'; 
?>

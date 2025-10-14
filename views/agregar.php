<?php
require_once '../config/config.php';

// Configuración de la página
$page_title = 'Agregar Computadora - ' . APP_NAME;

$error = '';
$success = '';

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
            $stmt = $pdo->prepare("INSERT INTO computadoras (nombre, marca, categoria, procesador, ram_gb, almacenamiento, tarjeta_grafica, precio, stock, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $marca, $categoria, $procesador, $ram_gb, $almacenamiento, $tarjeta_grafica, $precio, $stock, $descripcion]);
            
            header("Location: listado.php?success=added");
            exit;
        } catch(PDOException $e) {
            $error = "Error al guardar: " . $e->getMessage();
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
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva Computadora
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
                                           value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" 
                                           required>
                                    <div class="invalid-feedback">
                                        Por favor ingresa el nombre de la computadora.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="marca" class="form-label">Marca *</label>
                                    <select class="form-select" id="marca" name="marca" required>
                                        <option value="">Seleccionar marca...</option>
                                        <option value="ASUS" <?php echo (isset($_POST['marca']) && $_POST['marca'] == 'ASUS') ? 'selected' : ''; ?>>ASUS</option>
                                        <option value="Dell" <?php echo (isset($_POST['marca']) && $_POST['marca'] == 'Dell') ? 'selected' : ''; ?>>Dell</option>
                                        <option value="Apple" <?php echo (isset($_POST['marca']) && $_POST['marca'] == 'Apple') ? 'selected' : ''; ?>>Apple</option>
                                        <option value="Lenovo" <?php echo (isset($_POST['marca']) && $_POST['marca'] == 'Lenovo') ? 'selected' : ''; ?>>Lenovo</option>
                                        <option value="HP" <?php echo (isset($_POST['marca']) && $_POST['marca'] == 'HP') ? 'selected' : ''; ?>>HP</option>
                                        <option value="Acer" <?php echo (isset($_POST['marca']) && $_POST['marca'] == 'Acer') ? 'selected' : ''; ?>>Acer</option>
                                        <option value="MSI" <?php echo (isset($_POST['marca']) && $_POST['marca'] == 'MSI') ? 'selected' : ''; ?>>MSI</option>
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
                                        <option value="Gaming" <?php echo (isset($_POST['categoria']) && $_POST['categoria'] == 'Gaming') ? 'selected' : ''; ?>>Gaming</option>
                                        <option value="Desktop" <?php echo (isset($_POST['categoria']) && $_POST['categoria'] == 'Desktop') ? 'selected' : ''; ?>>Desktop</option>
                                        <option value="Laptop" <?php echo (isset($_POST['categoria']) && $_POST['categoria'] == 'Laptop') ? 'selected' : ''; ?>>Laptop</option>
                                        <option value="Workstation" <?php echo (isset($_POST['categoria']) && $_POST['categoria'] == 'Workstation') ? 'selected' : ''; ?>>Workstation</option>
                                        <option value="Ultrabook" <?php echo (isset($_POST['categoria']) && $_POST['categoria'] == 'Ultrabook') ? 'selected' : ''; ?>>Ultrabook</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor selecciona una categoría.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="procesador" class="form-label">Procesador *</label>
                                    <input type="text" class="form-control" id="procesador" name="procesador" 
                                           value="<?php echo isset($_POST['procesador']) ? htmlspecialchars($_POST['procesador']) : ''; ?>" 
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
                                        <option value="4" <?php echo (isset($_POST['ram_gb']) && $_POST['ram_gb'] == '4') ? 'selected' : ''; ?>>4 GB</option>
                                        <option value="8" <?php echo (isset($_POST['ram_gb']) && $_POST['ram_gb'] == '8') ? 'selected' : ''; ?>>8 GB</option>
                                        <option value="16" <?php echo (isset($_POST['ram_gb']) && $_POST['ram_gb'] == '16') ? 'selected' : ''; ?>>16 GB</option>
                                        <option value="32" <?php echo (isset($_POST['ram_gb']) && $_POST['ram_gb'] == '32') ? 'selected' : ''; ?>>32 GB</option>
                                        <option value="64" <?php echo (isset($_POST['ram_gb']) && $_POST['ram_gb'] == '64') ? 'selected' : ''; ?>>64 GB</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona la cantidad de RAM.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="precio" class="form-label">Precio ($) *</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" 
                                           value="<?php echo isset($_POST['precio']) ? $_POST['precio'] : ''; ?>" 
                                           placeholder="0.00" required>
                                    <div class="invalid-feedback">
                                        Por favor ingresa un precio válido.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" min="0" class="form-control" id="stock" name="stock" 
                                           value="<?php echo isset($_POST['stock']) ? $_POST['stock'] : '0'; ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="almacenamiento" class="form-label">Almacenamiento</label>
                                <input type="text" class="form-control" id="almacenamiento" name="almacenamiento" 
                                       value="<?php echo isset($_POST['almacenamiento']) ? htmlspecialchars($_POST['almacenamiento']) : ''; ?>" 
                                       placeholder="Ej: SSD NVMe 512GB">
                            </div>

                            <div class="mb-3">
                                <label for="tarjeta_grafica" class="form-label">Tarjeta Gráfica</label>
                                <input type="text" class="form-control" id="tarjeta_grafica" name="tarjeta_grafica" 
                                       value="<?php echo isset($_POST['tarjeta_grafica']) ? htmlspecialchars($_POST['tarjeta_grafica']) : ''; ?>" 
                                       placeholder="Ej: NVIDIA GeForce RTX 4060">
                            </div>

                            <div class="mb-4">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" 
                                          placeholder="Descripción opcional de la computadora"><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?></textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="listado.php" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Guardar Computadora
                                </button>
                            </div>
                        </form>
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

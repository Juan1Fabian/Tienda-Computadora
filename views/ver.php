<?php
require_once '../config/config.php';

// Configuración de la página
$page_title = 'Ver Computadora - ' . APP_NAME;

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
// Incluir header
require_once '../includes/header.php';
?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php else: ?>
                    <div class="card shadow">
                        <div class="card-header bg-info text-white">
                            <h4 class="mb-0">
                                <i class="bi bi-eye"></i> Detalles de la Computadora
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <a href="listado.php" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Volver al listado
                                </a>
                                <a href="editar.php?id=<?php echo $computadora['id']; ?>" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="listado.php?delete=<?php echo $computadora['id']; ?>" 
                                   class="btn btn-danger"
                                   onclick="return confirm('¿Estás seguro de eliminar esta computadora?')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-3">
                                        <i class="bi bi-laptop"></i> <?php echo htmlspecialchars($computadora['nombre']); ?>
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <strong>ID:</strong> 
                                        <span class="badge bg-secondary"><?php echo $computadora['id']; ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Marca:</strong> 
                                        <span class="badge bg-primary"><?php echo htmlspecialchars($computadora['marca']); ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Categoría:</strong> 
                                        <span class="badge bg-info"><?php echo htmlspecialchars($computadora['categoria']); ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Procesador:</strong><br>
                                        <span class="text-muted"><?php echo htmlspecialchars($computadora['procesador']); ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <strong>RAM:</strong> 
                                        <span class="badge bg-success"><?php echo $computadora['ram_gb']; ?> GB</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Precio:</strong><br>
                                        <h4 class="text-success">$<?php echo number_format($computadora['precio'], 2); ?></h4>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Stock:</strong>
                                        <?php if ($computadora['stock'] > 0): ?>
                                            <span class="badge bg-success"><?php echo $computadora['stock']; ?> unidades</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Sin stock</span>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($computadora['almacenamiento']): ?>
                                        <div class="mb-3">
                                            <strong>Almacenamiento:</strong><br>
                                            <span class="text-muted"><?php echo htmlspecialchars($computadora['almacenamiento']); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($computadora['tarjeta_grafica']): ?>
                                        <div class="mb-3">
                                            <strong>Tarjeta Gráfica:</strong><br>
                                            <span class="text-muted"><?php echo htmlspecialchars($computadora['tarjeta_grafica']); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <strong>Fecha de registro:</strong><br>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar"></i> 
                                            <?php echo date('d/m/Y H:i', strtotime($computadora['fecha_agregado'])); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <?php if ($computadora['descripcion']): ?>
                                <hr>
                                <div class="mb-3">
                                    <strong>Descripción:</strong>
                                    <div class="mt-2 p-3 bg-light rounded">
                                        <?php echo nl2br(htmlspecialchars($computadora['descripcion'])); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Especificaciones técnicas en tarjeta separada -->
                    <div class="card mt-3 shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0"><i class="bi bi-cpu"></i> Especificaciones Técnicas</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center p-3 border rounded">
                                        <i class="bi bi-cpu display-6 text-primary"></i>
                                        <h6 class="mt-2">Procesador</h6>
                                        <small class="text-muted"><?php echo htmlspecialchars($computadora['procesador']); ?></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center p-3 border rounded">
                                        <i class="bi bi-memory display-6 text-success"></i>
                                        <h6 class="mt-2">Memoria RAM</h6>
                                        <small class="text-muted"><?php echo $computadora['ram_gb']; ?> GB</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center p-3 border rounded">
                                        <i class="bi bi-hdd display-6 text-warning"></i>
                                        <h6 class="mt-2">Almacenamiento</h6>
                                        <small class="text-muted"><?php echo htmlspecialchars($computadora['almacenamiento'] ?: 'No especificado'); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php require_once '../includes/footer.php'; ?>

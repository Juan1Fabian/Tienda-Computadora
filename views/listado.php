<?php
require_once '../config/config.php';

// Configuración de la página
$page_title = 'Listado de Computadoras - ' . APP_NAME;

// Obtener todas las computadoras
try {
    $stmt = $pdo->query("SELECT * FROM computadoras ORDER BY fecha_agregado DESC");
    $computadoras = $stmt->fetchAll();
} catch(PDOException $e) {
    $error = "Error al obtener datos: " . $e->getMessage();
}

// Manejar eliminación
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $stmt = $pdo->prepare("DELETE FROM computadoras WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: listado.php?success=deleted");
        exit;
    } catch(PDOException $e) {
        $error = "Error al eliminar: " . $e->getMessage();
    }
}
// Incluir header
require_once '../includes/header.php';
?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="agregar.php" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Agregar Nueva
                    </a>
                </div>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php
                        switch($_GET['success']) {
                            case 'added': echo 'Computadora agregada exitosamente.'; break;
                            case 'updated': echo 'Computadora actualizada exitosamente.'; break;
                            case 'deleted': echo 'Computadora eliminada exitosamente.'; break;
                        }
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-list"></i> Lista de Computadoras</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($computadoras)): ?>
                            <div class="text-center p-5">
                                <i class="bi bi-inbox display-1 text-muted"></i>
                                <p class="mt-3 text-muted">No hay computadoras registradas.</p>
                                <a href="agregar.php" class="btn btn-primary">Agregar la primera</a>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Marca</th>
                                            <th>Categoría</th>
                                            <th>Procesador</th>
                                            <th>RAM (GB)</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($computadoras as $comp): ?>
                                            <tr>
                                                <td><span class="badge bg-secondary"><?php echo $comp['id']; ?></span></td>
                                                <td>
                                                    <strong><?php echo htmlspecialchars($comp['nombre']); ?></strong>
                                                    <?php if ($comp['descripcion']): ?>
                                                        <br><small class="text-muted"><?php echo htmlspecialchars(substr($comp['descripcion'], 0, 50)) . '...'; ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($comp['marca']); ?></td>
                                                <td>
                                                    <span class="badge bg-info"><?php echo htmlspecialchars($comp['categoria']); ?></span>
                                                </td>
                                                <td><?php echo htmlspecialchars($comp['procesador']); ?></td>
                                                <td><span class="badge bg-primary"><?php echo $comp['ram_gb']; ?> GB</span></td>
                                                <td><strong class="text-success">$<?php echo number_format($comp['precio'], 2); ?></strong></td>
                                                <td>
                                                    <?php if ($comp['stock'] > 0): ?>
                                                        <span class="badge bg-success"><?php echo $comp['stock']; ?></span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Sin stock</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="ver.php?id=<?php echo $comp['id']; ?>" 
                                                           class="btn btn-sm btn-outline-info" 
                                                           title="Ver detalles">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="editar.php?id=<?php echo $comp['id']; ?>" 
                                                           class="btn btn-sm btn-outline-warning" 
                                                           title="Editar">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <a href="?delete=<?php echo $comp['id']; ?>" 
                                                           class="btn btn-sm btn-outline-danger" 
                                                           title="Eliminar"
                                                           onclick="return confirm('¿Estás seguro de eliminar esta computadora?')">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <small class="text-muted">
                        Total de computadoras: <strong><?php echo count($computadoras); ?></strong>
                    </small>
                </div>
            </div>
        </div>
    </div>

<?php require_once '../includes/footer.php'; ?>

<?php
require_once '../Controlador/MedicamentoController.php';
$controlador = new MedicamentoControlador();
$medicamentos = $controlador->index();

// Initialize variables for editing
$editMode = false;
$medicamentoToEdit = null;

// Check if an edit action has been triggered
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'agregar') {
        $controlador->agregar(
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['tipo'],
            $_POST['precio'],
            $_POST['cantidad']
        );
        header('Location: index_medicamento.php?status=success');
        exit();
    } 

    if ($accion === 'eliminar') {
        $controlador->eliminar($_POST['id']);
        header('Location: index_medicamento.php?status=deleted');
        exit();
    }

    if ($accion === 'editar') {
        $editMode = true;
        // Fetch the medication to edit
        $medicamentoToEdit = $controlador->obtenerMedicamentoPorId($_POST['id']);
    }

    if ($accion === 'actualizar') {
        $controlador->editar(
            $_POST['id'],
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['tipo'],
            $_POST['precio'],
            $_POST['cantidad']
        );
        header('Location: index_medicamento.php?status=updated');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Medicamentos</title>
    <link rel="stylesheet" href="style_medicamento.css">
</head>
<body>
    <div class="container">
        <h1>Registro de Medicamentos</h1>
       
        <form action="index.php" method="GET">
    <button type="submit" class="btn-salir">Salir</button>
</form>




        <?php if (isset($_GET['status'])): ?>
            <p class="status-message">
                <?php if ($_GET['status'] === 'success') echo "Medicamento agregado exitosamente"; ?>
                <?php if ($_GET['status'] === 'updated') echo "Medicamento actualizado correctamente"; ?>
                <?php if ($_GET['status'] === 'deleted') echo "Medicamento eliminado correctamente"; ?>
            </p>
        <?php endif; ?>

        <!-- Formulario para agregar/editar medicamentos -->
        <form action="index_medicamento.php" method="POST" class="medicamento-form">
            <input type="hidden" name="id" value="<?= $editMode ? htmlspecialchars($medicamentoToEdit['id_medicamento']) : '' ?>">
            <input type="text" name="nombre" placeholder="Nombre" required value="<?= $editMode ? htmlspecialchars($medicamentoToEdit['nombre']) : '' ?>">
            <input type="text" name="descripcion" placeholder="Descripción" required value="<?= $editMode ? htmlspecialchars($medicamentoToEdit['descripcion']) : '' ?>">
            <input type="text" name="tipo" placeholder="Tipo" required value="<?= $editMode ? htmlspecialchars($medicamentoToEdit['tipo']) : '' ?>">
            <input type="number" step="0.01" name="precio" placeholder="Precio" required value="<?= $editMode ? htmlspecialchars($medicamentoToEdit['precio']) : '' ?>">
            <input type="number" name="cantidad" placeholder="Cantidad" required value="<?= $editMode ? htmlspecialchars($medicamentoToEdit['cantidad']) : '' ?>">
            <button type="submit" name="accion" value="<?= $editMode ? 'actualizar' : 'agregar' ?>"><?= $editMode ? 'Actualizar' : 'Agregar' ?></button>
        </form>

        <!-- Tabla para mostrar los medicamentos -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicamentos as $medicamento): ?>
                    <tr>
                        <td><?= htmlspecialchars($medicamento['id_medicamento']) ?></td>
                        <td><?= htmlspecialchars($medicamento['nombre']) ?></td>
                        <td><?= htmlspecialchars($medicamento['descripcion']) ?></td>
                        <td><?= htmlspecialchars($medicamento['tipo']) ?></td>
                        <td><?= htmlspecialchars($medicamento['precio']) ?></td>
                        <td><?= htmlspecialchars($medicamento['cantidad']) ?></td>
                        <td>
                            <form action="index_medicamento.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($medicamento['id_medicamento']) ?>">
                                <button type="submit" name="accion" value="eliminar" class="btn-eliminar">Eliminar</button>
                                <button type="submit" name="accion" value="editar" class="btn-editar">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

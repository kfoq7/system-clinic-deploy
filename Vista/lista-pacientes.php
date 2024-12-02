<?php
require_once '../Controlador/PacienteController.php';
require_once '../Controlador/DistritoController.php';

// Controladores
$controlador = new PacienteController();
$pacientes = $controlador->getAllPacientes();

$controladorDistritos = new DistritoController();
$distritos = $controladorDistritos->getAllDistritos();

// Modo de edición
$editMode = false;
$pacienteToEdit = null;

// Manejo de acciones (Agregar, Editar, Actualizar)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    $codigo = $_POST['id'] ?? null;

    if ($accion === 'agregar') {
        $controlador->agregar(
            $_POST['nombre'],
            $_POST['direccion'],
            $_POST['fecha_nacimiento'],
            $_POST['selDistrito'],
            $_POST['email']
        );
        $pacientes = $controlador->getAllPacientes(); // Actualiza la lista
    }

    if ($accion === 'editar') {
        $editMode = true;
        $pacienteToEdit = $controlador->getPacienteById($_POST['id']);
    }

    if ($accion === 'actualizar' && $codigo) {
        $controlador->updatePaciente(
            $codigo,
            $_POST['nombre'],
            $_POST['direccion'],
            $_POST['fecha_nacimiento'],
            $_POST['selDistrito'],
            $_POST['email']
        );
        $pacientes = $controlador->getAllPacientes(); // Actualiza la lista
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <link rel="stylesheet" type="text/css" href="./lista-pacientes.css">
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <section>
        <h1><?= $editMode ? "Actualizar Paciente" : "Nuevo Paciente"; ?></h1>

        <!-- Formulario -->
        <div class="form-container">
            <form method="POST" action="lista-pacientes.php">
                <div class="form-row">
                    <div>
                        <label for="codigo">Código:</label>
                        <input name="id" type="text" value="<?= $editMode && isset($pacienteToEdit['id_paciente']) ? htmlspecialchars($pacienteToEdit['id_paciente']) : '' ?>" <?= $editMode ? 'readonly' : '' ?>>
                    </div>
                    <div>
                        <label for="nombre">Nombre:</label>
                        <input name="nombre" type="text" value="<?= $editMode && isset($pacienteToEdit['nombre']) ? htmlspecialchars($pacienteToEdit['nombre']) : '' ?>" required>
                    </div>
                    <div>
                        <label for="direccion">Dirección:</label>
                        <input name="direccion" type="text" value="<?= $editMode && isset($pacienteToEdit['direccion']) ? htmlspecialchars($pacienteToEdit['direccion']) : '' ?>" required>
                    </div>
                    <div>
                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input name="fecha_nacimiento" type="date" class="styled-date" value="<?= $editMode && isset($pacienteToEdit['fecha_nacimiento']) ? htmlspecialchars($pacienteToEdit['fecha_nacimiento']) : '' ?>" required>
                    </div>
                    <div>
                        <label for="selDistrito">Seleccione un Distrito:</label>
                        <select name="selDistrito" id="selDistrito" required>
                            <?php foreach ($distritos as $distrito): ?>
                                <option value="<?= isset($distrito['id_distrito']) ? $distrito['id_distrito'] : '' ?>"
                                    <?= ($editMode && isset($pacienteToEdit['id_distrito']) && $pacienteToEdit['id_distrito'] == $distrito['id_distrito']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($distrito['nombre_distrito'] ?? 'Sin nombre') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input name="email" type="email" value="<?= $editMode && isset($pacienteToEdit['email']) ? htmlspecialchars($pacienteToEdit['email']) : '' ?>" required>
                    </div>
                </div>
                <button class="submit-btn" type="submit" name="accion" value="<?= $editMode ? 'actualizar' : 'agregar' ?>">
                    <?= $editMode ? 'Actualizar' : 'Agregar' ?>
                </button>
            </form>
        </div>

        <!-- Tabla -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Distrito</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pacientes as $paciente): ?>
                        <tr>
                            <td><?= htmlspecialchars($paciente['id_paciente'] ?? '') ?></td>
                            <td><?= htmlspecialchars($paciente['nombre'] ?? '') ?></td>
                            <td><?= htmlspecialchars($paciente['direccion'] ?? '') ?></td>
                            <td><?= htmlspecialchars($paciente['fecha_nacimiento'] ?? '') ?></td>
                            <td><?= htmlspecialchars($paciente['nombre_distrito'] ?? '') ?></td>
                            <td><?= htmlspecialchars($paciente['email'] ?? '') ?></td>
                            <td>
                                <form action="lista-pacientes.php" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($paciente['id_paciente'] ?? '') ?>">
                                    <button type="submit" name="accion" value="editar" class="btn-editar">Editar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>

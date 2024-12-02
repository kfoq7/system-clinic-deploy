<?php
session_start();
include_once '../Controlador/PacienteController.php';
$controlador = new PacienteController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $paciente = $controlador->getPacienteById($id); 

    if (!$paciente) {
        echo "<script>alert('El paciente con ID especificado no existe.'); window.location.href='index_paciente.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID de paciente no especificado.'); window.location.href='index_paciente.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono']; // Aseguramos capturar el teléfono
    $gmail = $_POST['gmail'];

    if ($controlador->updatePaciente($id, $nombre, $fecha_nacimiento, $direccion, $telefono, $gmail)) {
        echo "<script>alert('Paciente actualizado con éxito.'); window.location.href='index_paciente.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error al actualizar paciente.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f0fa;
            color: #333;
        }

        h1 {
            color: #005b96;
            text-align: center;
            margin-top: 20px;
        }

        .container {
            margin-top: 30px;
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #0275d8;
            border: none;
        }

        .btn-primary:hover {
            background-color: #025aa5;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Actualizar Paciente</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($Paciente['nombre_paciente']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="<?php echo htmlspecialchars($Paciente['fecha_nacimiento']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo htmlspecialchars($Paciente['direccion']); ?>" required> <!-- Corregido 'direccion' -->
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo htmlspecialchars($Paciente['telefono']); ?>" required> <!-- Añadimos el campo 'telefono' -->
            </div>
            <div class="mb-3">
                <label for="gmail" class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" name="gmail" value="<?php echo htmlspecialchars($Paciente['gmail']); ?>" required> <!-- Añadimos el campo 'gmail' -->
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Paciente</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start(); 
include_once '../Controlador/MedicoControler.php'; 
$controlador = new MedicoControlador();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $medico = $controlador->obtenerMedicoPorID($id); 

    if (!$medico) {
        echo "<script>alert('El médico con ID especificado no existe.'); window.location.href='IndexMedico.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID de médico no especificado.'); window.location.href='IndexMedico.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];
    $telefono = $_POST['telefono'];

    if ($controlador->actualizarMedico($id, $nombre, $especialidad, $telefono)) {
        echo "<script>alert('Médico actualizado con éxito.'); window.location.href='indexMedico.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error al actualizar médico.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <h1>Actualizar Médico</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($medico['nombre_medico']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad:</label>
                <input type="text" class="form-control" name="especialidad" value="<?php echo htmlspecialchars($medico['especialidad']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo htmlspecialchars($medico['telefono_contacto']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Médico</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>
</html>

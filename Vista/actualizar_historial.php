<?php 
require_once("../util/conexion.php");
$conn = conectar(); 


$row = null; // Inicializar $row como null

if (isset($_GET['id'])) {
    $id_historial = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id_historial) {
        // Consulta para obtener los datos del historial
        $sql = "SELECT * FROM historial_medico WHERE id_historial = :id_historial";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_historial', $id_historial, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                echo "No se encontraron datos para este historial.";
                exit;
            }
        } catch (PDOException $e) {
            echo "Error al obtener los datos: " . htmlspecialchars($e->getMessage());
            exit;
        }
    } else {
        echo "ID de historial inválido.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Historial Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple" rel="stylesheet">

    <style>
       body {
            background-color: #e6f0fa; 
            font-family: 'Rancho&effect'; 
            font-weight: 300; 
            color: #333;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px; 
            margin: 20px auto; 
        }
        .form-label {
            font-size: 1.1rem;
            font-weight: 500;
            color: #005b96;
        }
        h1 {
            color: #005b96; 
            font-weight: 600; 
            font-size: 2.5rem; 
            letter-spacing: 1px; 
        }
        h3 {
            color: #0275d8; 
            font-weight: 500; 
            font-size: 1.8rem; 
            text-align: center; 
        }
        .btn-primary {
            background-color: #a3d126 ;
            color: #050504; 
            border: none; 
            font-size: 1.1rem; 
            padding: 12px; 
            font-weight: 500; 
            letter-spacing: 0.5px; 
        }
        .btn-primary:hover {
            background-color: #739022; 
        }
        body, table, form, h1, h3 {
            letter-spacing: 0.5px; 
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Actualizar Historial Médico</h1>
    <div class="form-container">
    <form method="POST" action="../Controlador/guardar_actualizacion.php">

        <input type="hidden" name="id_historial" value="<?php echo htmlspecialchars($row['id_historial'] ?? ''); ?>">

            <div class="mb-3">
                <label for="id_paciente" class="form-label">ID Paciente</label>
                <input type="number" class="form-control col-md-6" name="id_paciente" value="<?php echo htmlspecialchars($row['id_paciente'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
                <label for="id_medico" class="form-label">ID Médico</label>
                <input type="number" class="form-control col-md-6" name="id_medico" value="<?php echo htmlspecialchars($row['id_medico'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
                <label for="fecha_visita" class="form-label">Fecha de Visita</label>
                <input type="date" class="form-control col-md-6" name="fecha_visita" value="<?php echo htmlspecialchars($row['fecha_visita'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" required><?php echo htmlspecialchars($row['descripcion'] ?? ''); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="diagnostico" class="form-label">Diagnóstico</label>
                <textarea name="diagnostico" class="form-control" required><?php echo htmlspecialchars($row['diagnostico'] ?? ''); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="tratamiento" class="form-label">Tratamiento</label>
                <textarea name="tratamiento" class="form-control" required><?php echo htmlspecialchars($row['tratamiento'] ?? ''); ?></textarea>
            </div>

            <div style="display: flex; justify-content: center;">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

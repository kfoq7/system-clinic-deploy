<?php
require_once("../util/conexion.php"); // Incluir archivo de conexión a la base de datos
$conn = conectar();
try {
    // Conectar a la base de datos
    $conn = conectar();
    
    if (!$conn) {
        throw new Exception("No se pudo establecer la conexión con la base de datos.");
    }

    // Validar los datos recibidos del formulario
    $id_paciente = filter_input(INPUT_POST, 'id_paciente', FILTER_VALIDATE_INT);
    $id_medico = filter_input(INPUT_POST, 'id_medico', FILTER_VALIDATE_INT);
    $fecha_visita = filter_input(INPUT_POST, 'fecha_visita', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $diagnostico = filter_input(INPUT_POST, 'diagnostico', FILTER_SANITIZE_STRING);
    $tratamiento = filter_input(INPUT_POST, 'tratamiento', FILTER_SANITIZE_STRING);

    // Verificar que los datos no sean nulos o inválidos
    if (!$id_paciente || !$id_medico || !$fecha_visita || !$descripcion || !$diagnostico || !$tratamiento) {
        throw new Exception("Datos de formulario inválidos.");
    }

    // Preparar la consulta SQL para insertar los datos
    $stmt = $conn->prepare("INSERT INTO historial_medico (id_paciente, id_medico, fecha_visita, descripcion, diagnostico, tratamiento) 
                            VALUES (?, ?, ?, ?, ?, ?)");

    // Usar bindValue para enlazar valores a la consulta preparada
    $stmt->bindValue(1, $id_paciente, PDO::PARAM_INT);
    $stmt->bindValue(2, $id_medico, PDO::PARAM_INT);
    $stmt->bindValue(3, $fecha_visita, PDO::PARAM_STR);
    $stmt->bindValue(4, $descripcion, PDO::PARAM_STR);
    $stmt->bindValue(5, $diagnostico, PDO::PARAM_STR);
    $stmt->bindValue(6, $tratamiento, PDO::PARAM_STR);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Obtener el ID del último registro insertado
        $id_historial = $conn->lastInsertId();

        // Devolver los datos del nuevo registro en formato JSON
        echo json_encode([
            "status" => "success",
            "message" => "Historial registrado con éxito.",
            "data" => [
                "id_historial" => $id_historial,
                "id_paciente" => $id_paciente,
                "id_medico" => $id_medico,
                "fecha_visita" => $fecha_visita,
                "descripcion" => $descripcion,
                "diagnostico" => $diagnostico,
                "tratamiento" => $tratamiento
            ]
        ]);
    } else {
        throw new Exception("Error al ejecutar la consulta.");
    }
} catch (Exception $e) {
    // Devolver mensaje de error en formato JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

// Cerrar la conexión a la base de datos
$conn = null;
?>

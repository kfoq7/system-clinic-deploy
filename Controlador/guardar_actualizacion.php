<?php
// Asegurarse de que el archivo de conexión está correctamente incluido
require_once "../util/conexion.php"; // Asegúrate de que este archivo establece la conexión utilizando PDO
$conn = conectar();
// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos enviados desde el formulario
    $id_historial = filter_input(INPUT_POST, 'id_historial', FILTER_VALIDATE_INT);
    $id_paciente = filter_input(INPUT_POST, 'id_paciente', FILTER_VALIDATE_INT);
    $id_medico = filter_input(INPUT_POST, 'id_medico', FILTER_VALIDATE_INT);
    $fecha_visita = filter_input(INPUT_POST, 'fecha_visita', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $diagnostico = filter_input(INPUT_POST, 'diagnostico', FILTER_SANITIZE_STRING);
    $tratamiento = filter_input(INPUT_POST, 'tratamiento', FILTER_SANITIZE_STRING);

    // Verificar que todos los campos requeridos están presentes y válidos
    if ($id_historial && $id_paciente && $id_medico && $fecha_visita && $descripcion && $diagnostico && $tratamiento) {
        try {
            // Conectar a la base de datos
            $conn = conectar(); // Usa la función `conectar()` que ya has definido para conectarte a la base de datos

            if (!$conn) {
                throw new Exception("No se pudo establecer la conexión con la base de datos.");
            }

            // Preparar la consulta SQL para actualizar el historial médico
            $sql = "UPDATE historial_medico SET 
                    id_paciente = :id_paciente, 
                    id_medico = :id_medico, 
                    fecha_visita = :fecha_visita, 
                    descripcion = :descripcion, 
                    diagnostico = :diagnostico, 
                    tratamiento = :tratamiento
                    WHERE id_historial = :id_historial";

            $stmt = $conn->prepare($sql);

            // Vincular los valores del formulario a los parámetros de la consulta
            $stmt->bindParam(':id_historial', $id_historial, PDO::PARAM_INT);
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_visita', $fecha_visita);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':diagnostico', $diagnostico);
            $stmt->bindParam(':tratamiento', $tratamiento);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Historial médico actualizado correctamente.";
                // Redirigir al usuario de vuelta a la página de inicio después de la actualización
                header("Location: ../Vista/index_historial.php");
                exit();
            } else {
                echo "Error al actualizar el historial: " . implode(", ", $stmt->errorInfo());
            }

        } catch (Exception $e) {
            echo "Error al interactuar con la base de datos: " . $e->getMessage();
        }
    } else {
        echo "Error: Verifica que todos los campos estén correctamente llenados.";
    }
}
?>

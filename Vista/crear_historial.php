<?php
require_once("../util/conexion.php");
$conn = conectar(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos de entrada
    $id_paciente = filter_input(INPUT_POST, 'id_paciente', FILTER_VALIDATE_INT);
    $id_medico = filter_input(INPUT_POST, 'id_medico', FILTER_VALIDATE_INT);
    $fecha_visita = filter_input(INPUT_POST, 'fecha_visita', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $diagnostico = filter_input(INPUT_POST, 'diagnostico', FILTER_SANITIZE_STRING);
    $tratamiento = filter_input(INPUT_POST, 'tratamiento', FILTER_SANITIZE_STRING);

    // Verificar que los campos requeridos no estén vacíos o inválidos
    if ($id_paciente && $id_medico && $fecha_visita && $descripcion && $diagnostico && $tratamiento) {
        try {
            // Usar consultas preparadas
            $stmt = $conn->prepare("INSERT INTO historial_medico (id_paciente, id_medico, fecha_visita, descripcion, diagnostico, tratamiento) VALUES (:id_paciente, :id_medico, :fecha_visita, :descripcion, :diagnostico, :tratamiento)");

            // Vincular parámetros
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_visita', $fecha_visita);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':diagnostico', $diagnostico);
            $stmt->bindParam(':tratamiento', $tratamiento);

            if ($stmt->execute()) {
                // Mostrar el modal si la inserción fue exitosa
                header("Location: ./index_historial.php");
                echo "<script type='text/javascript'>
                        window.onload = function() {
                            alert('Historial registrado con éxito.');
                        }
                      </script>";
            } else {
                // Mostrar mensaje de error
                echo "<script type='text/javascript'>
                        window.onload = function() {
                            alert('Error al registrar el historial: " . $stmt->errorInfo()[2] . "');
                        }
                      </script>";
            }
        } catch (PDOException $e) {
            echo "<script type='text/javascript'>
                    window.onload = function() {
                        alert('Error en la base de datos: " . $e->getMessage() . "');
                    }
                  </script>";
        }
    } else {
        // Si los datos no son válidos, mostrar mensaje de error
        echo "<script type='text/javascript'>
                window.onload = function() {
                    alert('Error: Verifica los datos ingresados.');
                }
              </script>";
    }
    // Cerrar la conexión
    $conn = null;
}
?>

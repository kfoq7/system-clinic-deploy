<?php
require_once("../util/conexion.php");
$conn = conectar(); 

if (isset($_GET['id'])) {
    $id_historial = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id_historial) {
        try {
            // Consulta para eliminar el historial médico
            $stmt = $conn->prepare("DELETE FROM historial_medico WHERE id_historial = :id_historial");
            $stmt->bindParam(':id_historial', $id_historial, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Historial médico eliminado correctamente.";
                header("Location: ../Vista/index_historial.php"); // Redirige de vuelta a la página principal
                exit(); // Asegurar que no se ejecute más código después de redirigir
            } else {
                echo "Error al eliminar el historial: " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Error en la base de datos: " . $e->getMessage();
        }
    } else {
        echo "ID inválido.";
    }
} else {
    echo "No se ha recibido ningún ID para eliminar.";
}

// Cerrar la conexión
$conn = null;
?>

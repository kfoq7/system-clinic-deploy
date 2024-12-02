<?php
include_once '../util/conexion.php'; // Asegúrate de que esta ruta sea correcta

class MedicamentoDAO {

    // Obtener todos los medicamentos
    public static function obtenerTodos() {
        try {
            $conn = conectar(); // Usar la función conectar que ya tienes definida
            $stmt = $conn->query("SELECT * FROM medicamentos");
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Para PDO, usamos fetchAll
        } catch (PDOException $e) {
            echo "Error al obtener los medicamentos: " . $e->getMessage();
            return []; // Devuelve un array vacío en caso de error
        }
    }

    // Obtener un medicamento por ID
    public static function obtenerMedicamentoPorId($id) {
        try {
            $conn = conectar();
            $sql = "SELECT * FROM medicamentos WHERE id_medicamento = :id_medicamento";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_medicamento', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // fetch() para obtener solo un registro
        } catch (PDOException $e) {
            echo "Error al obtener el medicamento: " . $e->getMessage();
            return null; // Devuelve null en caso de error
        }
    }

    // Agregar un nuevo medicamento
    public static function agregar($nombre, $descripcion, $tipo, $precio, $cantidad) {
        try {
            $conn = conectar();
            $sql = "INSERT INTO medicamentos (nombre, descripcion, tipo, precio, cantidad) VALUES (:nombre, :descripcion, :tipo, :precio, :cantidad)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':cantidad', $cantidad);
            return $stmt->execute(); // Retorna true si la operación fue exitosa
        } catch (PDOException $e) {
            echo "Error al agregar el medicamento: " . $e->getMessage();
            return false; // Retorna false si ocurrió un error
        }
    }

    // Eliminar un medicamento por ID
    public static function eliminar($id) {
        try {
            $conn = conectar();
            $sql = "DELETE FROM medicamentos WHERE id_medicamento = :id_medicamento";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_medicamento', $id, PDO::PARAM_INT);
            return $stmt->execute(); // Retorna true si la operación fue exitosa
        } catch (PDOException $e) {
            echo "Error al eliminar el medicamento: " . $e->getMessage();
            return false; // Retorna false si ocurrió un error
        }
    }

    // Editar un medicamento existente
    public static function editar($id, $nombre, $descripcion, $tipo, $precio, $cantidad) {
        try {
            $conn = conectar();
            $sql = "UPDATE medicamentos SET nombre = :nombre, descripcion = :descripcion, tipo = :tipo, precio = :precio, cantidad = :cantidad WHERE id_medicamento = :id_medicamento";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':id_medicamento', $id, PDO::PARAM_INT);
            return $stmt->execute(); // Retorna true si la operación fue exitosa
        } catch (PDOException $e) {
            echo "Error al actualizar el medicamento: " . $e->getMessage();
            return false; // Retorna false si ocurrió un error
        }
    }
}
?>


<?php
include_once 'conexion.php'; // Asegúrate de que esta ruta sea correcta

class Medicamento {

    // Obtener todos los medicamentos
    public static function obtenerTodos() {
        try {
            $conn = conectar(); // Usar la función conectar que ya tienes definida
            $stmt = $conn->query("SELECT * FROM medicamentos");
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Para PDO, usamos fetchAll
        } catch (PDOException $e) {
            echo "Error al obtener los medicamentos: " . $e->getMessage();
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
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al agregar el medicamento: " . $e->getMessage();
        }
    }

    // Eliminar un medicamento por ID
    public static function eliminar($id) {
        try {
            $conn = conectar();
            $sql = "DELETE FROM medicamentos WHERE id_medicamento = :id_medicamento";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_medicamento', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar el medicamento: " . $e->getMessage();
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
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el medicamento: " . $e->getMessage();
        }
    }
}
?>

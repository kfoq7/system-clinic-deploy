<?php
require_once '../util/conexion.php';

class NotificacionDAO
{
    public static function obtenerMensajes()
    {
        try {
            $conn = conectar();
            $sql = "SELECT id_cita, id_paciente, fecha_cita, hora_cita FROM citas ORDER BY id_cita DESC LIMIT 5";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener mensajes: " . $e->getMessage());
            return [];
        }
    }

    public static function contarMensajes()
    {
        try {
            $conn = conectar();
            $sql = "SELECT COUNT(*) AS total FROM citas";
            $stmt = $conn->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log("Error al contar mensajes: " . $e->getMessage());
            return 0;
        }
    }
}
?>

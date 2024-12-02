<?php
include_once '../util/conexion.php'; 
class HistorialMedicoDAO
{
    // Obtener todos los historiales médicos
    public static function getAllHistorialMedico()
    {
        try {
            $conn = conectar(); // Usar la función conectar() para obtener la conexión PDO
            $sql = "SELECT * FROM historial_medico";
            $stmt = $conn->query($sql); // Ejecutar la consulta
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los resultados como array asociativo
        } catch (PDOException $e) {
            echo "Error al obtener los historiales médicos: " . $e->getMessage();
        }
    }

    // Obtener historial médico por nombre o fecha
    public static function getHistorialMedicoByNameOrDate($name, $date)
    {
        try {
            $conn = conectar(); // Usar la conexión PDO
            $sql = "CALL GetHistorialByPacienteOrFecha(:name, :date)"; // Usar la llamada al procedimiento almacenado

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR); // Vincular el parámetro 'name'
            $stmt->bindParam(':date', $date, PDO::PARAM_STR); // Vincular el parámetro 'date'
            $stmt->execute(); // Ejecutar la consulta

            // Obtener el conjunto de resultados
            $historiales = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $historiales;
        } catch (PDOException $e) {
            echo "Error al obtener historial médico: " . $e->getMessage();
        }
    }
}

<?php
require_once '../util/conexion.php'; // Asegúrate de que la ruta sea correcta

class CitaModel {
    private $db;

    public function __construct() {
        $this->db = $this->conectar();
    }

    private function conectar() {
        $link = 'mysql:host=localhost;dbname=bd_clinicaa';
        $usuario = 'root';
        $pass = 'root';
        try {
            $conn = new PDO($link, $usuario, $pass);
            return $conn;
        } catch (PDOException $e) {
            echo "¡Error en la conexión!: " . $e->getMessage();
            return null;
        }
    }

    public function obtenerCitas($fecha)
    {
        $stmt = $this->db->prepare("CALL obtener_lista_citas(?)");
        $dateFilter = $fecha === '' ? null : $fecha;
        $stmt->execute([$dateFilter]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarCita($fecha, $hora, $paciente_id, $medico_id, $turno_c)
    {
        $stmt = $this->db->prepare("CALL registrar_cita(?, ?, ?, ?, ?)");
        return $stmt->execute([$fecha, $hora, $paciente_id, $medico_id, $turno_c]);
    }

    public function obtenerCitaPorFecha($fecha)
    {
        $dateFilter = $fecha === '' ? null : $fecha;
        $stmt = $this->db->prepare('CALL obtener_lista_citas(?)');
        $stmt->execute([$dateFilter]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function contarCitasPendientes() {
        $sql = "SELECT COUNT(*) as total FROM citas WHERE fecha_cita >= CURDATE()";
        $stmt = $this->conectar()->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    
    
    public function contarTotalCitas() {
        $sql = "SELECT COUNT(*) as total FROM citas"; // Sin filtro de fecha
        $stmt = $this->conectar()->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function obtenerNombrePaciente($idPaciente)
{
    try {
        $conn = conectar();
        $sql = "SELECT nombre FROM pacientes WHERE id_paciente = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $idPaciente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn(); // Devuelve el nombre del paciente
    } catch (PDOException $e) {
        error_log("Error al obtener el nombre del paciente: " . $e->getMessage());
        return "Desconocido";
    }

}
}

?>

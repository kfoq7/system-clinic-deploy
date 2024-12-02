<?php

require_once'../util/conexion.php'; // Asegúrate de incluir la conexión

class MedicoControlador {
    private $pdo;

    public function __construct() {
        $this->pdo = conectar(); // Asume que esta función devuelve una conexión PDO válida
    }

    public function crearMedico($nombre, $especialidad, $telefono) {
        $stmt = $this->pdo->prepare("CALL CrearMedico(:nombre, :especialidad, :telefono)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':especialidad', $especialidad);
        $stmt->bindParam(':telefono', $telefono);
        return $stmt->execute();
    }

    public function obtenerMedicos() {
        $stmt = $this->pdo->query("CALL ObtenerMedicos()");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerMedicoPorID($id) {
        $stmt = $this->pdo->prepare("CALL ObtenerMedicoPorID(:id)");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarMedico($id, $nombre, $especialidad, $telefono) {
        $stmt = $this->pdo->prepare("CALL ActualizarMedico(:id, :nombre, :especialidad, :telefono)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':especialidad', $especialidad);
        $stmt->bindParam(':telefono', $telefono);
        return $stmt->execute();
    }

    public function eliminarMedico($id) {
        $stmt = $this->pdo->prepare("CALL EliminarMedico(:id)");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>

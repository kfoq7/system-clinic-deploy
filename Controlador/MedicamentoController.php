<?php
require_once '../DAO/MedicamentoDAO.php';

class MedicamentoControlador {
    
    // Obtener todos los medicamentos
    public function index() {
        return MedicamentoDAO::obtenerTodos(); // Retorna todos los medicamentos como un array
    }

    // Obtener un medicamento por ID
    public function obtenerMedicamentoPorId($id) {
        return MedicamentoDAO::obtenerMedicamentoPorId($id); // Retorna un medicamento específico
    }

    // Agregar un nuevo medicamento
    public function agregar($nombre, $descripcion, $tipo, $precio, $cantidad) {
        return MedicamentoDAO::agregar($nombre, $descripcion, $tipo, $precio, $cantidad); // Retorna true/false según éxito
    }

    // Eliminar un medicamento por ID
    public function eliminar($id) {
        return MedicamentoDAO::eliminar($id); // Retorna true/false según éxito
    }

    // Editar un medicamento
    public function editar($id, $nombre, $descripcion, $tipo, $precio, $cantidad) {
        return MedicamentoDAO::editar($id, $nombre, $descripcion, $tipo, $precio, $cantidad); // Retorna true/false según éxito
    }
}
?>
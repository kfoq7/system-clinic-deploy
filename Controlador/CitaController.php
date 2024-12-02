<?php
require_once '../DAO/CitaModelDAO.php';

class CitaController
{
    private $model;

    public function __construct()
    {
        $this->model = new CitaModelDAO();
    }

    public function index($fecha)
    {
        $citas = $this->model->obtenerCitas($fecha);
        require '../Vista/citas_view.php';
    }

    public function obtenerCitaPorFecha($fecha)
    {
        $citas = $this->model->obtenerCitaPorFecha($fecha);
        return $citas;
    }
    public function obtenerCitasPendientes() {
        return $this->model->contarCitasPendientes();
    }
    public function obtenerTotalCitas() {
        return $this->model->contarTotalCitas();
    }
    
    
    

    public function guardarCita()
    {
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $paciente_id = $_POST['paciente_id'];
        $medico_id = $_POST['medico_id'];
        $turno = $_POST['turno'];

        // Guardar la cita en la base de datos
        $this->model->agregarCita($fecha, $hora, $paciente_id, $medico_id, $turno);

        // Crear un mensaje de notificación
        $pacienteNombre = $this->model->obtenerNombrePaciente($paciente_id); // Método para obtener el nombre del paciente
        $mensaje = "Paciente $pacienteNombre tiene una cita programada para el día $fecha a las $hora.";

        // Guardar el mensaje en la sesión para mostrarlo en el dashboard
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['mensajes'][] = $mensaje;

        // Redirigir al listado de citas
        header("Location: ../Vista/citas_view.php");
        exit;
    }
}

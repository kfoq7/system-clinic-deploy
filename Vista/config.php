<?php
// Requiere el controlador de citas
require '../Controlador/CitaController.php';

// Instanciamos el controlador
$controller = new CitaController();

// Control de rutas basado en la solicitud
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'guardarCita') {
    // Si es una solicitud POST y la acción es guardarCita, ejecuta el método guardarCita
    $controller->guardarCita();
} else {
    // De lo contrario, ejecuta el método index para mostrar todas las citas
    $controller->index(null); // Llamamos index con null como valor predeterminado para $fecha
}

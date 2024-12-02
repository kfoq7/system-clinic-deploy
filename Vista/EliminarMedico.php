<?php
include_once '../Controlador/MedicoControler.php'; 

$controlador = new MedicoControlador();


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($controlador->eliminarMedico($id)) {
        echo "<script>alert('Médico eliminado con éxito.'); window.location.href='indexMedico.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error al eliminar el médico.'); window.location.href='indexMedico.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID de médico no especificado.'); window.location.href='indexMedico.php';</script>";
    exit();
}
?>

<?php
require_once '../DAO/NotificacionDAO.php';

class NotificacionesController
{
    public static function obtenerMensajes()
    {
        return NotificacionDAO::obtenerMensajes();
    }

    public static function contarMensajes()
    {
        return NotificacionDAO::contarMensajes();
    }
}
?>

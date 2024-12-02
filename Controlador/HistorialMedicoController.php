<?php
require_once '../DAO/HistorialMedicoDAO.php';

class HistorialMedicoController
{
  public function getAllHistorialMedico()
  {
    return HistorialMedicoDAO::getAllHistorialMedico();
  }

  public function getHistorialMedicoByNameOrDate($name, $date)
  {
    $dateFilter = $date === '' ? NULL : $date;

    return HistorialMedicoDAO::getHistorialMedicoByNameOrDate($name, $dateFilter);
  }
}

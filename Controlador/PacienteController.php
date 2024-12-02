<?php
include_once __DIR__ . '/../DAO/PacienteDAO.php';

class PacienteController
{
  public function getAllPacientes()
  {
    return PacienteDAO::getAllPacientes();
  }

  public function getPacienteById($pacienteId)
  {
    return PacienteDAO::getPacienteById($pacienteId);
  }

  public function agregar(
    $nombre,
    $direccion,
    $fecha_nacimiento,
    $distrito,
    $email,
  ) {
    return PacienteDAO::agregar(
      $nombre,
      $direccion,
      $fecha_nacimiento,
      $distrito,
      $email
    );
  }

  public function updatePaciente($codigo, $nombre, $direccion, $fecha_nacimiento, $distrito, $email)
  {
    return PacienteDAO::actualizar(
      $codigo,
      $nombre,
      $direccion,
      $fecha_nacimiento,
      $distrito,
      $email
    );
  }

  public function deletePaciente($id)
  {
    return PacienteDAO::eliminar($id);
  }

  public  function getPacienteByIdOrNameOrDistrict($id, $nombre, $distrito)
  {
    $idFilter =  $id === '' ? null : $id;
    $distritoId =  $distrito === '' ? null : $distrito;

    return PacienteDAO::getPacienteByIdOrNameOrDistrict($idFilter, $nombre, $distritoId);
  }
}

<?php
include_once '../util/conexion.php';

class PacienteDAO
{
  public static function getAllPacientes()
  {
    try {
      $conn = conectar();

      $sql =  "CALL sp_listar_paciente()";
      $stmt = $conn->query($sql);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error al obtener los Pacientes: " . $e->getMessage();
    }
  }

  public static function getPacienteById($pacienteId)
  {
    try {
      $conn = conectar();

      $sql = "CALL sp_obtenerPacientePorId(:pacienteId)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':pacienteId', $pacienteId);
      $stmt->execute();

      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error al obtener Paciente: " . $e->getMessage();
    }
  }

  public static function agregar($nombre, $direccion, $fecha_nacimiento, $distrito, $email)
  {
    try {
      $conn = conectar();

      $sql = "CALL sp_insertarPaciente(:nombre, :direccion, :fecha_nacimiento, :codigo_distrito, :email)";
      $stmt = $conn->prepare($sql);

      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':direccion', $direccion);
      $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
      $stmt->bindParam(':codigo_distrito', $distrito);
      $stmt->bindParam(':email', $email);

      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error al agregar Paciente: " . $e->getMessage();
    }
  }

  public static function actualizar($id, $nombre, $direccion, $fecha_nacimiento, $distrito, $email)
  {
    try {
      $conn = conectar();

      $sql = "CALL sp_actualizarPaciente(:id, :nombre, :direccion, :fecha_nacimiento, :codigo_distrito, :email)";
      $stmt = $conn->prepare($sql);

      $stmt->bindParam(':id', $id);
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':direccion', $direccion);
      $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
      $stmt->bindParam(':codigo_distrito', $distrito);
      $stmt->bindParam(':email', $email);

      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error al actualizar Paciente: " . $e->getMessage();
    }
  }

  public static function eliminar($id)
  {
    try {
      $conn = conectar();

      $sql = "CALL sp_eliminarPaciente(:id)";
      $stmt = $conn->prepare($sql);

      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error al eliminar Paciente: " . $e->getMessage();
    }
  }

  public static function getPacienteByIdOrNameOrDistrict($id, $nombre, $distrito)
  {
    try {
      $conn = conectar();

      $sql = "CALL sp_filtrarPaciente(:id, :nombre, :distrito)";
      $stmt = $conn->prepare($sql);

      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $stmt->bindParam(':distrito', $distrito, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error al obtener Paciente: " . $e->getMessage();
    }
  }
}

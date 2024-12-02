<?php
include_once 'conexion.php';

class Distrito
{
  public static function getAllDistritos()
  {
    try {
      $conn = conectar();

      $sql = "CALL sp_obtenerDistritos()";
      $stmt = $conn->query($sql);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error al obtener los Distritos: " . $e->getMessage();
    }
  }
}

<?php
include_once __DIR__ . '/../DAO/DistritoDAO.php';

class DistritoController
{
  public function getAllDistritos()
  {
    return DistritoDAO::getAllDistritos();
  }
}

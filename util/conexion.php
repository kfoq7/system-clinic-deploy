<?php
$link = 'mysql:host=localhost;dbname=u333212663_bd_clinicaa;charset=utf8mb4';
$usuario = 'u333212663_root';
$pass = '@$+>m^3Mt';

function conectar() {
    global $link, $usuario, $pass;

    try {
        $conn= new PDO($link, $usuario, $pass);
        return $conn; 
    } catch (PDOException $e) {
        echo "¡Error en la conexión!: " . $e->getMessage() . "<br>";
        return null; 
    }
}
?> 
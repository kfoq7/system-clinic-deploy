<?php

include_once '../util/conexion.php';

class UsuarioDAO {

    private $conn;

    public function __construct() {
        $this->conn = conectar();
    }

    // Método para registrar un usuario
    public function registrar($nombre, $email, $password) {
        try {
            if (empty($nombre) || empty($email) || empty($password)) {
                throw new Exception("Todos los campos son obligatorios.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("El formato del email no es válido.");
            }

            // Cifrar la contraseña antes de guardarla
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Consulta SQL para insertar un nuevo usuario
            $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
            $stmt = $this->conn->prepare($sql);

            // Bind de los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            // Ejecutar la consulta
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en el registro: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Error de validación: " . $e->getMessage());
            return false;
        }
    }

    // Método para hacer login
    public function login($email, $password) {
        try {
            if (empty($email) || empty($password)) {
                throw new Exception("Todos los campos son obligatorios.");
            }

            // Consulta SQL para verificar el usuario
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);

            // Ejecutar la consulta
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            // $usuario  = $stmt->execute();
            // $result = $stmt->get_result();
            // $usuario = $result->fetch_assoc();

            // Verificar si el usuario existe y la contraseña es correcta
            if ($usuario && password_verify($password, $usuario['password'])) {
                return $usuario;
            } else {
                throw new Exception("Credenciales incorrectas.");
            }
        } catch (PDOException $e) {
            error_log("Error en el login: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Error de validación: " . $e->getMessage());
            return false;
        }
    }
}

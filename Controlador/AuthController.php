<?php
require_once '../DAO/UsuarioDAO.php';

class AuthController {

    private $usuario;

    public function __construct() {
        $this->usuario = new UsuarioDAO();
    }

    // Acción de registrar
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Llama al método registrar del modelo
            if ($this->usuario->registrar($nombre, $email, $password)) {
                // Redirigir a la página de login después de registro exitoso
                header('Location: ../Vista/Intranet.html'); // Ruta a la página de login
                exit();
            } else {
                echo "Error en el registro. Por favor, intente de nuevo.";
            }
        }
    }

    // Acción de login
   
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
    
            $usuario = $this->usuario->login($email, $password);
    
            if ($usuario) {
                // Iniciar sesión y guardar los datos en la sesión
                session_start();
                $_SESSION['usuario'] = [
                    'id_usuario' => $usuario['id_usuario'],
                    'nombre' => $usuario['nombre'],
                    'email' => $usuario['email']
                ];
    
                // Redirigir al dashboard
                header('Location: ../Vista/index.php');
                exit();
            } else {
                echo "Credenciales incorrectas. Por favor, intente de nuevo.";
            }
        }
    }
}

// Verificar la acción solicitada
if (isset($_GET['action'])) {
    $authController = new AuthController();

    if ($_GET['action'] == 'register') {
        $authController->registrar();
    } elseif ($_GET['action'] == 'login') {
        $authController->login();
    }
}

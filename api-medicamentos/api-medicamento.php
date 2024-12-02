<?php
require_once '../Controlador/MedicamentoController.php';

// Configuración de cabeceras para la API
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD']; // Método HTTP (GET, POST, PUT, DELETE)
$controlador = new MedicamentoControlador();

try {
    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $medicamento = $controlador->obtenerMedicamentoPorId($id);
                echo json_encode($medicamento);
            } else {
                $medicamentos = $controlador->index();
                echo json_encode($medicamentos);
            }
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['nombre'], $data['descripcion'], $data['tipo'], $data['precio'], $data['cantidad'])) {
                $resultado = $controlador->agregar(
                    $data['nombre'],
                    $data['descripcion'],
                    $data['tipo'],
                    $data['precio'],
                    $data['cantidad']
                );
                if ($resultado) {
                    echo json_encode(["message" => "Medicamento creado exitosamente"]);
                } else {
                    http_response_code(500);
                    echo json_encode(["error" => "Error al crear el medicamento"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Faltan datos requeridos para crear el medicamento."]);
            }
            break;

        case 'PUT':
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $data = json_decode(file_get_contents('php://input'), true);
                if (isset($data['nombre'], $data['descripcion'], $data['tipo'], $data['precio'], $data['cantidad'])) {
                    $resultado = $controlador->editar(
                        $id,
                        $data['nombre'],
                        $data['descripcion'],
                        $data['tipo'],
                        $data['precio'],
                        $data['cantidad']
                    );
                    if ($resultado) {
                        echo json_encode(["message" => "Medicamento actualizado"]);
                    } else {
                        http_response_code(500);
                        echo json_encode(["error" => "Error al actualizar el medicamento"]);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Faltan datos para actualizar el medicamento."]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["error" => "ID no proporcionado para actualizar el medicamento."]);
            }
            break;

        case 'DELETE':
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $resultado = $controlador->eliminar($id);
                if ($resultado) {
                    echo json_encode(["message" => "Medicamento eliminado"]);
                } else {
                    http_response_code(500);
                    echo json_encode(["error" => "Error al eliminar el medicamento"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["error" => "ID no proporcionado para eliminar el medicamento."]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido"]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}

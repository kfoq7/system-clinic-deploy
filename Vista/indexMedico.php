<?php
session_start(); 

include_once '../Controlador/MedicoControler.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnregistrar'])) {
    $controlador = new MedicoControlador();
    $nombre = $_POST['nombre_medico'];
    $especialidad = $_POST['especialidad'];
    $telefono = $_POST['telefono_contacto'];

    
    if ($controlador->crearMedico($nombre, $especialidad, $telefono)) {
        $_SESSION['mensaje'] = "Médico agregado exitosamente.";
        header("Location: ./indexMedico.php");
        exit();
    } else {
        echo "Error al agregar médico.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Médicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styleMedico.css">
    
</head>
<body>
        
    <h1 class="text-center p-3">Gestión de Médicos</h1>
    
    <div class="d-flex justify-content-end">
    <a href="index.php" class="btn btn-danger">Salir</a>
    </div>


    <div class="container-fluid row">
        <!-- Formulario de registro -->
        <form class="col-4 p-3" method="POST" action="">
            <h3 class="text-center text-secondary">Nuevo Médico</h3>
            <div class="mb-3">
                <label for="nombre_medico" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre_medico" name="nombre_medico" required>
            </div>
            <div class="mb-3">
                <label for="especialidad">Especialidad</label>
                <input type="text" class="form-control" name="especialidad" required>
            </div>
            <div class="mb-3">
                <label for="telefono_contacto">Teléfono de Contacto</label>
                <input type="text" class="form-control" name="telefono_contacto" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="btnregistrar" value="ok">Registrar</button>
        </form>

        <!-- Barra de búsqueda y tabla de médicos -->
        <div class="col-8 p-4">
            <div class="mb-3">
                <input type="text" id="buscar" class="form-control" placeholder="Buscar por nombre de médico...">
            </div>
            <table class="table" id="tablaMedicos">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">ID Médico</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Teléfono de Contacto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    require_once'../Controlador/MedicoControler.php';
                    $controlador = new MedicoControlador();
                    $medicos = $controlador->obtenerMedicos();
                    foreach ($medicos as $medico): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($medico['id_medico']); ?></td>
                            <td><?php echo htmlspecialchars($medico['nombre_medico']); ?></td>
                            <td><?php echo htmlspecialchars($medico['especialidad']); ?></td>
                            <td><?php echo htmlspecialchars($medico['telefono_contacto']); ?></td>
                            <td>
                                <a href="ActualizarMedico.php?id=<?php echo $medico['id_medico']; ?>" class="btn btn-warning">Actualizar</a>
                                <a href="EliminarMedico.php?id=<?php echo $medico['id_medico']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este médico?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>

    <script>
        // Filtrado de la tabla de médicos por nombre
        document.getElementById('buscar').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tablaMedicos tbody tr');

            rows.forEach(row => {
                let nombreMedico = row.cells[1].textContent.toLowerCase();
                if (nombreMedico.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
    
</body>
</html>

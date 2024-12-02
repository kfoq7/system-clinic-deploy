<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple" rel="stylesheet">
    
    <style>
        body {
            background-color: #e6f0fa;
            font-family: 'Rancho&effect';
            font-weight: 300;
            color: #333;
        }

        h1 {
            color: #005b96;
            font-weight: 600;
            font-size: 2.5rem;
            letter-spacing: 1px;
        }

        h3 {
            color: #0275d8;
            font-weight: 500;
            font-size: 1.8rem;
            text-align: center;
        }

        label {
            font-size: 1.1rem;
            font-weight: 500;
            color: #005b96;
        }

        form {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f5f5f5;
            font-size: 1rem;
            padding: 12px;
        }

        .btn-primary {
            background-color: #0275d8;
            border: none;
            font-size: 1.1rem;
            padding: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background-color: #025aa5;
        }

        .table th {
            background-color: #0275d8;
            color: white;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .table tbody tr:hover {
            background-color: #eaf3fa;
        }

        .btn-warning {
            color: white;
            background-color: #f0ad4e;
        }

        .btn-warning:hover {
            background-color: #ec971f;
        }

        .btn-danger {
            color: white;
            background-color: #d9534f;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        .container-fluid {
            padding: 20px;
        }

        .table {
            margin-top: 20px;
        }

        body, table, form, h1, h3 {
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

    <h1 class="text-center p-3">Registrar Historial Médico</h1>

    <div class="d-flex justify-content-end">
    <a href="index.php" class="btn btn-danger">Salir</a>
    </div>

    <div class="container-fluid row">
        <form id="form-historial" class="col-4 p-3" method="POST" action="crear_historial.php">
            <h3 class="text-center text-secondary">Historial Médico</h3>

            <!-- Campos del formulario -->
            <div class="mb-3">
                <label for="id_paciente" class="form-label">ID Paciente</label>
                <input type="number" class="form-control" id="id_paciente" name="id_paciente" required>
            </div>
            <div class="mb-3">
                <label for="id_medico">ID Médico</label>
                <input type="number" class="form-control" id="id_medico" name="id_medico" required>
            </div>
            <div class="mb-3">
                <label for="fecha_visita">Fecha de Visita</label>
                <input type="date" class="form-control" id="fecha_visita" name="fecha_visita" required>
            </div>
            <div class="mb-3">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="diagnostico">Diagnóstico</label>
                <textarea id="diagnostico" name="diagnostico" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="tratamiento">Tratamiento</label>
                <textarea id="tratamiento" name="tratamiento" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="btnregistrar" value="ok">Registrar</button>
        </form>

        <div class="col-8 p-4">
            <table class="table" id="tabla-historial">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">ID Historial</th>
                        <th scope="col">ID Paciente</th>
                        <th scope="col">ID Médico</th>
                        <th scope="col">Fecha Visita</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Diagnóstico</th>
                        <th scope="col">Tratamiento</th>
                        <th scope="col">Actualizar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("../util/conexion.php");
                        $conn = conectar(); 
                        try {
                            $stmt = $conn->query("SELECT * FROM historial_medico");
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);

                            if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row["id_historial"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["id_paciente"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["id_medico"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["fecha_visita"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["descripcion"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["diagnostico"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["tratamiento"]) . "</td>";
                                    echo "<td>
                                        <a href='actualizar_historial.php?id=" . htmlspecialchars($row["id_historial"]) . "' class='btn btn-warning'>
                                            <i class='fa fa-pencil-square-o' aria-hidden='true'></i> Actualizar
                                        </a>
                                    </td>";
                                    echo "<td>
                                        <a href='eliminar_historial.php?id=" . htmlspecialchars($row["id_historial"]) . "' class='btn btn-danger' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este registro?');\">
                                            <i class='fa fa-trash' aria-hidden='true'></i> Eliminar
                                        </a>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center'>No se encontraron historiales</td></tr>";
                            }
                        } catch (PDOException $e) {
                            echo "<tr><td colspan='9' class='text-center'>Error al obtener datos: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                        }
                    ?>
                </tbody>
                </table>
        </div>
    </div>
    <script>
    document.getElementById("form-historial").addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch("../Controlador/guardar_historial.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                // Agregar la nueva fila a la tabla
                const nuevoRegistro = data.data;
                const nuevaFila = `
                    <tr>
                        <td>${nuevoRegistro.id_historial}</td>
                        <td>${nuevoRegistro.id_paciente}</td>
                        <td>${nuevoRegistro.id_medico}</td>
                        <td>${nuevoRegistro.fecha_visita}</td>
                        <td>${nuevoRegistro.descripcion}</td>
                        <td>${nuevoRegistro.diagnostico}</td>
                        <td>${nuevoRegistro.tratamiento}</td>
                        <td>
                            <a href="actualizar_historial.php?id=${nuevoRegistro.id_historial}" class="btn btn-warning">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Actualizar
                            </a>
                        </td>
                        <td>
                            <a href="eliminar_historial.php?id=${nuevoRegistro.id_historial}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                <i class="fa fa-trash" aria-hidden="true"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                `;
                document.querySelector("#tabla-historial tbody").insertAdjacentHTML("beforeend", nuevaFila);
                
                // Limpiar el formulario
                document.getElementById("form-historial").reset();
                alert("Historial registrado con éxito.");
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error al registrar el historial.");
        });
    });
</script>

</body>
</html>
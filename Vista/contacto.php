<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contáctanos</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
  <header>
    <h1>Contáctanos</h1>
    <nav>
      <ul>
        <li><a href="index.php">Inicio</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section>
      <h2>Estamos aquí para ayudarte</h2>
      <p>Si tienes alguna pregunta o consulta, por favor completa el siguiente formulario y nos pondremos en contacto contigo lo antes posible.</p>
    </section>

    <section>
      <h2>Formulario de Contacto</h2>
      <form action="enviar_contacto.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

        <button type="submit">Enviar</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 Nuestra Empresa. Todos los derechos reservados.</p>
  </footer>
</body>

</html>
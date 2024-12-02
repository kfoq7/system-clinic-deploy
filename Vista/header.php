<header>
  <div class="header-container">
    <div class="logo">
      <img src="../public/logo.webp" alt="Logo de la empresa" height="80"> <!-- Asegúrate de cambiar 'logo.png' al nombre real de tu archivo de logo -->
    </div>
    <nav class="navbar">
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="lista-pacientes.php">Listado de Paciente</a></li>
        <li><a href="insertar-paciente.php">Insertar Paciente</a></li>
        <li><a href="consultar-por-distrito.php">Consulta x Distrito</a></li>
      
      </ul>
    </nav>
  </div>
</header>

<style>
  /* Estilos básicos para el encabezado */
  .header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #004080;
    color: white;
  }

  .logo img {
    height: 60px;
    /* Puedes ajustar el tamaño del logo según sea necesario */
  }

  .navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 20px;
  }

  .navbar ul li {
    display: inline;
  }

  .navbar ul li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
  }

  .navbar ul li a:hover {
    color: #ffcc00;
  }
</style>
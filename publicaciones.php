<?php include 'db.php'; ?>
<?php include 'navbar.php'; ?>

<br><br>
<div class="container mt-4">
    <!-- Título del apartado -->
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h3 class=" me-3">Publicaciones</h3> <!-- Título con un color -->
        
        <!-- Botón verde -->
        <a href="crear_publicacion.php" class="btn btn-success">
            Crear Publicacion
        </a>
    </div>
</div>



<ul>
    <?php
    // Consulta las publicaciones
    $sql = "SELECT * FROM publicacion ORDER BY fechaPublicacion DESC";
    $resultado = $conexion->query($sql);
    while ($row = $resultado->fetch_assoc()) {
        // Mostrar la tarjeta para cada publicación
        echo '<div class="container mt-5">
                <div class="card">
                    <!-- Usuario y fecha -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">';

                        // Comprobamos si existe una imagen del usuario en la base de datos
                        $sql0 = "SELECT imagenPerfil FROM Bombero WHERE idBombero = {$row['idBombero']}";
                        $resultado0 = $conexion->query($sql0);
                        $row0 = $resultado0->fetch_assoc();
                        $userImage = isset($row0['imagenPerfil']) && !empty($row0['imagenPerfil']) ? $row0['imagenPerfil'] : 'images/bombero_icono.png'; // Imagen por defecto si no existe
                        
                        echo '<img src="' . $userImage . '" alt="Usuario" class="rounded-circle me-2" width="40" height="40">
                              <strong>Armando Paredes</strong>
                        </div>
                        <small class="text-muted">' . $row['fechaPublicacion'] . '</small>
                    </div>

                    <!-- Título y contenido -->
                    <div class="card-body">
                        <h5 class="card-title">' . $row['Titulo'] . '</h5>
                        <p class="card-text">
                            ' . $row['Descripcion'] . '
                        </p>
                    </div>';

                    // Verificar si hay imágenes asociadas
                    echo '<div class="card-footer">';
                    $sql2 = "SELECT * FROM imagenpublicacion WHERE idPublicacion = {$row['idPublicacion']}";
                    $resultado2 = $conexion->query($sql2);
                    while ($row2 = $resultado2->fetch_assoc()) {
                        echo '<div class="row">
                                <div class="col-6 col-md-4 mb-2">
                                    <img src="' . $row2['imagenRuta'] . '" alt="Imagen" class="img-fluid">
                                </div>
                              </div>';
                    }
                    echo '</div>'; // Cierre del card-footer
        echo '</div>'; // Cierre del card
    }
    ?>
</ul>

<!-- Bootstrap JS y dependencias -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

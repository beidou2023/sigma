<?php include 'db.php'; ?>
<?php include 'navbar.php'; ?>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastSuccess" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Publicación guardada con éxito.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header --bs-dark-bg-subtle      text-center">
                <h2>Nueva Publicación</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input id="titulo" type="text" name="titulo" class="form-control" placeholder="Ingrese el título" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" rows="4" placeholder="Ingrese la descripción" required></textarea>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="donacionSwitch" name="donacionSwitch" data-bs-toggle="collapse" data-bs-target="#campoMonto">
                        <label class="form-check-label" for="donacionSwitch">Con donación</label>
                    </div>
                    
                    <div class="collapse mt-3" id="campoMonto">
                        <label for="monto" class="form-label">Monto de la Donación</label>
                        <input type="number" class="form-control" id="monto" name="monto" placeholder="Ingrese el monto">
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="guardar" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    


<?php
if (isset($_POST['guardar'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tipo = isset($_POST['donacionSwitch']) ? 1 : 0;
    $monto = isset($_POST['monto']) ? $_POST['monto'] : NULL;

    if ($tipo == 1 && empty($monto)) {
        echo '<div class="alert alert-danger text-center mt-3">El campo Monto es obligatorio para donaciones.</div>';
    } else {
        $sql = "INSERT INTO Publicacion (Titulo, Descripcion, Publicacioncol, idBombero, fechaPublicacion, monto) ";
        $sql .= "VALUES ('$titulo', '$descripcion', NULL, 3, NOW(), " . ($monto === NULL ? "NULL" : "'$monto'") . ")";
        
        if ($conexion->query($sql)) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var toast = new bootstrap.Toast(document.getElementById("toastSuccess"));
                        toast.show();
                        setTimeout(function() {
                            window.location.href = "publicaciones.php";
                        }, 800);
                    });
                  </script>';

        } else {
            echo '<div class="alert alert-danger text-center mt-3">Error: ' . $conexion->error . '</div>';
        }
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

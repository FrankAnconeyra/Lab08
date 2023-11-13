<?php include 'template/header.php' ?>
<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from libro");
    $libro = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($libro);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <!-- inicio alerta -->
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaro el libro.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <!-- fin alerta -->
            <div class="card">
                <div class="card-header">
                    Listado de Libros
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre del libro</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Fecha de publicacion</th>
                                <th scope="col">Celular</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                foreach($libro as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->id; ?></td>
                                <td><?php echo $dato->nombreLibro; ?></td>
                                <td><?php echo $dato->genero; ?></td>
                                <td><?php echo $dato->autor; ?></td>
                                <td><?php echo $dato->fechaPublicacion; ?></td>
                                <td><?php echo $dato->serie; ?></td>
                                <td><a class="text-success" href="editar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a class="text-primary" href="agregarPromocion.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-cursor"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-trash"></i></a></td>
                            </tr>

                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Ingresar datos:
        </div>
        <form class="p-4" method="POST" action="registrar.php">
            <div class="mb-3">
                <label for="txtnombreLibro" class="form-label">Nombre del libro:</label>
                <input type="text" class="form-control" id="txtnombreLibro" name="txtnombreLibro" autofocus required>
            </div>
            <div class="mb-3">
                <label for="txtGenero" class="form-label">Género:</label>
                <input type="text" class="form-control" id="txtGenero" name="txtGenero" autofocus required>
            </div>
            <div class="mb-3">
                <label for="txtAutor" class="form-label">Autor:</label>
                <input type="text" class="form-control" id="txtAutor" name="txtAutor" autofocus required>
            </div>
            <div class="mb-3">
                <label for="txtFechaPublicacion" class="form-label">Fecha de publicación:</label>
                <input type="date" class="form-control" id="txtFechaPublicacion" name="txtFechaPublicacion" autofocus required>
            </div>
            <div class="mb-3">
                <label for="txtSerie" class="form-label">Reserva(Celular):</label>
                <input type="number" class="form-control" id="txtSerie" name="txtSerie" autofocus required>
            </div>
            <div class="d-grid">
                <input type="hidden" name="oculto" value="1">
                
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>
</div>


<?php include 'template/footer.php' ?>
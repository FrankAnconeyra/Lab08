<?php
    print_r($_POST);
    if (!isset($_POST['codigo'])) {
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $nombreLibro = $_POST['txtnombreLibro'];
    $genero = $_POST['txtGenero'];
    $autor = $_POST['txtAutor'];
    $fechaPublicacion = $_POST['txtFechaPublicacion'];
    $serie = $_POST['txtSerie'];

    $sentencia = $bd->prepare("UPDATE libro SET nombreLibro = ?, genero = ?, autor = ?, fechaPublicacion = ?, serie = ? WHERE id = ?;");
    $resultado = $sentencia->execute([$nombreLibro, $genero, $autor, $fechaPublicacion, $serie, $codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
?>

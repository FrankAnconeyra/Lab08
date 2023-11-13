<?php
if (empty($_POST["oculto"]) || empty($_POST["txtnombreLibro"]) || empty($_POST["txtGenero"]) || empty($_POST["txtAutor"]) || empty($_POST["txtFechaPublicacion"]) || empty($_POST["txtSerie"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombreLibro = $_POST["txtnombreLibro"];
$genero = $_POST["txtGenero"];
$autor = $_POST["txtAutor"];
$fechaPublicacion = $_POST["txtFechaPublicacion"];
$serie = $_POST["txtSerie"];

$sentencia = $bd->prepare("INSERT INTO libro(nombreLibro,genero,autor,fechaPublicacion,serie) VALUES (?,?,?,?,?);");
$resultado = $sentencia->execute([ $nombreLibro, $genero, $autor, $fechaPublicacion, $serie]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}

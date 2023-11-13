<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_libro, per.nombreLibro , per.genero ,per.autor, per.serie , per.fechaPublicacion 
  FROM promociones pro 
  INNER JOIN libro per ON per.id = pro.id_libro 
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$libro = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance7103868131/SendMessage/de44cfd5dbf2416cbaf722bdc9e2b5d193b18dd2899e4e2a99';;
    $data = [
        "chatId" => "51".$libro->serie."@c.us",
        "message" =>  'Estimado(a) su reserva se realizo correctamente "*'.strtoupper($libro->nombreLibro).'" "'.strtoupper($libro->genero).'" "'.strtoupper($libro->autor).'*" No se pierda *'.strtoupper($libro->promocion).'* valido solo *'.$libro->duracion.'*'
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    header('Location: agregarPromocion.php?codigo='.$libro->id_libro);
?>

<?php

//incluimos ReadBeanPHP
require 'rb.php';
// Inicializamos la conexion al Servidor de MySQL
R::setup( 'mysql:host=localhost;dbname=galeria','root', '' ); 

$imgs = R::findAll( 'imagenes' );

echo "<ul>";
foreach( $imgs as $img ) {
    echo "<li>{$img->id}: {$img->descripcion}, Likes {$img->likes} </li>";
  }
 echo "</ul>"; 

?>

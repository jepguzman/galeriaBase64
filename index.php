<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen Base64</title>
</head>
<body>

<h1>Imagen Base64</h1>

<?php

//incluimos ReadBeanPHP
require 'rb.php';
// Inicializamos la conexion al Servidor de MySQL
R::setup( 'mysql:host=localhost;dbname=galeria','root', '' ); 

//Si se quiere subir una imagen
if (isset($_POST['subir'])) {
   //Recogemos el archivo enviado por el formulario
   $archivo = $_FILES['archivo']['name'];
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['archivo']['type'];
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];
      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
     if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || 
            strpos($tipo, "jpg") || strpos($tipo, "png")) && 
            ($tamano < 2000000))) 
        {
            echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
            - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        }
     else 
        {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
        if (move_uploaded_file($temp, 'images/'.$archivo)) 
        {
            //Mostramos el mensaje de que se ha subido co éxito
            echo '<div><b>Imagen codificada correctamente.</b></div>';
            // Ruta de la imagen (path)
            $path = "images/$archivo";
            // Extensión de la imagen
            $type = pathinfo($path, PATHINFO_EXTENSION);
            // Cargando la imagen
            $data = file_get_contents($path);
            // Decodificando la imagen en base64
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            // Mostrando la imagen ya en base64
            echo '<img src="'.$base64.'"/>';
            //Eliminando el archivo subido
            unlink($path); 
            //
            $img = R::dispense( 'imagenes' );
            $img->source = $base64;
            $img->descripcion = $path;
            $id = R::store( $img );
            //Cerramos la conexion a la BD
            R::close();
        }
        else 
        {
            //Si no se ha podido subir la imagen, mostramos un mensaje de error
            echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
        }
      }
   }
}
?>

<form action="index.php" method="POST" enctype="multipart/form-data"/>
    <h4>Elegir la imagen a subir: </h4>
    <input name="archivo" id="archivo" type="file"/>
    <input type="submit" name="subir" value="Subir imagen"/>
</form>

</body>
</html>

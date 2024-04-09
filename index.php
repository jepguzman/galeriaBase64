<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen Base64</title>
</head>
<body>

<h1>Imagen Base64</h1>

<form action="index.php" method="POST" enctype="multipart/form-data"/>
    <h4>Elegir la imagen a subir: </h4>
    <input name="archivo" id="archivo" type="file"/><br>
    Agrega una breve descripción de la imagen: 
    <textarea name="descripcion" id="descripcion" cols="40" rows="5"></textarea><br>
    <input type="submit" name="subir" value="Subir imagen"/>
</form>

</body>
</html>

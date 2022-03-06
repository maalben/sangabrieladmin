<?php foreach($consulta as $dato): ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Personas</title>
</head>
<body>

<h1>Entidad personas</h1>

<h2>Modificar personas</h2>
<form name="form1" method="POST" action="index.php?accion=guardarcambios">
<p>Id: <input type="text" name="txtid" id="txtid" value="<?php echo $dato["id"]; ?>" readonly></p>
<p>Nombre: <input type="text" name="txtnombre" id="txtnombre" value="<?php echo $dato["nombre"]; ?>"></p>
<p>Edad: <input type="text" name="txtedad" id="txtedad" value="<?php echo $dato["edad"]; ?>"></p>
<p><input type="submit" name="btnguardarcambios" value="Guardar Cambios"> &nbsp;&nbsp; <input type="button" name="btncancelar" value="Cancelar" onclick="javascript:location.href='index.php'"> </p>
</form>
</body>
</html>
<?php endforeach; ?>
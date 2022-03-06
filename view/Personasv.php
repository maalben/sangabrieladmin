<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Personas</title>
</head>
<body>

<h1>Entidad personas</h1>

<h2>Registro de personas</h2>
<form name="form1" method="POST" action="index.php?accion=guardar">

<p>Nombre: <input type="text" name="txtnombre" id="txtnombre"></p>
<p>Edad: <input type="text" name="txtedad" id="txtedad"></p>
<p><input type="submit" name="btnguardar" value="Guardar"></p>
</form>

<br>
<table>
    <thead> <!-- Encabezado de la tabla -->
        <tr> <!-- Fila -->
            <th>Id</th> <!-- Columnas-->
            <th>Nombre</th> <!-- Columnas-->
            <th>Edad</th> <!-- Columnas-->
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach($consulta as $dato): ?> 

        <tr>
            <td><?php echo $dato['id']; ?></td>
            <td><?php echo $dato['nombre']; ?></td>
            <td><?php echo $dato['edad']; ?></td>
            <td><a href="index.php?accion=modificar&id=<?php echo $dato['id']; ?>">Modificar</a></td>
            <td><a href="index.php?accion=eliminar&id=<?php echo $dato['id']; ?>">Eliminar</a></td>
        </tr>
        
    <?php endforeach; ?>

    </tbody>
</table>
    
</body>
</html>
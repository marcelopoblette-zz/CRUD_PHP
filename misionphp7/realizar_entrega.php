<!-- Incluir archivos requeridos -->
<?php
include ('sesion.php');
?>
<!DOCTYPE html> 
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Entregas</title>
    <link type="text/css" href="estilo.css" rel="stylesheet">

</head>

<body>
    <div class="contenedor">
        <div class= "encabezado">
            <div class="izq">

                <?php
                include ('conexion.php');

                $rut = $_SESSION["usuario"];
                $consulta="SELECT * FROM PERSONAL WHERE RUT ='$rut' ";
                $ejecutar= $mysqli ->query($consulta);

                $result = mysqli_fetch_array($ejecutar);
                $nom = $result['nombre'];
                $ape = $result['apellido'];
                ?>

                <p>Bienvenido/a:<br><!-- Agregar variable de sesi??n con nombre y apellido del usuario --><?php echo "$nom $ape"; ?></p>
            </div>

            <div class="centro">
                <a href=principalBodega.php><img src='imagenes/home.png'><br>Home</a>
            </div>
            
            <div class="derecha">
                <a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
            </div>
        </div>
        
        
        <br><h1 align='center'>PRODUCTOS EXISTENTES</h1><br>
        <?php
        include('conexion.php');

        $consulta="SELECT * FROM productos";
        $ejecutar=$mysqli -> query($consulta);
        
        echo "<table  width='80%' align='center'><tr>";               
        echo "<th width='10%'>CODIGO PRODUCTO</th>";
        echo "<th width='20%'>DESCRIPCIÓN</th>";
        echo "<th width='10%'>STOCK</th>";
        echo "<th width='20%'>PROVEEDOR</th>";
        echo "<th width='20%'>FECHA DE INGRESO</th>";
        echo  "</tr>"; 
        
        while($result=mysqli_fetch_array($ejecutar)){    
            
          echo "<tr>";                
          echo '<td width=10%>'.$result['cod_producto'].'</td>';
          echo '<td width=20%>'.$result['descripcion'].'</td>';
          echo '<td width=20%>'. $result['stock'].'</td>';
          echo '<td width=20%>'.$result['proveedor'].'</td>';
          echo '<td width=20%>'.$result['fecha_ingreso'].'</td>';
          echo "</tr>";
      }
      echo "</table></br>";
      ?>

      <form action="" method="post" align='center'>

        <div class="campo">
            <label name="rut">Rut personal que retira:</label>
            <input name='rut' type="text">
        </div>

        <div class="campo">
            <label name="cod">Código del producto:</label>
            <input name='codigo' type="text">
        </div>

        <div class="campo">
            <label name="cantd">Cantidad:</label>
            <input name='cantidad' type="text">
        </div>

        <div class="campo">
            <label name="cantd">Fecha entrega:</label>
            <input name='fecha' type="date">
        </div>
        
        <div class="botones">
            <input name='agregar' type="submit" value="Agregar">
            
             <!-- Verificar que la variable del boton submit este creada.
                Recuperar las variables con los datos ingresados. 
                Descontar la cantidad ingresada al stock existente del producto a retirar.
                Insertar los datos ingresados en la tabla "entregas" de la base de datos. 
                Redirigir el flujo a esta misma p??gina para visualizar la actualizaci??n del stock. -->
            <?php
            if (isset($_POST['agregar'])) {
                $rut = $_POST['rut'];
                $codigo = $_POST['codigo'];
                $cantidad = $_POST['cantidad'];
                $fecha = $_POST['fecha'];


                $consultaStock = "UPDATE PRODUCTOS SET STOCK =
                STOCK - '$cantidad' where cod_producto = '$codigo'";
                $ejecucion = $mysqli->query($consultaStock);
                
                $insertarEntrega = "INSERT INTO ENTREGAS VALUES('$rut', '$codigo', '$cantidad', '$fecha')";
                $mysqli->query($insertarEntrega);
                header('Location:realizar_entrega.php');

            }
            ?>
        </div>
        
    </form>
</div>
</body>
</html> 
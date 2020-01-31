<!-- Inclución de archivos requeridos -->
<?php
include ('sesion.php');
?>

<!DOCTYPE html> 
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Formulario eliminar personal</title>
	<link type="text/css" href="estilo.css" rel="stylesheet">

</head>

<body>
	<div class="contenedor">
		<div class= "encabezado">
			<div class="izq">
				<?php

				include ('conexion.php');

				$rut = $_SESSION["usuario"];
				$consulta=" SELECT * FROM PERSONAL WHERE RUT ='$rut' ";
				$ejecutar= $mysqli ->query($consulta);

				$result=mysqli_fetch_array($ejecutar);
				$nombre = $result['nombre'];
				$apellido = $result['apellido'];
				?>


				<p>Bienvenido/a:<br><!-- Agregar variable de sesión con nombre y apellido del usuario --><?php echo "$nombre $apellido"; ?></p>

			</div>

			<div class="centro">
				<a href=principalAdmin.php><center><img src='imagenes/home.png'><br>Home<center></a>
				</div>
				
				<div class="derecha">
					<a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
				</div>
			</div>


			<br><br><h1 align='center'>REGISTROS EXISTENTES</h1><br>
			<?php
			include('conexion.php');

			$consulta="SELECT * FROM PERSONAL";
			$ejecutar=$mysqli->query($consulta);

			echo "<table  width='80%' align='center'><tr>";	         	  
			echo "<th width='20%'>RUT</th>";
			echo "<th width='20%'>NOMBRE</th>";
			echo "<th width='20%'>APELLIDO</th>";
			echo "<th width='20%'>CARGO</th>";
			echo  "</tr>"; 

			while($result=mysqli_fetch_array($ejecutar)){	

				echo "<tr>";	         	  
				echo '<td width=20%>'.$result['rut'].'</td>';
				echo '<td width=20%>'.$result['nombre'].'</td>';
				echo '<td width=20%>'. $result['apellido'].'</td>';
				echo '<td width=20%>'.$result['cargo'].'</td>';
				echo "</tr>";
			}
			echo "</table></br>";
			?>

			<form action="" method="post" align='center'>
				<label name="elimina">Ingresa el Rut del personal a eliminar:</label>
				<input name='eliminar-personal' type="text">
				<input name='eliminar' type="submit" value="ELIMINAR">
			</form>
			<?php

			/* En las siguientes 5 lineas se verifica la creación del boton submit, se recupera el rut ingresado para ser eliminado y se verifica si es igual al rut del Admin, 
			y se muestra alerta con mensaje*/	

			if (isset($_POST['eliminar'])) {
				$eliminar = $_POST['eliminar-personal'];
				if ($eliminar == '180332403') {
					echo "<script lenguaje='javascript'>alert('Admin general no puede ser eliminado');</script>";
				}else{

					// Aquí debes agregar la eliminación del registro.
					$sentencia = "DELETE FROM PERSONAL WHERE RUT = '$eliminar' ";
					$mysqli -> query($sentencia);

					header('Location:eliminar_personal.php');

				}

			}
			?>

		</div>
	</body>
	</html>		 
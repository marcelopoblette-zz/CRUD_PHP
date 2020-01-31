<!--incluir archivos requeridos.
	Obtener variables con los datos ingresados en login, la contraseña debe estar dentro de una función hash.
	Verificar que exista el registro en la base de datos.
		Si el registro existe entonces:
			Iniciar sesión.
			Crear variables de sesión a ocupar.
			Asignar los permisos según el cargo. 

			Si no existe el registro enviar una variable para mostra mensaje en pagina de login. -->
			<?php
			include ('conexion.php');
			?>

			<?php

			$usuario = $_POST['usuario'];
			$pass = md5($_POST['pass']);


			$query = "SELECT * FROM PERSONAL WHERE RUT = '$usuario' AND CONTRASEÑA ='$pass' ";
			$ejecutar = $mysqli -> query($query)or die('Datos no encontrados.');
			$result = mysqli_num_rows($ejecutar);

			$query = "SELECT CARGO FROM PERSONAL WHERE RUT = '$usuario' ";
			$ejecutar = $mysqli -> query($query);

			$row = $ejecutar->fetch_row();
			$cargo = $row[0];

			if ($result>0) {
				session_start();
				$_SESSION['activo'] = true;
				$_SESSION['usuario'] = $usuario;


				if ($cargo=='Bodega') {
					header("Location:principalBodega.php");
				}else if ($cargo=='Admin') {
					header("Location:principalAdmin.php");
				}

			}else {
				header("Location:login.php?error=si");
			}

			?>

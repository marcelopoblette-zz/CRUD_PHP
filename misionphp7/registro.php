
<!-- incluir archivos requeridos.
	Verificar la confirmaci??n de la contraseña.
		Recuperar las variables con los datos ingresados en el formulario. 
		Validar que el rut ingresado no se encuantre en la base de datos.
			Si ya existe un registro vinculado al rut ingresado:
				Redirigir a login y entregar mensaje.

			Si no existe:
			Insertar datos en tabla correspondiente.
			Redirigir a login y mostrar mensaje.

	Si las contraseñas no existen redirigir a login y mostrar mensaje. -->  
	<?php
include ('conexion.php');


if (isset($_POST['boton-enviar'])) {
	$rut = $_POST['rut'];

	$consult = "SELECT * FROM PERSONAL WHERE RUT = '".$rut."'";

	$cons= $mysqli ->query($consult); 

	if (mysqli_num_rows($cons)== 0) {
		// Validar que el rut ingresado no se encuantre en la base de datos.
		

		if ($_POST['contrasena1']==$_POST['contrasena2']) {
			
			$rut = $_POST['rut'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$cargo = $_POST['cargo'];
			$contraseÃ±a = md5($_POST['contrasena2']);

			$consulta = "INSERT INTO PERSONAL VALUES ('$rut','$nombre','$apellido','$cargo','$contraseña')";
			$mysqli->query($consulta) or die("No se pudo crear registro.");
			
			header("Location:crear_personal.php?valida=si");
			
		} else {
			header("Location:crear_personal.php?errornea=si");
		}
		
	}else {
		// 	Si ya existe un registro vinculado al rut ingresado:
		// 		Redirigir a login y entregar mensaje.
		header("Location:crear_personal.php?yaexiste=si");

	}
}

?>
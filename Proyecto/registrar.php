<?php 
	$link = mysqli_connect("localhost","root","cep");
	if (mysqli_connect_errno())
	{
		echo "connection error";
		exit();
	}
	$conn = mysqli_select_db ($link,"FM");
	if (! $conn)
	{
		echo "error de bd";
	}
	$nombre = $_POST['Nombre'];
	$apellidos = $_POST['Apellidos'];
	$correo = $_POST['Email'];
	$correo2 = $_POST['Email2'];
	$contra = $_POST['Contraseña'];
	$contra2 = $_POST['Contraseña2'];
	
	if(!($correo == $_POST['Email2']))
	{
		echo "Error: Debe introducir los dos e-mails iguales";
	}
	else if($contra != $contra2)
	{
		echo "Error: Debe introducir las dos contrasenyas iguales";
		exit;
	}
	else if($nombre == "" || $apellidos == "" || $correo == "" || $correo2 == "" || $contra == "" || $contra2 == "") 
	{
		echo "Error: Debe rellenar todos los campos del registro";
		exit;
	}
	else if($_POST['Check'] == false)
	{
		echo "Error: Debe Aceptar los terminos de uso";
	}
	else
	{
		$sql = 'SELECT * FROM Cliente'; 
        	$rec = mysqli_query($link,$sql); 
        	$verificar_usuario = 0;
		while($result = mysqli_fetch_object($rec)) 
		{ 
		    if($result->Correo == $correo) //Esta condición verifica si ya existe el usuario 
		    { 
		        $verificar_usuario = 1; 
		    } 
		} 
		if($verificar_usuario == 0) 
		{ 
		        $query="INSERT INTO Cliente(Nombre,Apellidos,Correo,Password)
			VALUES('$nombre','$apellidos','$correo','$contra')";
		 	mysqli_query($link,$query); 	
			mysqli_close($link);
	  		mail("jordisanchez00@gmail.com", "Activacion cuenta FM", "contraseña");
			echo "Mail Sent.";
		} 
		else 
		{ 
		    echo 'Este usuario ya ha sido registrado anteriormente.'; 
		} 
	}
	
?>

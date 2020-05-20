<?php
  
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        if  (!isset($_SESSION['conectado']) or $_SESSION['conectado'] == 0) {
            header("Location: login.php");
      }
  }
    $IdPersona= 0;
    $IdDistrito="";
    $PrimerNombre = "";
    $SegundoNombre ="";
    $PrimerApellido="";
    $SegundoApellido="";
    $Cedula="";
    $Correo="";
    $Edad="";
    $Sexo="";
    $EstadoCivil="";
    $TrabajoFijo="";
    $Celular="";
    $Direccion="";
    $IdProvincia="";
    $IdCanton="";

    $edit_state = false;

  $bdc = mysqli_connect("localhost", "id13721146_pawloguser", "bBo5eq6Qn61-bR4*") or die(mysqli_error($bdc));
  $bdc -> set_charset("utf8");
    mysqli_select_db($bdc, "id13721146_pawlog") or die(mysqli_error($bdc));  

    //Damos click al botón de guardar y agregamos una persona
    if (isset($_POST['save'])) {
            $IdDistrito = $_POST['distrito'];
            $PrimerNombre = $_POST['PrimerNombre'];
            $SegundoNombre = $_POST['SegundoNombre'];
            $PrimerApellido = $_POST['PrimerApellido'];
            $SegundoApellido = $_POST['SegundoApellido'];
            $Cedula = $_POST['Cedula'];
            $Correo = $_POST['Correo'];
            $Edad = $_POST['Edad'];
            $Sexo = $_POST['Sexo'];
            $EstadoCivil = $_POST['EstadoCivil'];
            $TrabajoFijo = $_POST['TrabajoFijo'];
            $Celular = $_POST['Celular'];
            $Direccion= $_POST['Direccion'];
            $IdProvincia= $_POST['provincia'];
            $IdCanton= $_POST['canton'];

            mysqli_query($bdc, "insert into personas (IdDistrito, PrimerNombre, SegundoNombre, PrimerApellido
            ,SegundoApellido, Cedula, Correo, Edad, Sexo, EstadoCivil,
            TrabajoFijo, Celular, Direccion, IdProvincia, IdCanton) 
            values ('$IdDistrito','$PrimerNombre', '$SegundoNombre','$PrimerApellido','$SegundoApellido','$Cedula',
            '$Correo','$Edad', '$Sexo', '$EstadoCivil','$TrabajoFijo','$Celular','$Direccion','$IdProvincia','$IdCanton')"); 

            $resultsIdPersona = mysqli_query($bdc, "SELECT IdPersona FROM pawlogdb.personas ORDER BY IdPersona DESC LIMIT 1;"); 

            while ($reg3 = mysqli_fetch_array($resultsIdPersona)) {
                $LastIdPersona = $reg3['IdPersona'];
            }

            $LastIdAnimal = $_SESSION['IdAnimal'];


            mysqli_query($bdc, "INSERT INTO adopciones (IdPersona, IdAnimal, FechaAdopcion) 
            values ('$LastIdPersona','$LastIdAnimal', now())"); 
            $_SESSION['msg'] = "Gatito Adoptado";
            unset($_SESSION['IdAnimal']);
            header('location: tablaAdoptado.php');
        }


        //Actualizar datos de la persona
    if (isset($_POST['update'])){
        $IdPersona = $_POST['IdPersona'];
        $IdDistrito = $_POST['distrito'];
        $PrimerNombre = $_POST['PrimerNombre'];
        $SegundoNombre = $_POST['SegundoNombre'];
        $PrimerApellido= $_POST['PrimerApellido'];
		$SegundoApellido= $_POST['SegundoApellido'];
		$Cedula= $_POST['Cedula'];
		$Correo= $_POST['Correo'];		
        $Edad= $_POST['Edad'];
		$Sexo= $_POST['Sexo'];		
		$EstadoCivil= $_POST['EstadoCivil'];
		$TrabajoFijo= $_POST['TrabajoFijo'];
        $Celular= $_POST['Celular'];
        $Direccion= $_POST['Direccion'];
        $IdProvincia= $_POST['provincia'];
        $IdCanton= $_POST['canton'];
        
        
        mysqli_query($bdc, "update personas set PrimerNombre='$PrimerNombre', SegundoNombre='$SegundoNombre',
        PrimerApellido='$PrimerApellido', SegundoApellido='$SegundoApellido',
        Cedula='$Cedula', Correo='$Correo', Edad='$Edad', Sexo='$Sexo',
        EstadoCivil='$EstadoCivil', TrabajoFijo='$TrabajoFijo', Celular='$Celular' where IdPersona=$IdPersona");
        $_SESSION['msg'] = "Cliente Actualizado";
        header('location: tablaPersonas.php'); 
    }    
    
        //Eliminación de la persona

        if(isset($_GET['del'])){
            $IdPersona = $_GET['del'];
            mysqli_query($bdc, "delete from personas where IdPersona=$IdPersona");
            $_SESSION['de'] = "Cliente Eliminado";
            header('location: tablaPersonas.php'); 
        
        }


            $sql= "select * from personas";
            $results = mysqli_query($bdc, $sql);

            $sql_1= "select * from direcciones";
            $results_1 = mysqli_query($bdc, $sql_1);

?>
<?php
  
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        if  (!isset($_SESSION['conectado']) or $_SESSION['conectado'] == 0) {
            header("Location: login.php");
      }
  }
    $IdAnimal= 0;
    $IdTamañoActual = "";
    $IdTamanoProyectado ="";
    $IdTemperamento="";
    $NombreOriginal="";
    $UltimoNombre="";
    $Especie="";
    $Raza="";
    $Sexo="";
    $OtrasSenas="";
    $Edad="";
    $Foto="";

    $edit_state = false;

  $bdc = mysqli_connect("localhost", "id13721146_pawloguser", "bBo5eq6Qn61-bR4*") or die(mysqli_error($bdc));
  $bdc -> set_charset("utf8");
    mysqli_select_db($bdc, "id13721146_pawlog") or die(mysqli_error($bdc));  

    //Damos click al botón de guardar y agregamos un animal
    if (isset($_POST['save'])) {
           $IdTamañoActual = $_POST['IdTamañoActual'];
           $IdTamanoProyectado = $_POST['IdTamanoProyectado'];
           $IdTemperamento = $_POST['IdTemperamento'];
           $NombreOriginal = $_POST['NombreOriginal'];
           $UltimoNombre = $_POST['UltimoNombre'];
           $Especie = $_POST['Especie'];
           $Raza = $_POST['Raza'];
           $Sexo = $_POST['Sexo'];
           $OtrasSenas = $_POST['OtrasSenas'];
           $Edad = $_POST['Edad'];
           $Foto = $_FILES["Foto"]['name'];

           if ($Foto == ""){
        $_SESSION['datos']['mensaje']   = "No se puede agregar el gatito porque no tiene una foto adjunta";
        header("Location: createAnimals.php");
        exit;
    } else {
        $nombretemporal = "gatos_" . rand(1,1000)."_".str_replace(" ","-",$Foto);

        // Se verifica que el archivo no se haya utilizado antes, de lo contrario se agrega un número al azar al final
        $res = mysqli_query($bdc, "select count(*) from animales where Foto = '$nombretemporal'") or die(mysqli_error($bdc));
        $reg = mysqli_fetch_array($res);
        $cantidad = $reg{0};
        if ($cantidad > 0){
            $nombretemporal = "".rand(1,100)."-".$nombretemporal; 
        }

        if (strlen($nombretemporal) > 200){
            $_SESSION['datos']["mensaje"] = "El nombre del archivo es muy largo, debe reducir el nombre del mismo";
            header("Location: createAnimals.php");
            exit;
        }

        // Guardamos el archivo a la carpeta que corresponde
        if (!file_exists("./recursos/")) {
            mkdir("./recursos/", 0755, true);
        }

        $destino =  "./recursos/".$nombretemporal;
        if (!move_uploaded_file($_FILES["Foto"]['tmp_name'],$destino)){
            $_SESSION['datos']['mensaje'] = "Se presentó un problema al cargar el archivo - ".$_FILES["Foto"]['error'];
            header("Location: createAnimals.php");
            exit;
        }
            mysqli_query($bdc, "insert into animales (IdTamañoActual, IdTamanoProyectado, IdTemperamento
            ,NombreOriginal, UltimoNombre, Especie, Raza, Sexo, OtrasSenas, Edad, Foto) 
            values ('$IdTamañoActual', '$IdTamanoProyectado','$IdTemperamento','$NombreOriginal','$UltimoNombre',
            '$Especie','$Raza', '$Sexo', '$OtrasSenas','$Edad', '$nombretemporal')"); 
            $_SESSION['msg'] = "Gatito Guardado"; 
            header('location: tablaAnimals.php');
        }
      
        }  


        //Actualizar datos del gatito
    if (isset($_POST['update'])){
           $IdTamañoActual = $_POST['IdTamañoActual'];
           $IdTamanoProyectado = $_POST['IdTamanoProyectado'];
           $IdTemperamento = $_POST['IdTemperamento'];
           $NombreOriginal = $_POST['NombreOriginal'];
           $UltimoNombre = $_POST['UltimoNombre'];
           $Especie = $_POST['Especie'];
           $Raza = $_POST['Raza'];
           $Sexo = $_POST['Sexo'];
           $OtrasSenas = $_POST['OtrasSenas'];
           $Edad = $_POST['Edad'];
           $Foto = $_FILES["Foto"]['name'];
           $IdAnimal = $_POST['IdAnimal'];

      if ($Foto == ""){
        $_SESSION['datos']['mensaje']   = "No se puede agregar el gatito porque no tiene una foto adjunta";
        header("Location: createAnimals.php");
        exit;
    } else {
        $nombretemporal = "gatos_" . rand(1,1000)."_".str_replace(" ","-",$Foto);

        // Se verifica que el archivo no se haya utilizado antes, de lo contrario se agrega un número al azar al final
        $res = mysqli_query($bdc, "select count(*) from animales where Foto = '$nombretemporal'") or die(mysqli_error($bdc));
        $reg = mysqli_fetch_array($res);
        $cantidad = $reg{0};
        if ($cantidad > 0){
            $nombretemporal = "".rand(1,100)."-".$nombretemporal; 
        }

        if (strlen($nombretemporal) > 200){
            $_SESSION['datos']["mensaje"] = "El nombre del archivo es muy largo, debe reducir el nombre del mismo";
            header("Location: createAnimals.php");
            exit;
        }

        // Guardamos el archivo a la carpeta que corresponde
        if (!file_exists("./recursos/")) {
            mkdir("./recursos/", 0755, true);
        }

        $destino =  "./recursos/".$nombretemporal;
        if (!move_uploaded_file($_FILES["Foto"]['tmp_name'],$destino)){
            $_SESSION['datos']['mensaje'] = "Se presentó un problema al cargar el archivo - ".$_FILES["Foto"]['error'];
            header("Location: createAnimals.php");
            exit;
        }     


        mysqli_query($bdc, "update animales set IdTamañoActual='$IdTamañoActual', IdTamanoProyectado='$IdTamanoProyectado',
        IdTemperamento='$IdTemperamento', NombreOriginal='$NombreOriginal',
        UltimoNombre='$UltimoNombre', Especie='$Especie', Raza='$Raza', Sexo='$Sexo',
        OtrasSenas='$OtrasSenas', Edad='$Edad', Foto='$nombretemporal' where IdAnimal=$IdAnimal");
        $_SESSION['msg'] = "Gatito Actualizado";
        header('location: tablaAnimals.php'); 
    }
    }    
    
        //Eliminación de Gatito

        if(isset($_GET['del'])){
            $IdPersona = $_GET['del'];
            mysqli_query($bdc, "delete from animales where IdAnimal=$IdAnimal");
            $_SESSION['de'] = "Gatito Eliminado";
            header('location: tablaAnimals.php'); 
        
        }


            $sql= "select * from animales";
            $results = mysqli_query($bdc, $sql);

            $sql_1= "select * from direcciones";
            $results_1 = mysqli_query($bdc, $sql_1);

?>
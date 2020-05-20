<?php
  
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        if  (!isset($_SESSION['conectado']) or $_SESSION['conectado'] == 0) {
            header("Location: login.php");
      }
      if (isset($_SESSION['IdRol']) and $_SESSION['IdRol'] == 2)  {
        header("Location: index.php");
}
  }
    $IdUser=0;
    $Email ="";
    $Clave ="";
    $IdRol="";
    
    $edit_state = false;

    $bdc = mysqli_connect("localhost", "id13721146_pawloguser", "bBo5eq6Qn61-bR4*") or die(mysqli_error($bdc));
    $bdc -> set_charset("utf8");
      mysqli_select_db($bdc, "id13721146_pawlog") or die(mysqli_error($bdc));  
    //Damos click al botón de guardar y agregamos una persona
    if (isset($_POST['save'])) {
            
            $Email = $_POST['Email'];
            $Clave = $_POST['Clave'];
            $IdRol = $_POST['IdRol'];
            mysqli_query($bdc, "insert into users (Email, Clave, IdRol) 
            values ('$Email', md5('$Clave'),'$IdRol')"); 
            $_SESSION['msg'] = "Usuario Guardado"; 
            header('location: tablaUsers.php');
        }  

        //Actualizar datos de la persona
    if (isset($_POST['update'])){
            $IdUser = $_POST['IdUser'];
            $Email = $_POST['Email'];
            $Clave = $_POST['Clave'];
            $IdRol = $_POST['IdRol'];

        
        mysqli_query($bdc, "update users set Email='$Email', Clave=md5('$Clave'),
        IdRol='$IdRol' where IdUser=$IdUser");
        $_SESSION['msg'] = "Usuario Actualizado";
        header('location: tablaUsers.php'); 
    }    
    
        //Eliminación del usuario

        if(isset($_GET['del'])){
            $IdUser = $_GET['del'];
            mysqli_query($bdc, "delete from users where IdUser= $IdUser");
            $_SESSION['de'] = "Usuario Eliminado";
            header('location: tablaUsers.php'); 
        
        }


            $sql= "select * from users";
            $results = mysqli_query($bdc, $sql);


?>
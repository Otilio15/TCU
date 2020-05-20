<?php
$connection = new mysqli("localhost", "id13721146_pawloguser", "bBo5eq6Qn61-bR4*","id13721146_pawlog");
$connection -> set_charset("utf8");
if (! $connection){
    die("Error in connection".$connection->connect_error);
}

class Common {
    public function getProvincia($connection){
        $query = "SELECT * FROM tblProvincia";
        $result = $connection->query($query);
        return $result;
    }

    public function getCantonProvincia($connection,$IdProvincia) {
        $query = "SELECT * FROM tblCanton WHERE IdProvincia='$IdProvincia'";
        $result = $connection->query($query);
        return $result;
    }

    public function getDistritoCanton($connection,$IdCanton)
    {
        $query = "SELECT * FROM tblDistrito WHERE IdCanton='$IdCanton'";
        $result = $connection->query($query);
        return $result;
    }
}

if (isset($_POST['getCantonProvincia']) == "getCantonProvincia") {
    $cantonesData = '';
    $IdProvincia = $_POST['IdProvincia'];
    $common = new Common();
    $todosCantonces = $common->getCantonProvincia($connection,$IdProvincia);
    
    if ($todosCantonces->num_rows>0){
        while ($cantones = $todosCantonces->fetch_object()) {
            $IdCanton = $cantones->IdCanton;
            $NombreCanton = $cantones->NombreCanton;
            $cantonesData .= '<option value="'.$IdCanton.'">'.$NombreCanton.'</option>';
        }
    }
    echo "test^".$cantonesData;
}

if (isset($_POST['getDistritoCanton']) == "getDistritoCanton") {
    $distritosData = '';
    $IdCanton = $_POST['IdCanton'];
    $common = new Common();
    $todosDistritos = $common->getDistritoCanton($connection,$IdCanton);
    if ($todosDistritos->num_rows>0){
        while ($distritos = $todosDistritos->fetch_object()) {
            $IdDistrito = $distritos->IdDistrito;
            $NombreDistrito = $distritos->NombreDistrito;
            $distritosData .= '<option value="'.$IdDistrito.'">'.$NombreDistrito.'</option>';
        }
    }
    echo "test^".$distritosData;
}

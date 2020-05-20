<?php  

$host="localhost";
$username="id13721146_pawloguser";
$password="bBo5eq6Qn61-bR4*";
$dbname="id13721146_pawlog";


$conn=mysqli_connect($host,$username,$password,$dbname);

if(mysqli_connect_errno())
echo "mamé".mysqli_connect_error();

else
echo "Bien hecho"

?>
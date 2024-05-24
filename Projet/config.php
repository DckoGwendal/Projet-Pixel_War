<?php
session_start();

$host='localhost';
$user = "esirem";
$password = "esirem21";
$base = "pixelwar";


$link = connexion_MySQLi_procedural($host, $user,$password,$base);

// Connexion en Mysqli
function connexion_MySQLi_procedural ($host, $user,$password,$base)
{
    $link = mysqli_connect($host,$user,$password,$base);
    
    // Check connection
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    mysqli_query($link,"SET NAMES 'utf8'");
    return $link;
}


// Vérification que nous nous sommes bien connecté
if (!function_exists("EstConnecte"))
{

  // echo "<script>console.log('on a ". $_SESSION['isConnected']. "');</script>";
  function EstConnecte()
  {
    if ($_SESSION['isConnected'] != true )
    {
      header("location: index.php");
      exit;
    }
  }
}

// Ne pas oublier de terminer la page PHP, en fermant la connexion MySQL ( surtout pas ici)

?>
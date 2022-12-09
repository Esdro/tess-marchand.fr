<?php

if (PHP_SESSION_ACTIVE !==  session_status()  ) {
    session_start();
  }

error_reporting(E_ALL);

define("SRC",__DIR__);
define("SP", DIRECTORY_SEPARATOR);
define("BASE_URL", dirname($_SERVER["SCRIPT_NAME"]));
define("PUBLICS", SRC . SP . "publics");
define("DB_NAME", "bd_tessmarchand");
define("DB_HOSTNAME", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("SESSION_STATUS", session_status());

$session = $_SESSION;

function verifParams()
{
  if (isset($_POST) && sizeof($_POST) > 0) {

    foreach ($_POST as $key => $value) {
      $data = trim($value);
      $data = stripslashes($data);
      $data = strip_tags($data);
      $data = htmlspecialchars($data);

      $_POST[$key] = $data;
    }
  }
}

/*
var_dump($session);

die();
*/
require_once 'connexion_bd.php';



$model = new DataLayer();



?>
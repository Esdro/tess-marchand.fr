<?php

require_once("includes.php");



if (isset($_POST)) {
   
    verifParams();

 $results =    $model->authentifierUser($_POST["conn_mail"], $_POST["conn_pass"]);


 if ($results && sizeof($results) > 0) {
   

    $_SESSION["user"] =$results;


    $_SESSION["flash"] = array(
        "type" => "success",
        "timestamp" =>  date(DATE_COOKIE),
        "message" => " Vous avez bien été connecté (e) "
      );

      header("Location: " . BASE_URL . SP);

      return;

 }





}else {
    $_SESSION["flash"] = array(
        "type" => "danger",
        "timestamp" =>  date(DATE_COOKIE),
        "message" => " Requête mal formulée"
      );
      header("Location: " . BASE_URL . SP);

      return;
}


die();


?>


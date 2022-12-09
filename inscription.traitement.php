<?php

require_once("includes.php");



if (isset($_POST)) {
   
    verifParams();

    $userInfos = array (
        "email" => $_POST["user_mail"],
        "nom" => $_POST["nom"],
        "prenom" => $_POST["prenom"],
        "mot_de_passe" => $_POST["mot_de_passe"]
    );

 $results =    $model->addUser($userInfos);


 if ($results && sizeof($results) > 0) {
   

    $_SESSION["user"] =$results;


    $_SESSION["flash"] = array(
        "type" => "success",
        "timestamp" =>  date(DATE_COOKIE),
        "message" => " Vous avez bien été inscrit (e) sur notre site "
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


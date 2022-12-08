<?php

require_once('includes.php');


global $model;

$categories = $model->getCategories();

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

verifParams();


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?php isset($page_title) ?  print  $page_title : print "Vintage Shop"; ?> </title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <style>
    * {
      box-sizing: border-box !important;
    }
  </style>
</head>

<body  >


  <nav class="navbar  navbar-dark bg-dark">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="<?php echo  BASE_URL . SP  ?>"> <img src="publics/images/logo-site.jpg" alt="Logo" width="75"></a>

      <a class="navbar-brand" href="<?php echo  BASE_URL . SP  ?>"> Livraison offerte dès 75€ d’achat 💫</a>



      <div class=" offcanvas offcanvas-start text-bg-dark " tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Vintage Shop</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body ">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php echo  BASE_URL . SP ?>">Accueil </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Shop
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li>
                  <a class="dropdown-item" href="<?php echo  BASE_URL . SP . "shop.php?offset=0" ?>">Tous les Produits</a>
                </li>
                <?php
                foreach ($categories as $key => $value) {
                  $val = trim($value["titre"]);
                  if (strpos($val, " ") !== false) {
                    $val = str_replace(" ", "+", $val);
                  }
                  // echo $val; 
                  print ' <li><a class="dropdown-item" href="' . BASE_URL . SP . 'shop.php?categorie=' . $val . '&offset=0">' .   $value["titre"] . '</a> </li>';
                }
                ?>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo  BASE_URL . SP . "contact.php" ?>">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="<?php echo  BASE_URL . SP . "a-propos.php" ?>">A propos </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle  " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user mr-5"></i> Connexion
              </button>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item active" href="#">S'inscrire</a></li>
                <li><a class="dropdown-item" href="#">Se connecter </a></li>
              </ul>
            </div>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
  </svg>


  <main class="container-fluid mt-2">


    <div class="row">

      <?php

    

      if (isset($_SESSION["flash"]) && sizeof($_SESSION["flash"]) > 0) {
        switch ($_SESSION["flash"]["type"]) {
          case 'success':
            $echo =  ' 
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
    ' . ucfirst($_SESSION["flash"]["message"]) . '
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
      ';
            break;
          case 'danger':
            $echo =  ' 
          <div class="alert alert-danger d-flex align-items-center  alert-dismissible fade show" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
  ' . ucfirst($_SESSION["flash"]["message"]) . '
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
            ';
            break;
          case 'warning':
            $echo = '
           <div class="alert alert-warning d-flex align-items-center  alert-dismissible fade show" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
  ' . ucfirst($_SESSION["flash"]["message"]) . '
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
           ';
            break;

          default:
          $echo =  ' 
    <div class="alert alert-success d-flex align-items-center  alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
    ' . ucfirst($_SESSION["flash"]["message"]) . '
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
      ';
            break;
        }

        echo $echo;

      }
      unset($_SESSION["flash"]);


      ?>
    </div>
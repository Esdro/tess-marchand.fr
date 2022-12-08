<?php

require_once("includes.php");


$p_title = str_replace('+', " ", $_GET["p"]);


$product = $model->getOneProductDetails($p_title);

/*
var_dump($product);

die();

*/

$page_title = " Details | " . $product["titre"] .  "   | Vintage Shop ";

include_once('header.php');
?>

<div class="container-fluid text-center">

  <h1 class="my-2"><?php echo   $product["titre"];  ?> </h1>

  <div class="row g-2 mx-4 my-4">
    <div class="col-md-6">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <?php 
        for ($start=3; $start < 7; $start++) { 

          if (isset($product["image_" . $start]) and !empty($product["image_". $start])) {
            echo '
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'. $start - 1 .'" aria-label="Slide '. $start .'"></button>
            ';
             }
        }
          
          ?>
        
          <?php 

          
          ?>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="publics/uploads/<?php  echo lcfirst($product["image_principale"] ); ?>" class="d-block w-100" alt="<?php  echo  $product["titre"] ; ?>"  >
          </div>
          <div class="carousel-item">
          <img src="publics/uploads/<?php  echo lcfirst($product["image_2"]) ; ?>" class="d-block w-100" alt="<?php  echo  $product["titre"] ; ?>"  >
          </div>
          <?php 
        for ($start=3; $start < 7; $start++) { 
          if (isset($product["image_" . $start]) and !empty($product["image_". $start])) {
            echo '
            <div class="carousel-item">
            <img src="publics/uploads/'.lcfirst($product["image_". $start]).'" class="d-block w-100"  alt="'.$product["titre"] .'">
          </div>
            ';
             }
        }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Suivant </span>
        </button>
      </div>
    </div>

    <div class="col-md-6">

     <div class="row">
        <div class="col-12">
          <p class="fw-bold ">Description </p>
        </div>

       <div class="col-12">

       <?php 

$des = explode(",,", $product["description"]);

$echo = '

<ul class="list-group list-group-flush my-2">';

          foreach ($des as  $val) {

            $echo .= ' <li class="list-group-item">' . $val . '</li> ';
          }

          $echo .=  '  </ul>
<div class="d-grid gap-auto mt-1 ">
<span class="fw-bold"> Prix :  €' . str_replace(".", ",",  number_format(((int) $product["prix"]) / 100, 2)) . '  </span>
</div>

<div class="d-grid gap-auto mt-4">';

          $val = trim($value["titre"]);
          if (strpos($val, " ") !== false) {
            $val = str_replace(" ", "+", $val);
            $val = lcfirst($val);
          }

          $echo .= '
<a href="' . BASE_URL . SP . "produit.php?p=" . $val . '" class="btn btn-info btn-lg"> Ajouter au Panier </a>
</div>
</div>
</div> 


';

echo $echo;
          
          ?>
       </div>
     </div>
 

    </div>
  </div>


</div>


<!--    -->

<?php include_once('footer.php')  ?>
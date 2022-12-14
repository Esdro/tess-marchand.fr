<?php

require_once("includes.php");

$get = $_GET;
/*
var_dump($get);

exit();
*/
$off = isset($_GET['offset']) ? $_GET['offset'] : "0";

$dataProducts = $model->getAllProducts(offset: $off);

if (isset($get) && sizeof($get) > 0) {

  $possible_filtres = ["couleur", "signe_prix", "prix", "categorie", "limit", "offset", "previous","next"];

  $products = [];


  foreach ($get as $key => $value) {
    // var_dump($key);

    if (!in_array($key, $possible_filtres)) {
      $_SESSION["flash"] = array(
        "type" => "danger",
        "timestamp" =>  date(DATE_COOKIE),
        "message" => "Erreur dans vos paramètres saisis"
      );
      header("Location: " . BASE_URL . SP);

      return;
    } else {

      if (!empty(trim($value)) && "null" !== trim($value)) {
        $products[$key] = $value;
      }
    }
  }


  if (isset($products["couleur"])) {
    $couleur = $products["couleur"];
  } else {
    $couleur = null;
  }
  if (isset($products["categorie"])) {
    $categorie = $products["categorie"];

    if (strpos($categorie, "_") !== false) {
      $categorie = str_replace("_", " ", $categorie);
    }
    $categorie = trim($categorie);
  } else {
    $categorie = null;
  }

  // on traite les prix filtrés 
  if (isset($products["signe_prix"]) and isset($products["prix"])) {

    switch ($products["signe_prix"]) {
      case 'inferieur':
        $prix_inferieur = $products["prix"];
        $prix_superieur = null;
        break;

      case 'superieur':
        $prix_superieur = $products["prix"];
        $prix_inferieur = null;
        break;

      default:
        $prix_inferieur = "1000";
        $prix_superieur = "10000";
        break;
    }
  } else {
    $prix_inferieur = null;
    $prix_superieur = null;
  }



  $dataProducts = $model->getAllProducts(categorie: $categorie, couleur: $couleur, prix_inferieur: $prix_inferieur, prix_superieur: $prix_superieur, offset: $off);
}


// var_dump($dataProducts);
// die();

//exit();

//die();

if (sizeof($dataProducts) > 10 ) {


  if (isset($_GET["next"]) && "true" == $_GET["next"] ) {
    
$dataProducts =   array_slice($dataProducts, 10, 10, true);
  }elseif (isset($_GET["previous"]) && "true" == $_GET["previous"]) {
    $dataProducts =   array_slice($dataProducts, 0, 10, true);
  }else {
     
$dataProducts =   array_slice($dataProducts, 0, 10, true);
  }

}

$page_title = " Boutique | Vintage Shop ";


include_once('header.php');
?>

<div class="container-fluid">

  <div class="row my-4">

    <div class="col-md-4 mt-4">
      <h4>Filtrez selon vos besoins </h4>
      <div class="row mt-2">
        <div class="col-12">
          <form action="shop.php" method="GET" enctype="multipart/form-data">
            <div class="my-3">
              <p class="h4"> Couleurs </p>
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="couleur">
                <option value="null" selected>Quelle couleur ? </option>
                <option value="bleu">Bleue</option>
                <option value="blanc">Blanc</option>
                <option value="noir">Noir</option>
                <option value="vert">Vert</option>
                <option value="rouge">Rouge</option>
                <option value="orange">Orange</option>
                <option value="violet">Violet</option>
                <option value="marron">Marron</option>
              </select>
            </div>
            <div class="my-3">
              <p class="h4"> Categories </p>
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="categorie">
                <option value="null" selected>Quelle catégorie ?</option>
                <?php
                 
                   foreach ($categories as $key => $value) {
                     $val = trim($value["titre"]);
                     if (strpos($val, " ") !== false) {
                       $val = str_replace(" ", "_", $val);
                     }
                     // echo $val;
                       print '<option value="' .$val. '">' . $value["titre"] . '</option>';
                  //   print ' <li><a class="dropdown-item" href="' . BASE_URL . SP . 'shop.php?categorie=' . $val . '&offset=0">' .   $value["titre"] . '</a> </li>';
                   }
               
            /*    foreach ($categories as $key => $value) {
                  $val = trim($value["titre"]);
                  if (strpos($val, " ") !== false) {
                    $val = str_replace(" ", "_", $val);
                  }
                  // echo $val; 
                 
                }*/
                ?>
              </select>
            </div>
            <div class="my-3">
              <p class="h4"> Prix </p>
              <div class="row">
                <div class="col-md-6 text-start">
                  <div class="form-check text-start">
                    <input class="form-check-input" type="radio" name="signe_prix" value="inferieur" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Prix Inférieur à :
                    </label>
                  </div>
                </div>
                <div class="col-md-6 ">
                  <div class="form-check ">
                    <input class="form-check-input" type="radio" value="superieur" name="signe_prix" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                      Prix supérieur à :
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="d-grid gap-auto my-2">
                  <input type="range" class="form-range" min="1000" max="10000" step="500" id="customRange3" name="prix">
                </div>
              </div>
              <div class="row">
                <div class="col-6 text-start">
                  <span class="strong"> 10,00 € </span>
                </div>
                <div class="col-6 text-end">
                  <span class="strong"> 100,00 € </span>
                </div>
              </div>
            </div>
            <div class="d-grid gap-auto mt-4">
              <button type="submit" class="btn btn-primary btn-lg btn-block mb-4">Filtrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">

      <div class="row justify-content-around">
        <?php

        if (sizeof($dataProducts) > 0) {


          foreach ($dataProducts as $key => $value) {

            $des = explode(",,", $value["description"]);

            $echo =  '  
 
          <div class="card col-md-5 m-1 align-self-start ">
          <img src="' . BASE_URL . SP . "publics" . SP  . "uploads" . SP . $value["image_principale"] . '" class="card-img-top" alt="' . $value["titre"] . '" height = "400" >

          <div class="card-body">

          <h6 class="card-title mt-1">' . $value["titre"] . '</h6>
          <ul class="list-group list-group-flush my-2">';

            foreach ($des as  $val) {

              $echo .= ' <li class="list-group-item">' . $val . '</li> ';
            }

            $echo .=  '  </ul>
          <div class="d-grid gap-auto mt-1 ">
          <span class="fw-bold"> Prix :  €' . str_replace(".", ",",  number_format(((int) $value["prix"]) / 100, 2)) . '  </span>
          </div>

          <div class="d-grid gap-auto mt-4">';

            $val = trim($value["titre"]);
            if (strpos($val, " ") !== false) {
              $val = str_replace(" ", "+", $val);
              $val = lcfirst($val);
            }

            $echo .= '
          <a href="' . BASE_URL . SP . "produit.php?p=" . $val . '" class="btn btn-info btn-lg"> Détails </a>
          </div>
          </div>
          </div> ';

            echo $echo;
          }

        }else {
          echo '  <h2> Désolé votre recherche n\'a abouti à un résultat concret       </h2>    ';
        }



        ?>
      </div>
      <div class="row my-4 justify-content-end ">
        <div class="container">
          <div class="col-3 ">
            <nav aria-label="...">
              <ul class="pagination">
                <li class="page-item <?php  isset( $_GET["previous"]) &&  $_GET["previous"] == "true" ? print '  disabled' : print ' '; ?>">
                  <a class="page-link" href="<?php echo BASE_URL . SP . "shop.php?previous=true"; ?>">Précédent</a>
                </li>
                <li class="page-item <?php  isset( $_GET["previous"]) &&  $_GET["previous"] == "true" ? print '  active' : print ' '; ?>" <?php  isset( $_GET["previous"]) &&  $_GET["previous"] == "true" ? print 'aria-current="page"' : print ' '; ?>><a class="page-link" href="<?php echo BASE_URL . SP . "shop.php?previous=true"; ?>">1</a></li>
                <li class="page-item<?php  isset( $_GET["next"]) &&  $_GET["next"] == "true" ? print '  active' : print ' '; ?>" <?php  isset( $_GET["next"]) &&  $_GET["next"] == "true" ? print 'aria-current="page"' : print ' '; ?>>
                  <a class="page-link" href="<?php echo BASE_URL . SP . "shop.php?next=true"; ?>">2</a>
                </li>
                <li class="page-item  <?php isset( $_GET["next"]) &&  $_GET["next"] == "true" ? print '  disabled' : print ' '; ?>">
                  <a class="page-link" href="<?php echo BASE_URL . SP . "shop.php?next=true"; ?>">Suivant</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--    -->

<?php include_once('footer.php')  ?>
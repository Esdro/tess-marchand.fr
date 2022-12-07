<?php

require_once("includes.php");

$get = $_GET;

$dataProducts = $model->getAllProducts();

if (isset($get) && sizeof($get) > 0) {

  $possible_filtres = ["couleur", "signe_prix", "prix", "categorie", "limit", "offset"];

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
  }else {
    $couleur = "null";
  }
  if (isset($products["categorie"])) {
    $categorie = $products["categorie"];
  }else {
    $categorie = "null";
  }

  // on traite les prix filtrés 
  if (isset($products["signe_prix"]) and isset($products["prix"])) {

    switch ($products["signe_prix"]) {
      case 'inferieur':
        $prix_inferieur = $products["prix"];
        $prix_superieur = "null";
        break;

      case 'superieur':
        $prix_superieur = $products["prix"];
        $prix_inferieur = "null";
        break;

      default:
        $prix_inferieur = "1000";
        $prix_superieur = "100000";
        break;
    }
  }else {
    $prix_inferieur = "null";
    $prix_superieur = "null";
  }



if ("null" == $categorie and "null" == $couleur and  "null" == $prix_inferieur and "null" == $prix_superieur  ) {

  $dataProducts = $model->getAllProducts();

}else{

  $dataProducts = $model->getAllProducts(categorie: $categorie, couleur: $couleur, prix_inferieur: $prix_inferieur, prix_superieur: $prix_superieur);

}

 




}


// var_dump($dataProducts);
// die();

exit();

//die();

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
                    $val = str_replace(" ", "+", $val);
                  }
                  // echo $val; 
                  echo '<option value="' . lcfirst($val) . '">' . $value["titre"] . '</option>';
                }
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
                  <input type="range" class="form-range" min="1000" max="100000" step="500" id="customRange3" name="prix">
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
      <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe earum mollitia officia.</h1>
    </div>
  </div>
</div>

<!--    -->

<?php include_once('footer.php')  ?>
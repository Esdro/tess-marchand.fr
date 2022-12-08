

<?php 

require_once("includes.php");

include_once('header.php');
  ?>


<div class="container-fluid">

<div class="row m-5">

<div class="col text-center">
  <h1> Vintage Shop </h1>

  <p class="h3 my-5">
  Bienvenue dans notre boutique de seconde main ! 
  </p>

  <a href="shop.php?offset=0" class="btn btn-lg btn-outline-success mb-4">Shop Now</a>
            
</div>

</div>

<div class="row justify-content-center my-5 gap-2 ">
<h2 class="text-center"> Nos catégories populaires </h2>
<div class="card col-md-3  ">
  <div class="card-body">
    <h5 class="card-title">Jeans et Pantalons</h5>
    <p class="card-text">Des pantalons de qualités uniquement à vous !</p>
    <a href="shop.php?categorie=jeans+et+pantalons&offset=0" class="card-link">Voir cette catégorie</a>
  </div>
</div>

<div class="card col-md-3  ">
  <div class="card-body">
    <h5 class="card-title">Jupes</h5>
    <p class="card-text">Des jupes sexy, avec elégances de qualités uniquement à vous !</p>
    <a href="shop.php?categorie=jupe&offset=0" class="card-link">Voir cette catégorie</a>
  </div>
</div>

<div class="card col-md-3  ">
  <div class="card-body">
    <h5 class="card-title">Vestes</h5>
    <p class="card-text">Des vestes sur mesure second main et moins chers</p>
    <a href="shop.php?categorie=veste&offset=0" class="card-link">Voir cette catégorie</a>
  </div>
</div>
</div>
</div>

<!--    -->

<?php  include_once('footer.php')  ?>

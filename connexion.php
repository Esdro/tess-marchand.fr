<?php

require_once("includes.php");

$page_title = " A propos | Vintage Shop ";

include_once('header.php');
?>



<div class="container">

    <h1 class="text-center">VIntage Shop | Connexion </h1>
    <div class="text-center  m-2">
        <p class="text-justify  h5">Vous disposez d'un compte sur notre site, connectez-vous en un simple click ! <br>
            Inscrivez-vous en juste remplissant les champs suivants !
        </p>
    </div>

    <div class="row justify-content-center  m-4">
        <div class="col-md-6">
            <ul class="nav  nav-tabs mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-connexion-tab" data-bs-toggle="pill" data-bs-target="#pills-connexion" type="button" role="tab" aria-controls="pills-connexion" aria-selected="true">Connexion </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-inscription-tab" data-bs-toggle="pill" data-bs-target="#pills-inscription" type="button" role="tab" aria-controls="pills-inscription" aria-selected="false">Inscription</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent" >
                <div class="tab-pane fade show active" id="pills-connexion" role="tabpanel" aria-labelledby="pills-connexion-tab" tabindex="0">
                    <h1>Connectez vous juste en deux clics ! </h1>
                <form action="connexion.php" method="POST" >
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="inputEmail1" placeholder="Nom" required>
                    <label for="inputEmail1"> Nom : </label>
                </div>

                <div class="form-floating mb-3 mt-2">
                    <input type="text" class="form-control" id="inputAddress" placeholder="Email" required>
                    <label for="inputAddress">Email : </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputEmail2" placeholder="Nom" required>
                    <label for="inputEmail2"> Numéro de téléphone : </label>
                </div>
                <div class="form-floating mb-3 mt-2">
                    <textarea class="form-control" row="10" col="10" placeholder="Message" required></textarea>
                    <label for="inputAddress2">Commentaire : </label>
                </div>


                <div class="d-grid gap-auto">
                    <button type="submit" class="btn btn-success btn-lg btn-block mb-4 connexion">Se connecter </button>
                </div>
            </form>
                </div>

                <div class="tab-pane fade" id="pills-inscription" role="tabpanel" aria-labelledby="pills-inscription-tab" tabindex="0">

                <h1> L'inscription est simple et facile</h1>
                <form action="connexion.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="inputEmail1" placeholder="Nom" required>
                    <label for="inputEmail1"> Nom : </label>
                </div>

                <div class="form-floating mb-3 mt-2">
                    <input type="text" class="form-control" id="inputAddress" placeholder="Email" required>
                    <label for="inputAddress">Email : </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputEmail2" placeholder="Nom" required>
                    <label for="inputEmail2"> Numéro de téléphone : </label>
                </div>
                <div class="form-floating mb-3 mt-2">
                    <textarea class="form-control" row="10" col="10" placeholder="Message" required></textarea>
                    <label for="inputAddress2">Commentaire : </label>
                </div>


                <div class="d-grid gap-auto">
                    <button type="submit" class="btn btn-success btn-lg btn-block mb-4 inscription ">S'inscrire </button>
                </div>
            </form>
                </div>
            </div>



        </div>
    </div>


</div>




<!--    -->

<?php include_once('footer.php')  ?>
<?php

require_once("includes.php");

$page_title = " Contact | Vintage Shop ";

include_once('header.php');
?>


<div class="container">

  <h1 class="text-center">Contactez-Nous !</h1>
  <div class="text-center  m-2">
    <p class="text-justify  h5">Vous avez une question ou un problème, n’hésitez pas à nous le faire savoir. <br>
      Remplissez les champs suivants afin que nous puissions traiter votre demande dans les plus brefs délais.
    </p>
  </div>

<div class="row justify-content-center  m-4">
<div class="col-md-6">
<form>
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
    <button type="submit" class="btn btn-success btn-lg btn-block mb-4">Envoyer</button>
    </div>
  </form>
</div>
</div>


</div>
<!--    -->

<?php include_once('footer.php')  ?>
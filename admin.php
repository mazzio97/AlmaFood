<?php
  session_start();
  if (!isset($_SESSION["username"]) || $_SESSION["username"] != "tr354m1g05")
    header("location: /almafood/enter.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>AlmaFood</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="icon" type="image/png" href="./img/almafood.png" sizes="196x196" />
  <!-- STYLES -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/default.css" />
  <link rel="stylesheet" href="css/admin.css" />
  <!-- SCRIPTS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
  <script src="js/utils/htmlRetriever.js"></script>
  <script src="js/utils/pageLoader.js"></script>
  <script src="js/admin.js"></script>
</head>

<body>
  <div class="container">
    <div class="row">
      <!-- FORNITORI -->
      <div class="col-12 col-lg-6">
        <div class="admin-table-header" data-toggle="collapse" data-target="#collapseRestaurants" aria-expanded="false">
          <h4 class="mb-0 float-left">Fornitori</h4>
          <div class="float-right">
            <i class="fas fa-chevron-down"></i>
          </div>
        </div>
        <div id="collapseRestaurants" class="collapse multi-collapse">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Ristorante</th>
                <th>Username</th>
                <th>Abilitato</th>
              </tr>
            </thead>
            <tbody class="instance-table-restaurants"></tbody>
            <tbody class="template-table-restaurants d-none">
              <tr>
                <td>?</td>
                <td>?</td>
                <td>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="?" ?>
                    <label class="custom-control-label" for="?"></label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!--LUOGHI -->
      <div class="col-12 col-lg-6">
        <div class="admin-table-header" data-toggle="collapse" data-target="#collapsePlaces" aria-expanded="false">
          <h4 class="mb-0 float-left">Luoghi</h4>
          <div class="float-right">
            <i class="fas fa-chevron-down"></i>
          </div>
        </div>
        <div id="collapsePlaces" class="collapse multi-collapse">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Azioni</th>
              </tr>
            </thead>
            <tbody class="instance-table-places"></tbody>
            <tbody class="template-table-places d-none">
              <tr>
                <td id="?">?</td>
                <td>
                  <a class="edit" data-toggle="tooltip" data-placement="bottom" title="Modifica"><i class="fa fa-pen"></i></a>
                  <a class="delete" data-toggle="tooltip" data-placement="bottom" title="Elimina"><i class="fa fa-eraser"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- CATEGORIE -->
      <div class="col-12 col-lg-6">
        <div class="admin-table-header" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="false">
          <h4 class="mb-0 float-left">Categorie</h4>
          <div class="float-right">
            <i class="fas fa-chevron-down"></i>
          </div>
        </div>
        <div id="collapseCategories" class="collapse multi-collapse">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Azioni</th>
              </tr>
            </thead>
            <tbody class="instance-table-categories"></tbody>
            <tbody class="template-table-categories d-none">
              <tr>
                <td id="?">?</td>
                <td>
                  <a class="edit" data-toggle="tooltip" data-placement="bottom" title="Modifica"><i class="fa fa-pen"></i></a>
                  <a class="delete" data-toggle="tooltip" data-placement="bottom" title="Elimina"><i class="fa fa-eraser"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!--INGREDIENTI -->
      <div class="col-12 col-lg-6">
        <div class="admin-table-header" data-toggle="collapse" data-target="#collapseIngredients" aria-expanded="false">
          <h4 class="mb-0 float-left">Ingredienti</h4>
          <div class="float-right">
            <i class="fas fa-chevron-down"></i>
          </div>
        </div>
        <div id="collapseIngredients" class="collapse multi-collapse">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Azioni</th>
              </tr>
            </thead>
            <tbody class="instance-table-ingredients"></tbody>
            <tbody class="template-table-ingredients d-none">
              <tr>
                <td id="?">?</td>
                <td>
                  <a class="edit" data-toggle="tooltip" data-placement="bottom" title="Modifica"><i class="fa fa-pen"></i></a>
                  <a class="delete" data-toggle="tooltip" data-placement="bottom" title="Elimina"><i class="fa fa-eraser"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-12 text-right">
      <a href="php/exit.php">
        <button class="col-3 col-lg-2 btn-alma rounded-pill mb-3 mt-4">
          <i class="fas fa-sign-out-alt"></i>
          <span>Esci</span>
        </button>
      </a>
    </div>
  </div>
</body>

</html>

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
  <!-- styles -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/default.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/dashboard.css" />
  <link rel="stylesheet" href="css/restaurants.css" />
  <link rel="stylesheet" href="css/menu.css" />
  <link rel="stylesheet" href="css/dish.css" />
  <link rel="stylesheet" href="css/checkout.css" />
  <link rel="stylesheet" href="css/admin.css" />
  <!-- scripts -->
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
      <div class="col-12 col-lg-6">
        <i class="fas fa-2x fa-chevron-down" data-toggle="collapse" data-target="#collapseIngredients" aria-expanded="true"
        aria-controls="collapseIngredients"></i>
        <div id="collapseIngredients" class="collapse multi-collapse show">
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
                <a class="edit" data-toggle="tooltip"><i class="fa fa-pen"></i></a>
                <a class="delete" data-toggle="tooltip"><i class="fa fa-eraser"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>
      <div class="col-12 col-lg-6">
        <i class="fas fa-2x fa-chevron-down" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true"
        aria-controls="collapseCategories"></i>
        <div id="collapseCategories" class="collapse multi-collapse show">
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
                <a class="edit" data-toggle="tooltip"><i class="fa fa-pen"></i></a>
                <a class="delete" data-toggle="tooltip"><i class="fa fa-eraser"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>
      <div class="col-12 col-lg-6">
        <i class="fas fa-chevron-down" data-toggle="collapse" data-target="#collapsePlaces" aria-expanded="true"
        aria-controls="collapsePlaces"></i>
        <div id="collapsePlaces" class="collapse multi-collapse show">
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
                <a class="edit" data-toggle="tooltip"><i class="fa fa-pen"></i></a>
                <a class="delete" data-toggle="tooltip"><i class="fa fa-eraser"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
      <div class="col-12 col-lg-6">
        <i class="fas fa-chevron-down" data-toggle="collapse" data-target="#collapseRestaurants" aria-expanded="true"
        aria-controls="collapseRestaurants"></i>
        <div id="collapseRestaurants" class="collapse multi-collapse show">
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
      <div class="col-12 text-right">
        <a href="php/exit.php">
          <button class="col-5 col-md-4 col-lg-3 col-xl-2 btn-alma rounded-pill">
            <i class="fas fa-sign-out-alt"></i>
            <span>Esci</span>
          </button>
        </a>
      </div>
    </div>
  </div>
</body>

</html>

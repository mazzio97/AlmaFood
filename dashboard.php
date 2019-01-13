<?php
  require_once "php/utils/sessioncontrol.php";
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>AlmaFood</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="icon" type="image/png" href="./img/almafood.png" sizes="196x196" />
  <link rel="stylesheet" href="css/font-awesome.css" />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/customstrap.css" />
  <link rel="stylesheet" href="css/default.css" />
  <link rel="stylesheet" href="css/dashboard.css" />
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.bootstrap-growl.min.js"></script>
  <script src="js/utils/htmlRetriever.js"></script>
  <script src="js/dashboard.js"></script>
</head>

<body>
  <nav class="navbar sticky-top">
    <a class="navbar-brand"><?= $_SESSION["nominativo"] ?></a>
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <a class="nav-link active" href="#">
          <i class="fas fa-bell"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-search-location"></i>
          <span>Trova ristoranti</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-history"></i>
          <span>Ordini</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="php/exit.php">
          <i class="fas fa-sign-out-alt"></i>
          <span>Esci</span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-6 mx-auto">
        <ul class="template-orders notifications">
          <li class="notification-panel">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-6 text-left">?</div>
                  <div class="col-6 text-right text-muted">#<span class="order-id">?</span></div>
                </div>
              </div>
              <div class="card-body text-left">
                <div class="row">
                  <div class="col-6 text-left text-muted">Data Consegna</div>
                  <div class="col-6 text-right">?</div>
                </div>
                <div class="row">
                  <div class="col-6 text-left text-muted">Luogo Consegna</div>
                  <div class="col-6 text-right">?</div>
                </div>
                <div class="row">
                  <div class="col-6 text-left text-muted">Prezzo</div>
                  <div class="col-6 text-right">? &euro;</div>
                </div>
              </div>
              <div class="card-footer text-center">
                <div class="row">
                  <div class="col-4"><a href="#" class="order-details text-info" data-toggle="modal" data-target="#details"><i class="fa fa-info"></i> Dettagli</a></div>
                  <div class="col-4"><a href="#" class="text-success"><i class="fa fa-check"></i> Accetta</a></div>
                  <div class="col-4"><a href="#" class="text-danger"><i class="fa fa-times"></i> Rifiuta</a></div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Dettagli Ordine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <ul class="template-details">
                      <li>?</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</body>

</html>

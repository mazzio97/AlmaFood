<?php
  session_start();
  if(!isset($_SESSION["username"]))
    header("location: /almafood");
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
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar sticky-top">
    <a class="navbar-brand"><?= $_SESSION["nome"] . " " . $_SESSION["cognome"] ?></a>
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
        <a class="nav-link" href="exit.php">
          <i class="fas fa-sign-out-alt"></i>
          <span>Esci</span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-6 mx-auto">
        <ul class="notifications">
          <li>
            <div class="notification-panel">
              <div class="card">
                <div class="card-header text-center">
                  Diego Mazzieri - <span class="text-muted">2 minutes ago</span>
                </div>
                <div class="card-body text-left">
                  <ul>
                    <li>Piadina crudo, squacquerone e rucola</li>
                    <li>Roloto salame piccante, crema di carciofi e taleggio</li>
                  </ul>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <a href="#" class="btn btn-success col-6">Accept</a>
                    <a href="#" class="btn btn-danger col-6">Decline</a>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="notification-panel">
              <div class="card">
                <div class="card-header text-center">
                  Luca Giuliani - <span class="text-muted">10 minutes ago</span>
                </div>
                <div class="card-body text-left">
                  <ul>
                    <li>Piadina salsiccia e cipolla</li>
                  </ul>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <a href="#" class="btn btn-success col-6">Accept</a>
                    <a href="#" class="btn btn-danger col-6">Decline</a>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="notification-panel">
              <div class="card">
                <div class="card-header text-center">
                  Milo Marchetti - <span class="text-muted">1 hour ago</span>
                </div>
                <div class="card-body text-left">
                  <ul>
                    <li>Crescione con fric&ograve;</li>
                    <li>Rotolo salsiccia, cipolla, peperoni, provola e patatine fritte</li>
                  </ul>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <a href="#" class="btn btn-success col-6">Accept</a>
                    <a href="#" class="btn btn-danger col-6">Decline</a>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="notification-panel">
              <div class="card">
                <div class="card-header text-center">
                  Diego Mazzieri - <span class="text-muted">2 minutes ago</span>
                </div>
                <div class="card-body text-left">
                  <ul>
                    <li>Piadina crudo, squacquerone e rucola</li>
                    <li>Roloto salame piccante, crema di carciofi e taleggio</li>
                  </ul>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <a href="#" class="btn btn-success col-6">Accept</a>
                    <a href="#" class="btn btn-danger col-6">Decline</a>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="notification-panel">
              <div class="card">
                <div class="card-header text-center">
                  Luca Giuliani - <span class="text-muted">10 minutes ago</span>
                </div>
                <div class="card-body text-left">
                  <ul>
                    <li>Piadina salsiccia e cipolla</li>
                  </ul>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <a href="#" class="btn btn-success col-6">Accept</a>
                    <a href="#" class="btn btn-danger col-6">Decline</a>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="notification-panel">
              <div class="card">
                <div class="card-header text-center">
                  Milo Marchetti - <span class="text-muted">1 hour ago</span>
                </div>
                <div class="card-body text-left">
                  <ul>
                    <li>Crescione con fric&ograve;</li>
                    <li>Rotolo salsiccia, cipolla, peperoni, provola e patatine fritte</li>
                  </ul>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <a href="#" class="btn btn-success col-6">Accept</a>
                    <a href="#" class="btn btn-danger col-6">Decline</a>
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

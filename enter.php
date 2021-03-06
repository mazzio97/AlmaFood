<?php
  require_once "php/utils/session.php";

  if (isset($_SESSION["username"]))
    header("location: /almafood");
  elseif (isset($_COOKIE["username"])) {
    foreach ($_COOKIE as $key => $value)
      $_SESSION[$key] = $value;
    header("location: /almafood");
  }
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Accedi ad AlmaFood</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="icon" type="image/png" href="./img/almafood.png" sizes="196x196" />
  <!-- STYLES -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css/default.css" />
  <link rel="stylesheet" href="css/enter.css" />
  <!-- SCRIPTS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="js/enter.js"></script>
</head>

<body>
  <svg class="fork centered" version="1.1" xmlns="http://www.w3.org/2000/svg" width="42.765644mm" height="290.20813mm"
    viewBox="0 0 42.765644 290.20813">
    <g transform="translate(-83.694558,-3.7292634)">
      <path d="m 88.669928,4.1664853 c -0.49901,0.4990112 -0.521694,0.612423 -1.270208,12.7247887 -0.317552,4.922068 -0.816564,12.883565 -1.134116,17.692221 -0.29487,4.808655 -0.657791,11.227756 -0.793881,14.289871 -0.136096,3.062116 -0.340237,6.986162 -0.45365,8.732703 -0.136096,1.74654 -0.430965,6.600558 -0.680467,10.774107 -0.249509,4.173549 -0.521695,8.528555 -0.612424,9.685357 -0.06805,1.29289 -0.02269,2.744562 0.13609,3.833312 0.340237,2.041409 1.610451,6.169598 2.540428,8.211009 1.020704,2.24555 5.602535,8.823424 8.68733,12.407236 2.948707,3.42504 4.218913,5.6479 5.17158,9.07294 0.47632,1.70117 0.52169,2.22286 0.49901,8.61929 -0.0227,7.00884 -0.15878,11.25042 -1.111432,32.77597 -0.317562,6.91811 -0.657796,14.99301 -0.793894,17.91904 -0.136088,2.92602 -0.385591,8.64196 -0.567055,12.70211 -0.181453,4.06015 -0.430966,10.93289 -0.567054,15.31058 -0.22682,7.91613 -0.385601,11.65871 -1.020704,25.85786 -0.725835,15.90031 -1.6785,38.99094 -1.814598,43.32325 -0.068,2.49506 -0.22681,6.01083 -0.362907,7.80273 -0.362928,5.2623 0.226819,8.66465 2.109456,12.33919 1.29289,2.49505 2.585789,3.83332 4.672558,4.85402 1.63313,0.81657 1.83727,0.86193 3.87868,0.83924 2.51775,0 3.67454,-0.40828 5.48913,-1.92798 2.40432,-1.99607 4.55915,-6.39643 5.28498,-10.75143 0.1361,-0.88462 -0.52169,-20.98117 -1.22484,-36.97223 -0.54438,-12.13504 -1.36094,-35.04419 -1.58777,-43.66348 -0.13609,-5.17156 -0.43095,-14.83425 -0.68047,-21.43481 -0.22682,-6.62324 -0.54438,-15.49204 -0.68047,-19.73363 -0.13609,-4.24159 -0.3856,-11.2958 -0.56705,-15.65082 -0.18146,-4.37768 -0.49902,-12.99696 -0.70315,-19.16656 l -0.3856,-11.22775 0.56705,-2.29092 c 0.72584,-2.88066 2.08677,-5.60254 4.08282,-8.25638 3.17553,-4.218912 8.5966,-12.248456 9.34512,-13.8589 1.06607,-2.245552 1.85996,-5.103527 2.17751,-7.825411 0.2495,-1.950681 0.22682,-2.857974 -0.20415,-7.00884 -0.24949,-2.631149 -0.56705,-6.441777 -0.70315,-8.505872 -0.13609,-2.064093 -0.34023,-5.33035 -0.47632,-7.258348 -0.24952,-4.08282 -1.85996,-22.84111 -2.35896,-27.67245 -0.18147,-1.814585 -0.43097,-5.284983 -0.56706,-7.711993 -0.31756,-6.351054 -1.22485,-17.7829507 -1.47436,-18.4180562 -0.20414,-0.4990114 -1.31557,-0.9299759 -1.92799,-0.7485174 -0.24952,0.090729 -0.61242,0.3629178 -0.77121,0.6351056 -0.34023,0.5443763 -0.36291,1.1567988 -0.92997,27.150754 -0.61242,29.124121 -0.56706,27.67245 -1.04338,28.148777 -0.47634,0.476333 -1.42899,0.544378 -2.33629,0.204141 -0.40827,-0.136089 -0.58974,-0.430959 -0.68047,-0.952653 -0.068,-0.408283 -0.22682,-5.28499 -0.36292,-10.842158 -0.2495,-10.229735 -0.499,-19.869724 -0.90729,-35.044209 L 111.32958,4.7562258 110.73985,4.234532 c -0.70316,-0.612423 -1.45167,-0.6351049 -2.15483,-0.068047 -0.499,0.408282 -0.54438,0.612423 -0.70315,4.46842 -0.20414,5.375713 -0.56706,19.416077 -0.8846,34.114231 -0.11342,6.555197 -0.29488,13.087709 -0.38561,14.516696 l -0.15878,2.585789 -0.72583,0.204141 c -0.88461,0.272185 -1.79191,0.06805 -1.97337,-0.430966 -0.15877,-0.430966 -0.43096,-6.328372 -1.04338,-22.546241 -0.24951,-6.66861 -0.54438,-14.74352 -0.68048,-17.919046 -0.1134,-3.175528 -0.27218,-7.711995 -0.3629,-10.0709576 -0.1361,-4.1055023 -0.15878,-4.3096434 -0.68048,-4.8313372 -0.68047,-0.6804699 -1.950682,-0.7031523 -2.585786,-0.068047 -0.453649,0.4536463 -0.453649,0.7485166 -0.453649,27.6497658 0,25.789813 -0.02273,27.218801 -0.408284,27.695134 -0.499005,0.612424 -2.222871,0.861925 -3.198209,0.453643 -0.929972,-0.385598 -1.088753,-1.066066 -1.247524,-5.103526 -0.09073,-1.88263 -0.294869,-7.122252 -0.476329,-11.681399 -0.816564,-20.119233 -1.020705,-25.699087 -1.020705,-28.466331 0,-1.633129 -0.06805,-4.581832 -0.15878,-6.5551959 C 91.323761,5.0964611 91.233032,4.5067205 90.870119,4.1438028 90.348424,3.622109 89.214306,3.622109 88.669928,4.1664867 Z" />
    </g>
  </svg>
  <svg class="knife centered" version="1.1" xmlns="http://www.w3.org/2000/svg" width="31.714291mm" height="289.38098mm"
    viewBox="0 0 31.714291 289.38098">
    <g transform="translate(-95.772277,-4.7514431)">
      <path d="m 115.03172,5.3493596 c -2.93936,1.3671481 -5.99266,5.4002324 -8.54466,11.2789654 -2.16466,4.990088 -4.8078,14.423406 -6.1066,21.646501 -0.501287,2.825439 -1.162076,6.471166 -1.458286,8.111743 -1.572224,8.521883 -1.982367,13.648686 -2.848227,36.343338 -0.136714,3.46344 -0.27343,11.939743 -0.296216,18.798273 -0.02279,11.93976 0,12.8284 0.592431,19.34512 1.162073,12.69171 1.253221,13.23856 4.147018,27.25182 2.52922,12.25875 2.87101,14.37783 3.73686,24.01622 0.86586,9.57003 0.88865,19.86921 0.0456,35.09012 -0.25063,4.5116 -0.50128,9.84347 -0.59242,11.8486 -0.319,8.59025 -0.61522,13.99049 -1.25322,22.78579 -1.73172,24.33523 -2.620372,38.69028 -2.620372,42.60944 0,3.09887 0.478502,4.30651 2.255802,6.01546 2.41529,2.2558 5.65088,3.37228 10.50425,3.60014 5.85594,0.27342 9.82068,-0.7975 12.55497,-3.3723 1.48108,-1.41273 2.16465,-2.96215 2.32414,-5.10401 0.0911,-1.52665 -0.27342,-6.60788 -0.97978,-13.44362 -0.18229,-1.75451 -0.50128,-4.99008 -0.68357,-7.17752 -0.20508,-2.18743 -0.61521,-6.24332 -0.91143,-9.00039 -0.319,-2.75708 -0.72914,-7.51931 -0.91144,-10.59539 -0.18228,-3.07608 -0.70636,-9.84346 -1.13928,-15.03863 -2.07351,-24.79094 -2.48366,-33.99639 -2.32416,-52.29338 0.13672,-15.63106 0.34179,-20.78064 1.18486,-29.73546 0.319,-3.32672 0.61523,-6.69902 0.68358,-7.51931 0.25065,-3.12165 1.25322,-25.61123 1.48107,-33.29004 0.13672,-4.44324 0.45572,-12.213188 0.70637,-17.294418 0.56964,-11.415676 0.7975,-19.231201 1.1165,-38.052264 0.38735,-23.036435 0.38735,-34.429329 0.0455,-36.571193 -0.72915,-4.329299 -1.80008,-7.4509524 -3.05329,-8.8864573 -1.68616,-1.914007 -5.14959,-2.5520093 -7.65603,-1.3671481 z" />
    </g>
  </svg>
  <div id="almaCarousel" class="carousel slide" data-interval="false" data-ride="carousel">
    <div class="carousel-inner">

      <!-- LOGIN -->
      <div class="carousel-item">
        <div class="container centered">
          <div class="row">
            <div class="card col-11 col-sm-9 col-md-7 col-lg-5 mx-auto">
              <form class="card-body">
                <h3 class="text-center">Accedi</h3>
                <div class="form-group">
                  <input type="text" id="inputUser" class="form-control" placeholder="Email o Username" required />
                </div>
                <div class="form-group">
                  <input type="password" id="inputLoginPassword" class="form-control" placeholder="Password" required />
                </div>
                <p id="loginErr" class="badge badge-danger w-100">Errore</p>
                <div class="custom-checkbox custom-control mb-3">
                  <input type="checkbox" class="custom-control-input" id="rememberPassword">
                  <label class="custom-control-label" for="rememberPassword">Ricordami</label>
                </div>
                <button class="btn btn-alma btn-block text-uppercase" type="submit" id="loginBtn">Accedi</button>
              </form>
              <span class="text-center w-100 mb-3">Non hai ancora un account? <a href="#almaCarousel" data-slide="prev">Registrati</a></span>
            </div>
          </div>
        </div>
      </div>

      <!-- LOGO -->
      <div class="carousel-item active">
        <div class="plate rounded-circle centered"></div>
        <img class="logo centered" src="img/almafood.png" alt="" />

        <!-- CONTROLS -->
        <div class="container row">
          <div class="carousel-control mx-auto">
            <a href="#almaCarousel" class="col-8 col-sm-4 col-md-3 col-lg-2 d-inline-block btn-alma rounded-pill mb-3" role="button" data-slide="prev">
              <i class="fas fa-chevron-left"></i>
              <span>Accedi</span>
            </a>
            <a href="#almaCarousel" class="col-8 col-sm-4 col-md-3 col-lg-2 d-inline-block btn-alma rounded-pill mb-3" role="button" data-slide="next">
              <span>Registrati</span>
              <i class="fas fa-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- REGISTRATION -->
      <div class="carousel-item">
        <div class="container centered">
          <div class="row">
            <div class="card col-11 col-sm-9 col-md-7 col-lg-5 mx-auto">
              <form class="card-body">
                <h3 class="text-center">Registrati</h3>
                <div class="form-row">
                  <div class="form-group col-12">
                    <input type="text" id="inputRestaurant" class="form-control" placeholder="Ristorante" />
                  </div>
                  <div class="form-group col-6">
                    <input type="text" id="inputName" class="form-control" placeholder="Nome" />
                  </div>
                  <div class="form-group col-6">
                    <input type="text" id="inputSurname" class="form-control" placeholder="Cognome" />
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" id="inputEmail" class="form-control" placeholder="Email" required />
                </div>
                <div class="form-row">
                  <div class="form-group col-7 col-md-8">
                    <input type="text" id="inputUsername" class="form-control" placeholder="Username" required />
                  </div>
                  <div class="form-group col-5 col-md-4 text-right">
                    <input type="radio" name="userRole" value="client" id="client" checked="checked">
                    <label for="client" data-toggle="tooltip" data-placement="bottom" title="Cliente"><i class="fas fa-user fa-2x"></i></label>
                    <input type="radio" name="userRole" value="vendor" id="vendor">
                    <label for="vendor" data-toggle="tooltip" data-placement="bottom" title="Fornitore"><i class="fas fa-shipping-fast fa-2x"></i></label>
                  </div>
                </div>
                <div class="form-group">
                  <input type="password" id="inputRegisterPassword" class="form-control" placeholder="Password" required />
                </div>
                <div class="form-group">
                  <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Conferma Password" required />
                </div>
                <p id="registerErr" class="badge badge-danger w-100">Errore</p>
                <div class="custom-checkbox custom-control mb-3">
                  <input type="checkbox" class="custom-control-input" id="acceptTerms">
                  <label class="custom-control-label" for="acceptTerms">Accetto <a target="_blank" href="https://www.justeat.it/termsandconditions">Termini &amp; Condizioni</a></label>
                </div>
                <button class="btn btn-alma btn-block text-uppercase" type="submit" id="registerBtn">Registrati</button>
              </form>
              <span class="text-center w-100 mb-3">Sei gi&agrave; registrato? <a href="#almaCarousel" data-slide="next">Accedi</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

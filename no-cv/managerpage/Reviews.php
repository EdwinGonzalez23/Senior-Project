<?php
include('../db_connect.php');
$waitlist = pg_query($dbconn, "Select * FROM Waitlist") or die('Query failed: ' . pg_last_error());
$activelist = pg_query($dbconn, "Select * FROM ActiveList") or die('Query failed: ' . pg_last_error());
$temp1 = pg_query($dbconn, "Select * FROM avg_time_rate") or die('Query failed: ' . pg_last_error());
$temp2 = pg_query($dbconn, "Select * FROM date_vs_rate") or die('Query failed: ' . pg_last_error());

$graph = pg_fetch_array($temp2, null, PGSQL_ASSOC);
$rate;
$i = 0;
while ($ratings = pg_fetch_array($temp1, null, PGSQL_ASSOC)) {
  foreach ($ratings as $col_value)
    $rate[$i] = $col_value;
  $i++;
}

$result = pg_query($dbconn, "Select * FROM date_vs_rate") or die('Query failed: ' . pg_last_error());
$array = pg_fetch_all($result);
$dataPoints = array();
if ($array) {
  foreach ($array as $arr) {
    $tmp = array('label' => $arr['date'], 'y' => $arr['avgrating']);
    $dataPoints[] = $tmp;
  }
}
?>
<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.12
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>The Experience</title>
  <!-- Icons-->
  <link href="node_modules/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
  <link href="node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  <link href="node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
  <!-- Main styles for this application-->
  <link href="css/style.css" rel="stylesheet">
  <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">
  <!-- Global site tag (gtag.js) - Google Analytics-->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    // Shared ID
    gtag('config', 'UA-118965717-3');
    // Bootstrap ID
    gtag('config', 'UA-118965717-5');
  </script>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
  <header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
      <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
      <li class="nav-item px-3">
        <h2>The Experience</h2>
      </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
      <button class="btn btn-dark btn-lg float-right" onclick="logout();">Log out</button>
    </ul>
  </header>
  <div class="app-body">
    <div class="sidebar">
      <nav class="sidebar-nav">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="Manager.php">
              <i class="nav-icon icon-speedometer"></i>Manager Home
            </a>
          </li>
          <li class="nav-title">Reports</li>
          <li class="nav-item">
            <a class="nav-link" href="Company.php">
              <i class="nav-icon icon-drop"></i> Company</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Servers.php">
              <i class="nav-icon icon-drop"></i> Servers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Reviews.php">
              <i class="nav-icon"></i> Reviews</a>
          </li>
        </ul>
      </nav>
    </div>
    <main class="main">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Reviews</li>
        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-item active">Average Time at Each Rating</li>
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="card-group mb-4">
            <div class="card">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="icon-people"></i>
                </div>
                <div class="text-value"><?php echo $rate[0]; ?></div>
                <small class="text-muted text-uppercase font-weight-bold">1</small>
                <div class="progress progress-xs mt-3 mb-0">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="icon-user-follow"></i>
                </div>
                <div class="text-value"><?php echo $rate[1]; ?></div>
                <small class="text-muted text-uppercase font-weight-bold">2</small>
                <div class="progress progress-xs mt-3 mb-0">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="icon-basket-loaded"></i>
                </div>
                <div class="text-value"><?php echo $rate[2]; ?></div>
                <small class="text-muted text-uppercase font-weight-bold">3</small>
                <div class="progress progress-xs mt-3 mb-0">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="icon-pie-chart"></i>
                </div>
                <div class="text-value"><?php echo $rate[3]; ?></div>
                <small class="text-muted text-uppercase font-weight-bold">4</small>
                <div class="progress progress-xs mt-3 mb-0">
                  <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="icon-speedometer"></i>
                </div>
                <div class="text-value"><?php echo $rate[4]; ?></div>
                <small class="text-muted text-uppercase font-weight-bold">5</small>
                <div class="progress progress-xs mt-3 mb-0">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row-->

          <!-- /.row-->
        </div>
      </div>
      <!-- Breadcrumb-->
      <div class="container-fluid">
      </div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Reviews vs Time Graph</li>
        <!-- Breadcrumb Menu-->
      </ol>
      <div class="container-fluid">

        <div class="card-body">
          <!-- /.row-->
          <script>
            window.onload = function() {

              var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                  text: "Date"
                },
                axisY: {
                  title: "Rating",
                  includeZero: false
                },
                data: [{
                  type: "column",
                  dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
              });
              chart.render();

            }
          </script>
          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
          <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>
      </div>
    </main>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/pace-progress/pace.min.js"></script>
  <script src="node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
  <script src="node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">


</body>

</html>
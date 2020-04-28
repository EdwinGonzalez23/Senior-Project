<?php
include('../db_connect.php');
$waitlist = pg_query($dbconn, "Select * FROM Waitlist") or die('Query failed: ' . pg_last_error());
$activelist = pg_query($dbconn, "Select * FROM ActiveList") or die('Query failed: ' . pg_last_error());
$temp1 = pg_query($dbconn, "Select * FROM all_checkin") or die('Query failed: ' . pg_last_error());
$temp2 = pg_query($dbconn, "Select * FROM all_experience") or die('Query failed: ' . pg_last_error());
$temp3 = pg_query($dbconn, "Select * FROM all_wait") or die('Query failed: ' . pg_last_error());
$temp4 = pg_query($dbconn, "Select * FROM all_meal") or die('Query failed: ' . pg_last_error());

$checkin = pg_fetch_array($temp1, null, PGSQL_ASSOC);
$experience = pg_fetch_array($temp2, null, PGSQL_ASSOC);
$waits = pg_fetch_array($temp3, null, PGSQL_ASSOC);
$meals = pg_fetch_array($temp4, null, PGSQL_ASSOC);

$result = pg_query($dbconn, "Select * FROM date_vs_time") or die('Query failed: ' . pg_last_error());
$array = pg_fetch_all($result);
$dataPoints = array();
if ($array) {
    foreach ($array as $arr) {
        $tmp = array('label' => $arr['date'], 'y' => $arr['wait']);
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
        <li class="breadcrumb-item active">Company</li>
        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-item active">All Time Statistics</li>
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0">
                  <div class="btn-group float-right">
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                  <div class="text-value">
                    <?php
                    foreach ($checkin as $col_value) {
                      echo "$col_value";
                    }
                    ?>
                  </div>
                  <div>Customers Checked-In</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-info">
                <div class="card-body pb-0">
                  <div class="text-value">
                    <?php
                    foreach ($experience as $col_value) {
                      echo "$col_value";
                    }
                    ?>
                  </div>
                  <div>Overall Experience Rating&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-warning">
                <div class="card-body pb-0">
                  <div class="btn-group float-right">
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                  <div class="text-value">
                    <?php
                    foreach ($waits as $col_value) {
                      echo "$col_value";
                    }
                    ?>
                  </div>
                  <div>Average Wait Time&nbsp;&nbsp;</div>
                </div>
                <div class="chart-wrapper mt-3" style="height:70px;">
                  <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-danger">
                <div class="card-body pb-0">
                  <div class="btn-group float-right">
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                  <div class="text-value">
                    <?php
                    foreach ($meals as $col_value) {
                      echo "$col_value";
                    }
                    ?>
                  </div>
                  <div>&nbsp;Average Meal Time&nbsp;</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>
          <!-- /.row-->

          <!-- /.row-->
        </div>
      </div>
      <!-- Breadcrumb-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Wait vs Time Graph</li>
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
                  title: "Wait",
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
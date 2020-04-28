<?php
include('db_connect.php');
$result = pg_query($dbconn, "Select * FROM server_stats") or die('Query failed: ' . pg_last_error());
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
        <li class="breadcrumb-item active"><h3>Server Statistics</h3></li>
        <!-- Breadcrumb Menu-->
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <?php
          $i = -1;
          $j = -1;
          while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $j = ($j + 1) % 4;
            foreach ($line as $col_value) {
              $i = ($i + 1) % 4;
              if ($i == 0) {
                if ($j == 0) {
                  echo '<div class="row">';
                }
                echo '<div class="col-sm-6 col-lg-3"><div class="brand-card"><div class="brand-card-header bg-twitter"><h1>';
                echo "$col_value";
              } elseif ($i == 1) {
                echo " $col_value";
                echo '</h1><i class="fa fa-twitter"></i><div class="chart-wrapper"><canvas id="social-box-chart-2" height="90"></canvas></div></div><div class="brand-card-body">';
              } elseif ($i == 2) {
                echo '<div><div class="text-value">';
                echo "$col_value";
                echo '</div><div class="text-uppercase text-muted small">Avg. Wait</div></div>';
              } else {
                echo '<div><div class="text-value">';
                echo "$col_value";
                echo '</div><div class="text-uppercase text-muted small">Rating</div></div></div></div></div>';
                if ($j == 3) {
                  echo '</div>';
                }
              }
            }
          }
          ?>
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

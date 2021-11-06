<?php
  session_start();

  if(empty($_SESSION['id'])){
    header('Location: index.php');
    exit;
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">

    <title>CiberReserva Intel</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">

    <!-- Custom icons from Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        &nbsp;&nbsp;&nbsp;
        <i class="fas fa-chart-area" style="color:white"></i>
        &nbsp;&nbsp;&nbsp;
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><b>CiberReserva Intel</b></a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="exit.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Analytics <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file"></span>
                  Intel
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="color:gray;opacity: 0.5;" href="#">
                  <span data-feather="shopping-cart"></span>
                  Tickets
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="color:gray;opacity: 0.5;" href="#">
                  <span data-feather="users"></span>
                  Support
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="color:gray;opacity: 0.5;" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Manage
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="color:gray;opacity: 0.5;" href="#">
                  <span data-feather="layers"></span>
                  Update
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
            <i class="fas fa-globe"></i>&nbsp;&nbsp;Viewers per week on <a href="https://ciberreserva.com" target="_blank">ciberreserva.com</a>
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
            </div>
          </div>

          <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="./js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./js/vendor/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="./js/feather.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="./js/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            label: 'Viewers per week',
            data: [100, 130, 70, 160, 170, 115, 185],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: true,
            position: 'bottom',
            labels: {
                fontColor: '#333'
            }
        }
        }
      });
    </script>
  </body>
</html>

<?php
  require_once "config/db.php";
  session_start();

  if(empty($_SESSION['id'])){
    header('Location: index.php');
    exit;
  }

  if (!empty($_FILES)) {
    if (sizeof($_FILES) == 1) {

      $info = new SplFileInfo($_FILES["inputFile"]["name"]);

      $upload_filename = $_FILES["inputFile"]["name"];
      $upload_path = getcwd() . DIRECTORY_SEPARATOR . "files" . DIRECTORY_SEPARATOR . $upload_filename;
      $upload_type = mime_content_type($_FILES["inputFile"]["tmp_name"]);
      $upload_author = $_SESSION['id'];
      $datenow = date("Y-m-d H:i:s");
      
      if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $upload_path)) {
        $stmt = $mysqli->prepare("INSERT INTO files (name,type,path,timestamp,author) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss', $upload_filename, $upload_type, $upload_path, $datenow, $upload_author);
        
        if ($stmt->execute()) {
          $succ = "File: " . $upload_filename . " has been uploaded!";
        } else {
          $err = "Can't insert file uploaded into database";
        }
      } else {
        $err = "Can't upload file: " . $_FILES["inputFile"]["name"] . " to uploads directory";
      }
    } else {
        $err = "Can't upload multiple files";
    }
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

    <title>File Manager</title>

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
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/"><b>File Manager</b></a>
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
                  Upload a Files <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="color:gray;opacity: 0.5;" href="#">
                  <span data-feather="shopping-cart"></span>
                  Rename a File
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="color:gray;opacity: 0.5;" href="#">
                  <span data-feather="users"></span>
                  Check a File
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="color:gray;opacity: 0.5;" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Inspect a File
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="color:gray;opacity: 0.5;" href="#">
                  <span data-feather="layers"></span>
                  Share a File
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <br>
          <h2><i class="fas fa-archive"></i>&nbsp;&nbsp;File List</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Filename</th>
                  <th>Filetype</th>
                  <th>FilePath</th>
                  <th>Timestamp</th>
                  <th>Author</th>
                  <th>View</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

              <?php
                $query = "SELECT * FROM files";
                $run_query = mysqli_query($mysqli, $query);

                while ($row = mysqli_fetch_assoc($run_query)) {
                  $file_id = $row['id'];
                  $file_name = $row['name'];
                  $file_type = $row['type'];
                  $file_path = $row['path'];
                  $file_timestamp = $row['timestamp'];
                  $file_author = $row['author'];

                  echo "
                  <tr>
                    <td>$file_id</td>
                    <td>$file_name</td>
                    <td>$file_type</td>
                    <td>$file_path</td>
                    <td>$file_timestamp</td>
                    <td>$file_author</td>
                    <td><a href='/files/$file_name' target='_blank'><i class='fas fa-eye'></i></a></td>
                    <td><a href='#' ><i class='fas fa-trash'></i></a></td>
                  </tr>";
                }
                ?>
              </tbody>
            </table>
          </div>

          <br>
          <h2><i class="fas fa-upload"></i>&nbsp;&nbsp;Upload a File</h2>
          <br>
          <form id="upload-form-id" enctype="multipart/form-data" action="admin.php" method="POST">
            <div class="custom-file mb-3">
              <input type="file" class="custom-file-input" name="inputFile" id="validatedCustomFile" required>
              <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Upload File</button>
          </form>
          <?php
            if (isset($succ)) {
              echo "<div class='alert alert-success' role='alert'>$succ</div>";
            }elseif (isset($err)) {
              echo "<div class='alert alert-danger' role='alert'>$err</div>";
            }
          ?>
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

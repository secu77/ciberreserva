<?php
require_once "config/db.php";

if (!isset($_GET['id'])) {
    echo "Post id is empty" . PHP_EOL;
    exit();
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
    <link href="./css/album.css" rel="stylesheet">

    <!-- Custom icons from Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  </head>

  <body>

    <header>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="/" class="navbar-brand d-flex align-items-center">
            <i class="fas fa-globe"></i>
            &nbsp;&nbsp;
            <strong>CiberInteligence Panel</strong>
          </a>
          <button class="navbar-toggler" type="button" onclick="location.href = '/login.php';">
            <i class="fas fa-sign-in-alt"></i>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
          <li data-target="#demo" data-slide-to="0" class="active"></li>
          <li data-target="#demo" data-slide-to="1"></li>
          <li data-target="#demo" data-slide-to="2"></li>
          <li data-target="#demo" data-slide-to="3"></li>
          <li data-target="#demo" data-slide-to="4"></li>
        </ul>

        <?php
            $id = $_GET['id'];
            $query = "SELECT * FROM posts WHERE id='$id'";

            $run_query = mysqli_query($mysqli, $query);

            while ($row = mysqli_fetch_assoc($run_query)) {
                $post_id = $row['id'];
                $post_image = $row['image'];
                $post_title = $row['title'];
                $post_description = $row['description'];
                $post_comments = $row['comments'];

                echo "
                <div class='d-flex justify-content-center'>
                  <div class='col-md-4'>
                    <div class='card mb-4 box-shadow'>
                      <img class='card-img-top' src='./images/$post_image' style='width:100%;height:100%' alt='Card image cap'>
                      <div class='card-body'>
                        <p class='card-text'>
                          <b>$post_title</b><br><br>
                          <small>$post_description</small>
                        </p>
                        <div class='d-flex justify-content-between align-items-center'>
                          <div class='btn-group'>
                            <button type='button' class='btn btn-primary' onclick='view_post($post_id)'>See original post</button>
                          </div>
                          <small class='text-muted'>$post_comments comments</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
            }

        ?>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p>Management and analysis of exposed <a href="https://ciberreserva.com">CiberReserva</a> resources</p>
      </div>
    </footer>

    <script type="text/javascript">
      function view_post(id)
      {
        window.location.href = "https://www.blueliv.com/cyber-security-and-cyber-threat-intelligence-blog-blueliv/";
      }
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./js/vendor/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/vendor/holder.min.js"></script>
  </body>
</html>

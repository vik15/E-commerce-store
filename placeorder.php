<?php
require 'config.php';
$stmt = $pdo->prepare("SELECT * FROM users where id =". $_SESSION["id"]);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order</title>
  <link href="bootstrap.min.css" rel="stylesheet">
  <link href="carousel.css" rel="stylesheet">
  <link href="searchbar.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
</style>

</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid" >
    <a class="navbar-brand" href="index.php"><img src="Images/eletronics_stores.png" style="max-width:15rem;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item" style="margin-right: 2%;">
          <a class="nav-link active" aria-current="page" href="prod_laptops.php">Laptops</a>
        </li>
        <li class="nav-item" style="margin-right: 2%;">
          <a class="nav-link active" aria-current="page" href="prod_phones.php">Smartphones</a>
        </li>
        <li class="nav-item" style="margin-right: 2%;">
          <a class="nav-link active" aria-current="page" href="prod_tv.php">Televisions</a>
        </li>
        <li class="nav-item" style="margin-right: 2%;">
          <a class="nav-link active" aria-current="page" href="prod_headphones.php">Headphones</a>
        </li>
        <li class="nav-item" style="margin-right: 2%;">
          <a class="nav-link active" aria-current="page" href="prod_cameras.php">Cameras</a>
        </li>


      </ul>
      <!-- <form class="d-flex" style="margin-right: 5%;margin-left: 20%;">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->

      <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
        <li class="nav-item" style="margin-right: 2%;">
          <a class="nav-link active" aria-current="page" href="index.php?page=profile">
            <span class="material-icons md-18">account_circle</span></a>
        </li>
        <li class="nav-item" style="margin-right: 2%;">
          <a class="nav-link active" aria-current="page" href="login.php">
          <span class="material-icons md-18">login</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?page=testcart">
            <span class="material-icons md-18">shopping_cart</span></a>
        </li>
      </ul>
    </div>
  </div>
  </div>
</nav>
<br><br><br><br><br>
<?php foreach ($users as $user) : ?>
  <!-- <div class="d-flex flex-column align-items-center text-center p-3 py-5">
    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
    <span class="font-weight-bold"><?php echo $user['username'] ?></span>
    <span class="text-black-50"><?php echo $user['id'] ?></span>
    <span> </span></div> -->
<?php endforeach; ?>
<div style="text-align:left;display:block; margin-left:10px; margin-right:10px;" class="postcard">
  <br>
  <br>
  <br>
  <br>
    <h4 style="margin-left:10px;">Name : <?php echo $user['name'] ?></h4>
    <h4 style="margin-left:10px;">Mobile Number : <?php echo $user['mobileno'] ?></h4>
    <h4 style="margin-left:10px;">Address : <?php echo $user['address'] ?></h4>
    <p style="margin-left:10px;">Thank you for ordering with us.</p>
</div>

<!-- <div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
        <svg class="bi" width="30" height="24">
          <use xlink:href="#bootstrap" />
        </svg>
        <h5></h5>
      </a>
      <span class="text-muted">&copy; 2023 Company, Inc</span>
    </div>
  </footer>
</div> -->


<button onclick="topFunction()" id="myBtn" title="Go to top" style="width: min-content;"><svg
    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill"
    viewBox="0 0 16 16">
    <path
      d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
  </svg></button>

</div>
<script src="BackToTop.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
  crossorigin="anonymous"></script>


</body>

</html>

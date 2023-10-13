<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  require('config.php');
  if (!isset($_SESSION["id"])) {
    // Handle the case where the user is not logged in or 'id' is not set.
    // You might want to redirect the user to a login page or display an error message.
    // Example:
    header("Location: login.php");
    exit();
}
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
  $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
  $stmt->execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link href="bootstrap.min.css" rel="stylesheet">
  <link href="searchbar.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="profile.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
  </style>
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="Images/eletronics_stores.png" style="max-width:15rem;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
          <li class="nav-item" style="margin-right: 10%;">
            <a class="nav-link active" aria-current="page" href="profile.php">
              <span class="material-icons md-18" placeholder="profile">account_circle</span></a>
          </li>
          <li class="nav-item" style="margin-right: 10%;">
            <a class="nav-link active" aria-current="page" href="login.php">
              <span class="material-icons md-18" placeholder="login">login</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="testcart.php"><span class="material-icons md-18">shopping_cart</span></a>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </nav>
  <br><br>
  <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
      <div class="col-md-3 border-right">
        <?php foreach ($users as $user) : ?>
          <!-- <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
            <span class="font-weight-bold"><?php echo $user['username'] ?></span>
            <span class="text-black-50"><?php echo $user['id'] ?></span>
            <span> </span></div> -->
        <?php endforeach; ?>
      </div>
      <div class="col-md-5">
        <div class="p-3 py-1">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Profile Settings</h4>
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Name</label><input disabled type="text" class="form-control" placeholder="Enter Name" value="<?php echo $user['name'] ?>"></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Username</label><input disabled type="text" class="form-control" placeholder="Enter Username" value="<?php echo $user['username'] ?>"></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Mobile Number</label><input disabled type="text" class="form-control" placeholder="Enter Phone Number" value="<?php echo $user['mobileno'] ?>"></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Email ID</label><input disabled type="text" class="form-control" placeholder="Enter Email id" value="<?php echo $user['email'] ?>"></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Address</label><input disabled type="text" class="form-control" placeholder="Enter Address" value="<?php echo $user['address'] ?>"></div>
            <!-- <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div> -->
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Pincode</label><input disabled type="text" class="form-control" placeholder="Enter Pincode" value="<?php echo $user['pincode'] ?>"></div>
          </div>
          <!-- <div class="row mt-3">
            <div class="col-md-12"><label class="labels">State</label><input disabled type="text" class="form-control" placeholder="Enter State" value=""></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Country</label><input disabled type="text" class="form-control" placeholder="Enter Country" value=""></div>
          </div> -->
          <!-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button"><a href="index.php">Save Profile</a></button></div> -->
        </div>
      </div>
      <button onclick="topFunction()" id="myBtn" title="Go to top" style="width: min-content;">TOP</button>
      <!-- <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
            </div>
        </div> -->
    </div>
  </div>

  <!-- FOOTER -->
  <br>
  <br>
  <br>
  <div class="container">
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
  </div>


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="BackToTop.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>


<!-- https://youtu.be/q_jDixroQkw?t=2806 -->
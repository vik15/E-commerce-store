<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home Page</title>
  <link href="bootstrap.min.css" rel="stylesheet">
  <link href="carousel.css" rel="stylesheet">
  <link href="searchbar.css" rel="stylesheet">
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
        <!-- <form class="d-flex" style="margin-right: 5%;">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->

        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item" style="margin-right: 10%;">
            <a class="nav-link active" aria-current="page" href="index.php?page=profile">
              <span class="material-icons md-18">account_circle</span></a>
          </li>
          <li class="nav-item" style="margin-right: 10%;">
            <a class="nav-link active" aria-current="page" href="login.php">
            <span class="material-icons md-18">login</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php?page=testcart">
              <!-- <i class="fas fa-shopping-cart"></i>
              <span><?$num_items_in_cart?></span>
              <?php $num_items_in_cart = isset($_SESSION['testcart']) ? count($_SESSION['testcart']) : 0;?> -->

              <span class="material-icons md-18">shopping_cart</span></a>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </nav>
  <br><br>





  <main>
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <!-- <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button> -->
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
          <img src="51111308992_5d4ecdcc96_o.jpg" class="d-block w-100"
            alt="...">
          <div class="carousel-caption d-none d-md-block">
            <a href = "index.php?page=product&product_id=231643"  style="color: black;text-decoration: solid;">
            <h3>SONY PLAYSTATION 5</h3>
            <p>PLAY HAS NO LIMITS</p>
          </a>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
          <img src="anh-nhat-UkBwaZEhPFo-unsplash.jpg"
            class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <a href="index.php?page=product&product_id=mp000000008567288"  style="color: white;text-decoration: none;">
            <h3>Samsung Galaxy S21</h3>
            <p>Epic. In every way</p>
          </a>
          </div>
        </div>
        <!-- <div class="carousel-item" data-bs-interval="5000">
          <img src="mac2021.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <a href="index.php">
            <h3>MacBook Pro</h3>
            <p>Supercharged for Pros</p>
          </a>
          </div>
        </div> -->
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>




    <!-- Content -->
    <div class="container marketing">
      <div class="row">
        <div class="col-lg-4">
          <img src="58.jpg" class="img-fluid" width="100%">
          <h2>Headphones</h2>
          <p>
          </p><br>
          <p><a class="btn btn-primary" href="prod_headphones.php">View all</a></p>
        </div>
        <div class="col-lg-4">
          <br>
          <br>
          <br>
          <img src="71L1PbXlVpL._SL1500_.jpg" class="img-fluid" width="97%">
          <h2>Cameras</h2>
          <p>
          </p><br>
          <p><a class="btn btn-primary" href="prod_cameras.php">View all </a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img src="63.jpg" class="img-fluid" width="100%">
          <h2>Smart Phones</h2>
          <p>
          </p><br>
          <p><a class="btn btn-primary" href="prod_phones.php">View all </a></p>
        </div><!-- /.col-lg-4 -->
        <div class="row">
          <hr class="featurette-divider">
          <div class="col-lg-4">
            <img src="1581953002_1546586.jpg" width="100%" class="img-fluid">
            <h2>Televisions</h2>
            <p>
            </p><br>
            <p><a class="btn btn-primary" href="prod_tv.php">View all </a></p>
          </div>
          <!-- <div class="col-lg-4">
            <img src="1604945711_IMG_1443405.jpg" class="img-fluid" width="100%">
            <h2>Gaming Consoles</h2>
            <p>
            </p><br>
            <p><a class="btn btn-primary" href="prod_consoles.php">View all </a></p>
          </div>/.col-lg-4 -->
          <div class="col-lg-4">
            <img src="1612546281_IMG_1484400.jpg" class="img-fluid" width="100%">
            <h2>Laptops</h2>
            <p>
            </p><br>
            <p><a class="btn btn-primary" href="prod_laptops.php">View all</a></p>
          </div>
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <!-- <hr class="featurette-divider"> -->
        <!-- <div class="row featurette">
          <div class="col-md-7">
          <h2 class="featurette-heading">Apple iPhone 13 Mini</h2>
          <p class="lead">
            </p><br>
                <p>Chipset : Apple A15 Bionic (5 nm)</p>
                <p>Display : Super Retina XDR OLED 6.1 inches</p>
                <p>Internal : 512GB 4GB RAM</p>
          </div>
          <div class="col-md-5">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
              height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
              preserveAspectRatio="xMidYMid slice" focusable="false">
              <image href="Images/mp000000010632193.jpeg" width="80%" class="img-fluid" />
              <title>Placeholder</title>
            </svg>
            <form action="index.php?page=product&product_id=mp000000010632193" method="POST">
              <button class="btn btn-primary" >BUY NOW </button>
            </form>

          </div>
        </div> -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">LG C1
            </h2>
            <p class="lead">
            <h3>LIGHT UP YOUR WORLD with SELF-LIT PIXELS<h3>
                </p><br>
                <p>4K UHD 3840 x 2160 OLED Panel</p>
                <p>120 Hz Refresh Rate</p>
                <p>WebOS & AI ThinQ™</p>
                <p>HDR10, HLG, Dolby Vision HDR Support</p>
          </div>
          <div class="col-md-5 order-md-1" id="thirdimage">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
              height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
              preserveAspectRatio="xMidYMid slice" focusable="false">
              <image href="lg_oled.jpg" width="100%" />
              <title>Placeholder</title><!-- <text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text> -->
            </svg>
            <form action="index.php?page=product&product_id=mp000000010465549" method="POST">
              <button class="btn btn-primary"> BUY NOW </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>




  <!-- FOOTER -->
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
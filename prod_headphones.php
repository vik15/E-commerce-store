<?php
    //include configuration file
    require 'config.php';

    $start = 0;  $per_page = 4;
    $page_counter = 0;
    $next = $page_counter + 1;
    $previous = $page_counter - 1;

    if(isset($_GET['start'])){
     $start = $_GET['start'];
     $page_counter =  $_GET['start'];
     $start = $start *  $per_page;
     $next = $page_counter + 1;
     $previous = $page_counter - 1;
    }
    // query to get messages from messages table
    $prod_headph = 'Head Phones';
    $q = "SELECT * FROM prod_cat where category = '$prod_headph' LIMIT $start, $per_page";
    $query = $pdo->prepare($q);
    $query->execute();

    if($query->rowCount() > 0){
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    // count total number of rows in laptops table
    $count_query = "SELECT * FROM prod_cat where category = '$prod_headph'";
    $query = $pdo->prepare($count_query);
    $query->execute();
    $count = $query->rowCount();
    // calculate the pagination number by dividing total number of rows with per page.
    $paginations = ceil($count / $per_page);
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Headphones</title>
<link rel='stylesheet' href='bootstrap.min.css'>
<link rel="stylesheet" href="style.css"><!--Navbar fonts in this file -->
<link href="searchbar.css" rel="stylesheet">
<link rel="stylesheet" href="pagination.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
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
          <li class="nav-item" style="margin-right: 10%;">
            <a class="nav-link active" aria-current="page" href="index.php?page=profile">
            <span class="material-icons md-18">account_circle</span></a>
          </li>
          <li class="nav-item" style="margin-right: 10%;">
            <a class="nav-link active" aria-current="page" href="login.php">
            <span class="material-icons md-18">login</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php?page=testcart"><span
                class="material-icons md-18">shopping_cart</span></a>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </nav>
  <br><br>





<!-- partial:index.partial.html -->
<section class="light">
    <div class="container py-4">
        <h1 class="headprod">Headphones</h1>
        <!-- <h1 class="h1 text-center" id="pageHeaderTitle">My Cards Dark</h1> -->
<?php foreach($result as $data) : ?>
        <article class="postcard dark red geeks">
            <a class="postcard__img_link" href="index.php?page=product&product_id=<?=$data['product_id']?>">
                <img class="postcard__img" src="Images/<?=$data['image_link']?>" alt="<?=$data['product_id']?>">
            </a>
            <div class="postcard__text">
                <br><h1 class="postcard__title red "><a href="index.php?page=product&product_id=<?=$data['product_id']?>"><?php echo $data['name']; ?></a></h1><br>
                <div><h4>Price : &#8377;<?php echo $data['sale_price'];  ?></h4></div>
                <div><h6>MRP : <strike>&#8377;<?php echo $data['mrp_price'];  ?></strike></h6></div><br>
                <div><h6><?php echo $data['features-1'];  ?></h6></div> <br>
                <div><h6><?php echo $data['features-2'];  ?></h6></div>
                <br>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>
<br>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
<?php
                if($page_counter == 0){
                    echo "<li><a href=?start='0' class='page-link'>0</a></li>";
                    for($j=1; $j < $paginations; $j++) {
                      echo "<li><a class='page-link' href=?start=$j>".$j."</a></li>";
                   }
                }else{
                    echo "<li><a class='page-link' href=?start=$previous>Previous</a></li>";
                    for($j=0; $j < $paginations; $j++) {
                     if($j == $page_counter) {
                        echo "<li><a href=?start=$j class='page-link'>".$j."</a></li>";
                     }else{
                        echo "<li><a class='page-link' href=?start=$j>".$j."</a></li>";
                     }
                  }if($j != $page_counter+1)
                    echo "<li><a class='page-link' href=?start=$next>Next</a></li>";
                }
            ?>
  </ul>
</nav>



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

  <script src="BackToTop.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
    crossorigin="anonymous"></script>
</body>
</html>

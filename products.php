<?php

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
    $q = "SELECT * FROM prod_cat LIMIT $start, $per_page";
    $query = $pdo->prepare($q);
    $query->execute();

    if($query->rowCount() > 0){
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    // count total number of rows in laptops table
    $count_query = "SELECT * FROM prod_cat";
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
  <title></title>
    <link href="bootstrap.min.css" rel="stylesheet">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
<link rel="stylesheet" href="style.css">
<link href="searchbar.css" rel="stylesheet">
<link rel="stylesheet" href="pagination.css">

</head>
<body>
    <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="homepage.php">Electronics Store</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              All Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="prod_phones.php">Smartphones</a></li>
              <li><a class="dropdown-item" href="prod_laptops.php">Laptops</a></li>
              <li><a class="dropdown-item" href="prod_tv.php">Televisions</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <div class="btn-group dropdown ml" role="group" aria-label="Button group with nested dropdown" >
          <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-outline-Secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 20px;">
         Profile
        </button>
        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          <li><a class="dropdown-item" href="login.php">Login/Sign Up</a></li>
          <li><a class="dropdown-item" href="#">My Account</a></li>
        </ul>
        </div>
      <button type="button" class="btn btn-">Cart</button>
      <button type="button" class="btn btn-">Orders</button>
      </div>
      </div>
      </div>
    </div>
  </nav>
  <br>
  <br>
<section class="light">
    <div class="container py-4">
        <h1 class="headprod">LAPTOPS</h1>
<?php foreach($result as $data) : ?>
        <article class="postcard dark red">
            <a class="postcard__img_link" href="index.php?page=product&id=<?=$data['product_id']?>">
                <img class="postcard__img" src="lenovoslim3.jpg"  alt="<?=$data['name']?>">   
            </a>
            <div class="postcard__text">
                <h1 class="postcard__title red"><a href="index.php?page=product&id=<?=$data['product_id']?>"><?php echo $data['name']; ?></a></h1>
                <div class="postcard__subtitle small">
                </div>
                <div class="postcard__bar"></div>
                <div><h6><?php echo $data['description'];  ?><h6></div>               
                <br>
                <div><h3><?php echo "₹".$data['sale_price'];  ?></h3></div>
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
<button onclick="topFunction()" id="myBtn" title="Go to top" style="width: min-content;">TOP</button>
  <script src="BackToTop.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="pagination.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
    crossorigin="anonymous"></script>
</body>
</html>
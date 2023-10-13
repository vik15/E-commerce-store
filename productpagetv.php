<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM prod_tv WHERE product_id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="styleprod.css">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="searchbar.css" rel="stylesheet">
    
    <title>Document</title>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Electronics Store</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item" style="margin-right: 2%;">
            <a class="nav-link active" aria-current="page" href="prod_laptops.php">Laptop</a>
          </li>
          <li class="nav-item" style="margin-right: 2%;">
            <a class="nav-link active" aria-current="page" href="prod_phones.php">Smartphone</a>
          </li>
          <li class="nav-item" style="margin-right: 2%;">
            <a class="nav-link active" aria-current="page" href="prod_tv.php">Television</a>
          </li>
          <li class="nav-item" style="margin-right: 2%;">
            <a class="nav-link active" aria-current="page" href="prod_headphones.php">Headphone</a>
          </li>
          <li class="nav-item" style="margin-right: 2%;">
            <a class="nav-link active" aria-current="page" href="prod_cameras.php">Camera</a>
          </li>

        </ul>
        <form class="d-flex" style="margin-right: 5%;margin-left: 20%;">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item" style="margin-right: 2%;">
            <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
          </li>
          <li class="nav-item" style="margin-right: 2%;">
            <a class="nav-link active" aria-current="page" href="login.php">Login/Signup</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><span
                class="material-icons">shopping_cart</span></a>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </nav>
  <br><br>
    <div class="super_container" style="margin-left: 200px; background-color: #ffffff;">
        <header class="header" style="display: none;">
            <div class="header_main">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form action="#" class="header_search_form clearfix">
                                            <div class="custom_dropdown">
                                                <div class="custom_dropdown_list"> <span class="custom_dropdown_placeholder clc">All Categories</span> <i class="fas fa-chevron-down"></i>
                                                    <ul class="custom_list clc">
                                                        <li><a class="clc" href="#">All Categories</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <br>
        <div class="single_product">
            <div class="container-fluid" style=" background-color: #fff; padding: 11px;">
                <div class="row">
                    <div class="col-lg-4 order-lg-2 order-1" style="margin-right:50px">
                        <div class="image_selected"><img src="1612546281_IMG_1484400.jpg" width="500" height="500" alt="<?=$product['prod_name']?>"></div>
                    </div>
                    <div class="col-lg-6 order-3">
                        <div class="product_description">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="index.php?page=prod_tv">Products</a></li>
                                    <li class="breadcrumb-item active">Accessories</li>
                                </ol>
                            </nav>
                            <div class="product_name"><?=$product['prod_name']?></div><br>
                            <div> <span class="product_price">&#8377;<?=$product['prod_price']?></span> <strike class="product_discount"> <span style='color:black'>₹ 2,000<span> </strike> </div>
                            <div> <span class="product_saved">You Saved:</span> <span style='color:black'>₹ 2,000<span> </div>
                            <hr class="singleline"><br>
                            <div> <span class="product_info"><?=$product['prod_desc']?><span></div><br>
                            <hr class="singleline">
                            <div class="row">
<!--                                 <div class="col-xs-6" style="margin-left: 13px;">
                                    <div class="product_quantity"> <span>QTY: </span> <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                        <div class="quantity_buttons">
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="product_id" value="<?=$product['id']?>">
                                <div class="col-xs-6"> <button type="button" class="btn btn-primary shop-button">Add to Cart</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 -->
                <br><br>

                                
        <form action="index.php?page=cart" method="post">
            <div class="col-xs-6" style="margin-left: 13px;">
                                    <div class="product_quantity"> <span>QTY: </span>
                                        <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                                        <div class="quantity_buttons">
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <br>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="submit" value="Add To Cart">

                                            <!-- <div class="col-xs-6"> <button type="button" class="btn btn-primary shop-button"><a href="index.php?page=cart">Add to Cart</a></button> 
                                </div> -->
        </form>
        </div>
                <div class="row row-underline">
                    <div class="col-md-6"> <span class=" deal-text">Specifications</span> </div>
                    <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="col-md-12">
                            <tbody>
                                <tr class="row mt-10">
                                    <td class="col-md-4"><span class="p_specification">Sales Package :</span> </td>
                                    <td class="col-md-8">
                                        <ul>
                                            <li>2 in 1 Laptop, Power Adaptor, Active Stylus Pen, User Guide, Warranty Documents</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="row mt-10">
                                    <td class="col-md-4"><span class="p_specification">Model Number :</span> </td>
                                    <td class="col-md-8">
                                        <ul>
                                            <li> 14-dh0107TU </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="row mt-10">
                                    <td class="col-md-4"><span class="p_specification">Part Number :</span> </td>
                                    <td class="col-md-8">
                                        <ul>
                                            <li>7AL87PA</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="row mt-10">
                                    <td class="col-md-4"><span class="p_specification">Color :</span> </td>
                                    <td class="col-md-8">
                                        <ul>
                                            <li>Black</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="row mt-10">
                                    <td class="col-md-4"><span class="p_specification">Suitable for :</span> </td>
                                    <td class="col-md-8">
                                        <ul>
                                            <li>Processing & Multitasking</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="row mt-10">
                                    <td class="col-md-4"><span class="p_specification">Processor Brand :</span> </td>
                                    <td class="col-md-8">
                                        <ul>
                                            <li>Intel</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="BackToTop.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
    crossorigin="anonymous"></script>
</body>
</html>


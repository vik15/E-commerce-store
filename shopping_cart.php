<?php
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && $_POST['product_id'] && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM prod_cat WHERE product_id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=shopping_cart');
    exit;
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && $_GET['remove'] && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=shopping_cart');
    exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM prod_cat WHERE product_id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['sale_price'] * (int)$products_in_cart[$product['product_id']];
    }
}
?>





<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Snippet - GoSNippets</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <link href="bootstrap.min.css" rel="stylesheet">
	<!-- <link href="bootstrap-5.1.0-examples/carousel/carousel.css" rel="stylesheet"> -->
	<link href="searchbar.css" rel="stylesheet">
    <style>
        body {
            /* background: #ddd; */
            min-height: 100vh;
            /* vertical-align: middle; */
            display: flex;
            font-family: sans-serif;
            font-size: 0.8rem;
           /* font-weight: bold*/
        }

        .title {
            margin-bottom: 5vh
        }

        .card {
            margin: auto;
            /* max-width: 950px; */
            width: 100%;
            /* box-shadow: 0 6px 20px 0 rgba(110, 47, 47, 0.19); */
            /* border-radius: 1rem; */
            /* border: transparent */
        }

        @media(max-width:767px) {
            .card {
                margin: 3vh auto
            }
        }

        .cart {
            background-color: #fff;
            padding: 4vh 5vh;
            /* border-bottom-left-radius: 1rem; */
            /* border-top-left-radius: 1rem */
        }

        @media(max-width:767px) {
            .cart {
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem
            }
        }

        .summary {
            background-color: #ddd;
            /* border-top-right-radius: 1rem; */
            /* border-bottom-right-radius: 1rem; */
            padding: 4vh;
            color: rgb(65, 65, 65)
        }

        @media(max-width:767px) {
            .summary {
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem
            }
        }

        .summary .col-2 {
            padding: 0
        }

        .summary .col-10 {
            padding: 0
        }

        .row {
            margin: 0
        }

        /* .title b {
            font-size: 1.5rem
        } */

        .main {
            margin: 0;
            padding: 2vh 0;
            width: 100%
        }

        /* .col-2,
        .col {
            padding: 0 1vh
        } */

        a {
            padding: 0 1vh
        }

        /* .close {
            margin-left: auto;
            font-size: 0.7rem
        } */

        img {
            width: 3.5rem
        }

        .back-to-shop {
            margin-top: 4.5rem
        }

        h5 {
            margin-top: 4vh
        }

        hr {
            margin-top: 1.25rem
        }

        /* form {
            padding: 2vh 0
        } */

        select {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            /* outline: none; */
            width: 100%;
            background-color: rgb(247, 247, 247)
        }

        input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247)
        }

        input:focus::-webkit-input-placeholder {
            color: transparent
        }

        /* .btn {
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0
        } */

        /* .btn:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            -webkit-user-select: none;
            transition: none
        } */

        /* .btn:hover {
            color: white
        } */

        a {
            color: black
        }

        a:hover {
            color: black;
            text-decoration: none
        }

        /* #code {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center
        } */
    </style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
    crossorigin="anonymous"></script>
</head>

<body class='snippet-body'>
    <nav class="navbar fixed-top navbar-expand-md navbar-light bg-light" style="height: 50px;" >
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Electronics Store</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">All Categories</a>
              </li> -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  All Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Smartphones</a></li>
                  <li><a class="dropdown-item" href="#">Laptops</a></li>
                  <!-- <li><a class="dropdown-item" href="#"></a></li> -->
                  <!-- <li><hr class="dropdown-divider"></li> -->
                  <li><a class="dropdown-item" href="#">Televisions</a></li>
                </ul>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li> -->
            </ul>
            <form class="d-flex" style="height: 38px;">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit" style="height: 38px;">Search</button>
            </form>
            <div class="btn-group dropdown ml" role="group" aria-label="Button group with nested dropdown" >
              <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-Secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 20px;">
             Profile
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <li><a class="dropdown-item" href="#">Login/Sign Up</a></li>
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



    <div class="card" style="position: relative; top: 50px;">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <!-- <div class="col align-self-center text-right text-muted">3 items</div> -->
                    </div>
                </div>

                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="Images/<?=$data['image_link']?>">
                        </div>
                        <div class="col">
                            <?php foreach ($products as $product): ?>
                            <div class="row text-muted"><?=$product['category']?>
                            </div>
                            <div class="row">
                                <a href="index.php?page=product&product_id=<?=$product['product_id']?>">
                                    <?=$product['name']?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col"> <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a> </div>
                        <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                    </div>
                </div>

                <div class="row">
                </div>

                <div class="back-to-shop"><a href="#">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS 3</div>
                    <div class="col text-right">&euro; 132.00</div>
                </div>
                <form>
                    <p>SHIPPING</p> <select>
                        <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                    </select>
                    <p>GIVE CODE</p> <input id="code" placeholder="Enter your code">
                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">&euro; 137.00</div>
                </div> <button class="btn">CHECKOUT</button>
            </div>
        </div>
    </div>
    <!-- <script type='text/javascript'></script> -->
</body>

</html>

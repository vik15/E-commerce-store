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
        if (isset($_SESSION['testcart']) && is_array($_SESSION['testcart'])) {
            if (array_key_exists($product_id, $_SESSION['testcart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['testcart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['testcart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['testcart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=testcart');
    exit;
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && $_GET['remove'] && isset($_SESSION['testcart']) && isset($_SESSION['testcart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['testcart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['testcart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (($id) && isset($_SESSION['testcart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['testcart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=testcart');
    exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['testcart']) && !empty($_SESSION['testcart'])) {
    header('Location: index.php?page=checkout');
    unset($_SESSION['testcart']);

    exit;

}


// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['testcart']) ? $_SESSION['testcart'] : array();
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
    <title>Shopping Cart</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel='stylesheet'>
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel='stylesheet'>
    <link href="bootstrap.min.css" rel="stylesheet">
	<link href="cart.css" rel="stylesheet">
	<!-- <link href="searchbar.css" rel="stylesheet"> -->
  <link href="style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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

        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
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
              <span class="material-icons md-18">shopping_cart</span></a>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </nav>
  <br><br>



    <div class="card" style="position: relative; top: 50px;">
        <div class="row">
            <div class="col-md-12 cart">
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
                      <form action="index.php?page=testcart" method="post">
                          <?php foreach ($products as $product): ?>

                          <a href="index.php?page=product&product_id=<?=$product['product_id']?>" >
                          <img class="img-fluid" src="Images/<?= $product['image_link'] ?>" alt="<?=$product['name']?>">
                        </a>

                        <div class="col" style="display: inline;">
                            <!-- <div class="row text-muted" style="display: inline"><?=$product['category']?></div> -->
                            <div class="row" style="display: inline;font-size: 25px;"><a href="index.php?page=product&product_id=<?=$product['product_id']?>"><?=$product['name']?></a></div>
                            <div class="row" style="display: inline;"><h5>Price : &#8377;<?=$product['sale_price']?></h5></div>
                            <input type="number" style="width:74px" name="quantity-<?=$product['product_id']?>" value="<?=$products_in_cart[$product['product_id']]?>" min="1" max="2"  placeholder="Quantity" required>

                            <div class="row" style="display: inline;"><h3>Total : &#8377;<?=$product['sale_price'] * $products_in_cart[$product['product_id']]?></h3></div>
                        </div>
                        <div class="col">
                        <a href="index.php?page=testcart&remove=<?=$product['product_id']?>" class="remove btn btn-primary" class="" style="display: block;width: max-content;margin-bottom: 1%;">Remove</a>


                        <!-- <div class="col"> <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a> </div> -->

                          <!-- <span class="close">&#10005;</span> -->
                        </div>

                        <?php endforeach; ?>

                    </div>
                </div>





                <!-- <div class="back-to-shop"><a href="index.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
            </div> -->



            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <!-- <hr> -->
                <div class="row">
                    <!-- <div class="col" style="padding-left:0;">ITEMS 3</div> -->
                    <!-- <div class="col text-right">&#8377;<?=$subtotal?></div> -->
                </div>
                <!-- <form>
                    <p>SHIPPING</p> <select>
                        <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                    </select>
                    <p>GIVE CODE</p> <input id="code" placeholder="Enter your code">
                </form> -->
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col"><h4>TOTAL PRICE</h4></div>
                    <div class="col text-right"><h4>&#8377;<?=$subtotal?></h4></div>
                </div>
                <br>
                <div class="buttons">
                    <input type="submit" value="Update" name="update" style="margin: 1vh;" class="btn btn-primary" >
                    <input type="submit" value="Place Order" name="placeorder" style="margin: 1vh;" class="btn btn-primary" >
                </div>
                </form>
                <br>
                <!-- <button class="btn">CHECKOUT</button> -->
            </div>
        </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
    crossorigin="anonymous"></script>
</body>

</html>

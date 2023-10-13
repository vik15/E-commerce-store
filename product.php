<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['product_id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare("SELECT * FROM prod_cat where product_id = ?");
    $stmt->execute([$_GET['product_id']]);
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
    <title><?= $product['name'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="styleprod.css">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="searchbar.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                <!-- <li><p>Welcome back, <?= $_SESSION['username'] ?>!</p></li> -->
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
                        <div class="image_selected"><img src="Images/<?= $product['image_link'] ?>" width="90%" class="magnifiedImg" alt="<?= $product['product_id'] ?>"></div>
                    </div>
                    <div class="col-lg-6 order-3">
                        <div class="product_description">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="index.php?page=prod_laptops"><?= $product['category'] ?></a></li>
                                    <li class="breadcrumb-item active"><?= $product['name'] ?></li>
                                </ol>
                            </nav>
                            <div class="product_name"><?= $product['name'] ?></div><br>
                            <div> <span class="product_price">&#8377;<?= $product['sale_price'] ?></span> <strike class="product_discount"> <span style='color:black'>&#8377;<?php $save = $product['mrp_price'] - $product['sale_price'];
                                                                                                                                                                                echo $product['mrp_price'] ?><span> </strike>
                                <div> <span class="product_saved">You Saved:</span> <span style='color:black'>&#8377;<?php echo $save; ?><span> </div>
                                <hr class="singleline"><br>
                                <div> <span class="product_info"><?= $product['description'] ?><span></div><br>
                                <hr class="singleline">
                                <div class="row">


                                    <!-- <div class="product content-wrapper">
 -->
                                    <!-- <img src="imgs/<?= $product['img'] ?>" width="500" height="500" alt="<?= $product['name'] ?>"> -->
                                    <div>
                                        <!-- <h1 class="name"><?= $product['name'] ?></h1> -->
                                        <!-- span class="price">
            &dollar;<?= $product['sale_price'] ?> -->
                                        <!-- <?php if ($product['rrp'] > 0) : ?>
            <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
            <?php endif; ?> -->
                                        <!-- </span> -->
                                        <br>
                                        <form action="index.php?page=testcart" method="post">
                                            <input type="number" name="quantity" style="width: 74px;" value="1" min="1" max="2" placeholder="Quantity" required>
                                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                            <input type="submit" value="Add To Cart" class="btn btn-primary">
                                        </form>
                                        <br>
                                    </div>
                                    <!-- </div> -->


                                    <!-- laptops -->
                                    <?php if ($product['category'] == "Laptops") { ?>
                                        <div class="row row-underline">
                                            <div class="col-md-6"> <span class=" deal-text">Specifications</span> </div>
                                            <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="col-md-12">
                                                    <tbody>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Brand </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['brand'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Processor </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['cpu'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Graphics </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['gpu'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Ram </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['ram'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Internal Storage </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['hdd'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Color </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['color'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Office Included </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['office'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Addons </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['addons'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } elseif ($product['category'] == "Camera") { ?>

                                        <div class="row row-underline">
                                            <div class="col-md-6"> <span class=" deal-text">Specifications</span> </div>
                                            <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
                                        </div>
                                        <!-- cameras -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="col-md-12">
                                                    <tbody>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Brand</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['brand'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } elseif ($product['category'] == "Head Phones") { ?>

                                        <div class="row row-underline">
                                            <div class="col-md-6"> <span class=" deal-text">Specifications</span> </div>
                                            <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
                                        </div>
                                        <!-- Head Phones -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="col-md-12">
                                                    <tbody>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Brand</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['brand'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Extra Features</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-1'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-2'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-3'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-4'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-3'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } elseif ($product['category'] == "Smartphones") { ?>

                                        <div class="row row-underline">
                                            <div class="col-md-6"> <span class=" deal-text">Specifications</span> </div>
                                            <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
                                        </div>
                                        <!-- smartphones -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="col-md-12">
                                                    <tbody>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Brand </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['brand'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Processor </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['cpu'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Ram </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['ram'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Internal Storage </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['internal_storage'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Rear Camera</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['rear_camera'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Front Camera</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['front_camera'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Display</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['display_type'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Display Size</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['display_size'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Color </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['color'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Battery Capacity</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['battery_capacity'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } elseif ($product['category'] == "TV") { ?>
                                        <div class="row row-underline">
                                            <div class="col-md-6"> <span class=" deal-text">Specifications</span> </div>
                                            <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
                                        </div>
                                        <!-- TV -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="col-md-12">
                                                    <tbody>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Brand </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['brand'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Display Size </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['size'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Screen Resolution </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['screen_resolution'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Display Technonology </span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['display_technology'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } elseif ($product['category'] == "Consoles") { ?>

                                        <div class="row row-underline">
                                            <div class="col-md-6"> <span class=" deal-text">Specifications</span> </div>
                                            <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
                                        </div>
                                        <!-- Head Phones -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="col-md-12">
                                                    <tbody>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Brand</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['brand'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Extra Features</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-1'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-2'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-3'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-4'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-3'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } elseif ($product['category'] == "Smartwatches") { ?>
                                        <div class="row row-underline">
                                            <div class="col-md-6"> <span class=" deal-text">Specifications</span> </div>
                                            <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
                                        </div>
                                        <!-- Head Phones -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="col-md-12">
                                                    <tbody>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Brand</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['brand'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification">Extra Features</span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-1'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-2'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-3'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-4'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr class="row mt-10">
                                                            <td class="col-md-4"><span class="p_specification"></span> </td>
                                                            <td class="col-md-8">
                                                                <ul>
                                                                    <li><?= $product['features-3'] ?></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <script src="BackToTop.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
                        <script src="zoom.js"></script>
</body>

</html>
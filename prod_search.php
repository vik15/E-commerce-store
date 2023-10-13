<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['product_id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare("SELECT * FROM prod_cat where product_id = ?");
    $stmt->execute([$_GET['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$result) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>

<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<div class="product content-wrapper">
    <img src="imgs/<?=$result['img']?>" width="500" height="500" alt="<?=$result['name']?>">
    <div>
        <h1 class="name"><?=$result['name']?></h1>
        <span class="price">
            &dollar;<?=$result['sale_price']?>
            <!-- <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&dollar;<?=$product['rrp']?></span>
            <?php endif; ?> -->
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$result['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$result['product_id']?>">
            <input type="submit" value="Add To Cart">
        </form>
<!--         <div class="description">
            <?=$product['description']?>
        </div> -->
    </div>
</div>
</body>
</html>

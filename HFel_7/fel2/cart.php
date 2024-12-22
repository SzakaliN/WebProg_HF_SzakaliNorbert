<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['update_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$product_id])) {
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }

        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
    }

    header("Location: cart.php");
    exit();
}

$total_price = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>
<h1>Shopping Cart</h1>

<ul>
    <?php foreach ($_SESSION['cart'] as $productId => $item) {
        $total_price += $item['price'] * $item['quantity']; ?>
        <li>
            <form method="post">
                <?php echo $item['name']; ?> - $<?php echo $item['price']; ?>
                (Quantity:
                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="0">
                )
                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                <input type="submit" name="update_cart" value="Update">
            </form>
        </li>
    <?php } ?>
</ul>

<p>Total Price: $<?php echo number_format($total_price, 2); ?></p>

<form method="post" action="index.php">
    <input type="submit" name="continue_shopping" value="Continue Shopping">
</form>
</body>
</html>

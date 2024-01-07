<?php include 'connect.php';
if (isset($_POST['update_quantity'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = "UPDATE `cart` SET quantity = $update_value WHERE id = $update_id";
    $result = mysqli_query($connect, $update_quantity_query);
    if ($result) {
        header('location:cart2.php');
    } else {
        header('location: cart2.php');
    }
}
if (isset($_GET['delete_all'])) {
    $delete_query = mysqli_query($connect, "delete from `cart` ")  or die(mysqli_error($connect));

    if ($delete_query) {
        header('location:cart2.php');
    } else {
        header('location:cart2.php');
    }
}

if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    $remove_query = mysqli_query($connect, "delete from `cart` where id=$product_id")  or die(mysqli_error($connect));

    if ($remove_query) {
        header('location:cart2.php');
    } else {
        header('location:cart2.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <!-- css file  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">MY CART</h1>
            <table>
                <?php
                $sql = "select * from `cart` ";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) > 0) { ?>
                    <thead>
                        <th>SI No</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Image</th>
                        <th>Product quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php

                        $num = 0;
                        $grand_total = 0;

                        while ($row = mysqli_fetch_assoc($result)) {

                            $product_id = $row['id'];
                            $num += 1;
                            $product_name = $row['name'];
                            $product_price = $row['price'];
                            $product_quantity = $row['quantity'];
                            $product_image_name = $row['image'];
                            $total_price = $product_price * $product_quantity;
                            $grand_total += $total_price ?? 0;

                        ?>
                            <tr>
                                <td><?php echo $num; ?> </td>
                                <td><?php echo $product_name; ?> </td>
                                <td><?php echo number_format($product_price); ?>DA </td>
                                <td>
                                    <img src="images/<?php echo $product_image_name; ?>" alt="<?php echo $product_name; ?>">
                                </td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" value="<?php echo $product_id; ?>" name="update_quantity_id">
                                        <div class="quantity_box">
                                            <input type="number" min="1" value="<?php echo $product_quantity; ?>" name="update_quantity">
                                            <input type="submit" class="update_quantity" value="Update" name="update_product_quantity">
                                        </div>
                                    </form>
                                </td>
                                <td><?php echo number_format($total_price); ?>DA/-</td>
                                <td>
                                    <a href="cart2.php?remove=<?php echo $product_id; ?>" onclick="return confirm('Are you sure you want to delete item ')">
                                        <i class="fas fa-trash"></i>REMOVE
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
            </table>
            <!-- bottom area -->
            <div class="table_bottom">
                <a href="shop.php" class="bottom_btn">Continue Shopping</a>
                <h3 class="bottom_btn">Grand total: <span><?php echo number_format($grand_total); ?>DA/-</span> </h3>
                <a href="checkout.php" class="bottom_btn">Preceed To Checkout</a>
            </div>
            <a href="cart2.php?delete_all" onclick="return confirm ('Are you sure you want to delete all the item')" class="delete_all_btn">
                <i class="fas fa-trash"></i>Delete All
            </a>
        </section>
    </div>
<?php

                } else {
                    echo '<div class="empty_text">Cart is empty</div> ';
                }
?>



</body>

</html>
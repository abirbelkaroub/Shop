<?php
include 'connect.php';
if (isset($_POST['add_to_cart'])) {
    $product_name   = $_POST['product_name'];
    $product_price  = $_POST['product_price'];
    $product_image  = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($connect, "select * from `cart` where name = '$product_name';");
    if (mysqli_num_rows($select_cart) > 0) {
        $display_message[] = "Product already exist";
        $update_query = mysqli_query($connect, "UPDATE `cart` SET quantity = quantity + 1 WHERE name='$product_name'");
    } else {
        $insert_query = mysqli_query($connect, "insert into `cart` (name, price, image,quantity) values ('$product_name','$product_price','$product_image',$product_quantity); ");
        $display_message[] = "Product inserted secssessfully";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Displaying Products</title>
    <!-- css file  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php include 'header.php'; ?>



    <!-- countainer -->
    <div class="container">

        <!-- message displayed -->
        <?php
        if (isset($display_message)) {
            foreach ($display_message as $display_message) {

                echo "
                <div class='display_message'>
                <span>$display_message</span>    
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
                </div>";
            }
        }
        ?>

        <section class="products">
            <h1 class="heading">LETS SHOP</h1>
            <div class="product_container">
                <?php
                // products table products displayed 
                $display_product = mysqli_query($connect, "select * from `products`");
                if (mysqli_num_rows($display_product) > 0) {
                    // logic to fetch data
                    while ($row = mysqli_fetch_assoc($display_product)) {

                        $product_id = $row['id'];
                        $product_name = $row['name'];
                        $product_price = $row['price'];
                        $product_image = $row['image'];
                ?>
                        <form action="" method="POST">
                            <div class="edit_form">
                                <img src="images/<?php echo "$product_image"; ?>" alt="<?php echo "$product_name"; ?> ">
                                <h3><?php echo $product_name; ?></h3>
                                <div class="price">Price: <?php echo "$product_price"; ?>/-</div>
                                <input type="hidden" name="product_name" value="<?php echo "$product_name"; ?>">
                                <input type="hidden" name="product_price" value="<?php echo "$product_price"; ?>">
                                <input type="hidden" name="product_image" value="<?php echo "$product_image"; ?>">
                                <input type="submit" class="submit_btn cart_btn" value="Add to Cart" name="add_to_cart">

                            </div>
                        </form>
                <?php
                    }
                } else {
                    echo     ' <div class="empty_text">No product available</div> ';
                }
                ?>
            </div>
        </section>
    </div>

</body>

</html>
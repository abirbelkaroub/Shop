<?php include 'connect.php';
// update logic
if (isset($_POST['update_product'])) {
    $product_id = $_POST['update_product_id'];
    $product_name = $_POST['update_product_name'];
    $product_price = $_POST['update_product_price'];
    $product_image_name = $_FILES['update_product_image']['name'];
    $product_image_temp_name = $_FILES['update_product_image']['tmp_name'];
    $product_image_folder = 'images/' . $product_image_name;

    $update_query = mysqli_query($connect, "UPDATE products SET name='$product_name', price='$product_price', image='$product_image_name' where id='$product_id' ") or die(mysqli_error($connect));

    if ($update_query) {
        move_uploaded_file($product_image_temp_name, $product_image_folder);;

        echo ' <div class="empty_text">Product updated successuflly</div> ';
        echo '<script>
            setTimeout(function() {
                window.location.href = "view_products.php";
            }, 2500); 
          </script>';
    } else {
        $display_message =  "There are some errors updatting the product";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- css file  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    <!-- message displayed -->
    <?php

    if (isset($display_message)) {
        echo "
    <div class='display_message'>
    <span>$display_message</span>    
    <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
    </div>";
    }

    ?>
    <?php include 'header.php' ?>
    <section class="edit_container">
        <?php
        if (isset($_GET['updateid'])) {
            $product_id = $_GET['updateid'];
            $edit_product = mysqli_query($connect, "select * from `products` where id=$product_id");
            if (mysqli_num_rows($edit_product) > 0) {
                $row = mysqli_fetch_assoc($edit_product);
                $product_name = $row['name'];
                $product_price = $row['price'];
                $product_image = $row['image'];
            }
        }
        ?>
        <!-- form -->
        <form action="" method="POST" enctype="multipart/form-data" class="update_product product_container_box">
            <img src="images/<?php echo $product_image; ?>" alt="">
            <input type="hidden" value="<?php echo $product_id; ?>" name="update_product_id">
            <input type="text" class="input_fields fields" required value="<?php echo $product_name; ?>" name="update_product_name">
            <input type="number" class="input_fields fields" required value="<?php echo $product_price; ?>" name="update_product_price">
            <input type="file" class="input_fields fields" required accept="image/png, image/jpg, image/jpeg" name="update_product_image">
            <div class="btns">
                <input type="submit" class="edit_btn" value="Update Product" name="update_product">
                <input type="reset" id="close-edit" value="Cancel" class="cancel_btn">
            </div>
        </form>
    </section>
</body>

</html>
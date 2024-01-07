    <?php

    include 'connect.php';
    if (isset($_POST['add_product'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image_name = $_FILES['product_image']['name'];
        $product_image_temp_name = $_FILES['product_image']['tmp_name'];
        $product_image_folder = 'images/' . $product_image_name;

        $insert_query = mysqli_query($connect, "insert into `products` (name,price,image) values ('$product_name','$product_price','$product_image_name')") or die(mysqli_error($connect));

        if ($insert_query) {
            move_uploaded_file($product_image_temp_name, $product_image_folder);
            $display_message = "Product inserted successuflly";
        } else {
            $display_message = "There are some errors inserting the product";
        }
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopping Cart</title>
        <!-- css file  -->
        <link rel="stylesheet" href="css/style.css">
        <!-- font awesome link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>

    <body>
        <?php include('header.php'); ?>
        <!-- Form section -->
        <div class="container">
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

            <section>
                <h3 class="heading">Add Product</h3>
                <form action="" method="POST" class="add_product" enctype="multipart/form-data">
                    <input type="text " placeholder="Enter product name" class="input_fields" name="product_name" required>
                    <input type="number" placeholder="Enter product Price" class="input_fields" min="0" name="product_price" required>
                    <input type="file" class="input_fields" required accept="image/png, image/jpg, image/jpeg" name="product_image">
                    <input type="submit" class="submit_btn" value="Add Product" name="add_product">
                </form>
            </section>
        </div>



    </body>

    </html>
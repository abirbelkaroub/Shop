<?php


include 'connect.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products Project</title>


    <!-- css file  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>


    <!-- header -->
    <?php include "header.php"; ?>
    <!-- countainer -->
    <div class="container">
        <section class="display_product">

            <?php
            $display_product = mysqli_query($connect, "select * from `products`");
            if (mysqli_num_rows($display_product) > 0) {

                echo "
                        <table>
                <thead>
                    <th>SI No</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                        ";

                $num = 1;

                // logic to fetch data

                while ($row = mysqli_fetch_assoc($display_product)) {

                    $product_id = $row['id'];
                    $product_name = $row['name'];
                    $product_price = $row['price'];
                    $product_image = $row['image'];
            ?>

                    <tr>
                        <td><?php echo $num; ?> </td>
                        <td><img src="images/<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>" ;></td>
                        <td><?php echo $product_name; ?></td>
                        <td><?php echo "$product_price-/"; ?></td>
                        <td>
                            <a href="delete.php?deleteid=<?php echo $product_id; ?>" class="delete_product_btn" onclick="return confirm('Are you sure you want to delete this product')"><i class='fas fa-trash'></i></a>
                            <a href="update.php?updateid=<?php echo $product_id; ?>" class='edit_product_btn'><i class='fas fa-edit'></i></a>

                        </td>
                    </tr>
            <?php
                    $num++;
                }
            } else echo     ' <div class="empty_text">No product available</div> ';

            ?>
            </tbody>
            </table>
        </section>

    </div>

</body>

</html>
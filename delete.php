<?php


include 'connect.php';
if (isset($_GET['deleteid'])) {
    $product_id = $_GET['deleteid'];
    $delete_query = mysqli_query($connect, "delete from `products` where id=$product_id")  or die(mysqli_error($connect));

    if ($delete_query) {
        header('location:view_products.php');
    } else {
        header('location:view_products.php');
    }
}

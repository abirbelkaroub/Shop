<?php include 'connect.php'; ?>
<header class="header">
    <div class="header_body">
        <a href="index.php" class="logo">Company Name</a>
        <nav class="navbar">
            <a href="index.php">Add Products</a>
            <a href="view_products.php">View Products</a>
            <a href="shop.php">Shopit</a>
        </nav>
        <?php

        $count_query = "SELECT *   FROM `cart`";
        $result = mysqli_query($connect, "$count_query") or die('query failed');
        $row_count = mysqli_num_rows($result);


        echo "<a href='cart2.php' class='cart'><i><i class='fa-solid fa-cart-shopping'></i></i><span><sup>$row_count</sup></span></a>
        <!-- <div id='menu-btn' class='fas fa-bars'></div> --> "; ?>
    </div>
</header>
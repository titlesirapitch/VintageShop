<?php
    include("/MAMP/htdocs/project/connect.php");
    session_start();
?>

<?php
    if(empty($_SESSION['user_id'])){
        header("Location: /project/login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>VINTAGE SHIRT SHOP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/project/customer/css/shopall.css">
    </head>

    <body>
        <div class="header">
            <div class="logo">
                <a href="/project/customer/homepage.php"><img src="/project/customer/html/photo/logo.png"></a>
            </div>
            <form action="/project/customer/search.php" method="post">
              <div class="search-bar">
                  <input type="search" name="searchTxt" placeholder="Search for product by brands, model..">
                  <button type="submit" name="search">Search</button>
              </div>
            </form>
            <div class="user">
                <a href="/project/customer/profile.php"><img src="/project/customer/html/photo/user.png"></a>
            </div>
            <div class="cart">
                <a href="/project/customer/cart.php"><img src="/project/customer/html/photo/cartt.png"></a>
            </div>
        </div>
        <div>
            <ul>
                <li><a href="/project/customer/shopall.php">Shop All</a></li>
                <li><a href="/project/customer/men.php">Men</a></li>
                <li><a href="/project/customer/women.php">Women</a></li>
            </ul>
        </div>
        <div class="banner">
            <img src="/project/customer/html/photo/1111_banner.png">
        </div>
        <div class="shop-all">
            <text>NEW RELEASE</text>
        </div>
        <div class="new-release">
        <!-- Only one row containing 5 products -->
        <div class="product-row">
            <?php
                $srch_prod = "SELECT prod_name, image, prod_price FROM product LIMIT 5";
                if($result_prod = $mysqli->query($srch_prod)){
                    while($row = $result_prod->fetch_array()){
                        $newReleaseProducts[] = $row;
                    }
                }
                // Loop through products in the row
                $count = count($newReleaseProducts);
                $page = "homepage.php"; 
                $i=1;
                foreach ($newReleaseProducts as $product) {
                    // echo '<div class="product-row">';
                    echo '<div class="product">
                            <a href="/project/customer/product.php?id='.$i.'" class="product-link">
                                <img src="/project/admin/' . $product["image"] . '" alt="Product Image">
                                <p>' . $product["prod_name"] . '</p>
                                <p>' . $product["prod_price"] . ' ฿ THB</p>
                            </a>
                            <button class="add-to-cart-btn" type="submit" name="addCart">
                            <a href="/project/customer/addCart.php?page='.$page.'&id='.$i.'">Add to Cart</button></a>
                        </div>';
                    // echo '</div>';
                    $i++;
                }
            ?>
        </div>
        </div>
    </body>
</html>

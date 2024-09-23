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
                <li><a class="active" href="/project/customer/shopall.php">Shop All</a></li>
                <li><a href="/project/customer/men.php">Men</a></li>
                <li><a href="/project/customer/women.php">Women</a></li>
            </ul>
        </div>
        <div class="shop-all">
            <text>SHOP ALL</text>
        </div>
        <form action="shopall.php" method="post">
            <div class="new-release">
                <!-- Product rows containing 5 products each -->
                <?php
                    // Simulated database query result
                    $srch_prod = "SELECT prod_name, image, prod_price FROM product";
                    if($result_prod = $mysqli->query($srch_prod)){
                        while($row = $result_prod->fetch_array()){
                            $newReleaseProducts[] = $row;
                        }
                    }
                    // Calculate the number of rows
                    $rowCount = ceil(count($newReleaseProducts) / 5);
                    $page = "shopall.php";
                    // Loop through rows
                    for ($i = 0; $i < $rowCount; $i++) {
                        echo '<div class="product-row">';
                        // Loop through products in each row
                        for ($j = $i * 5; $j < min(($i + 1) * 5, count($newReleaseProducts)); $j++) {
                            $product = $newReleaseProducts[$j];
                            echo '<div class="product">
                                    <a href="/project/customer/product.php?id='.($j+1).'" class="product-link">
                                        <img src="/project/admin/' . $product["image"] . '" alt="Product Image">
                                        <p>' . $product["prod_name"] . '</p>
                                        <p>' . $product["prod_price"] . ' ฿ THB</p>   
                                    </a>
                                    <button class="add-to-cart-btn" type="submit" name="addCart">
                                    <a href="/project/customer/addCart.php?page='.$page.'&id='.($j+1).'">Add to Cart</button></a>
                                </div>';
                        }
                        echo '</div>';
                    }
                ?>
            </div>
        </form>
    </body>

</html>
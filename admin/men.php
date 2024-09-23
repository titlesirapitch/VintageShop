<?php
    include("/MAMP/htdocs/project/connect.php");
    session_start();
?>

<?php
    if(empty($_SESSION['m_id'])){
        header("Location: /project/login.php");
    }
?>

<!doctype html>
<html>
    <head>
        
        <title>VINTAGE SHIRT SHOP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/project/admin/css/shopall.css"> 
    </head>
    <body>
        <div class="header">
            <div class="logo">
                <a href="/project/admin/homepage.php"><img src="/project/customer/html/photo/logo.png"></a>
            </div>
            <form action="/project/admin/search.php" method="post">
              <div class="search-bar">
                  <input type="search" name="searchTxt" placeholder="Search for product by brands, model..">
                  <button type="submit" name="search">Search</button>
              </div>
            </form>
            <div class="head_admin">
                <form action="/project/admin/logout.php" method="post">
                    <button type="submit" name="admin">ADMIN</button>
                    <button type="submit" name="logout">LOG OUT</button>
                </form>
            </div>
        </div>
        <div>
            <ul>
                <li><a href="/project/admin/shopall.php">Shop All</a></li>
                <li><a class="active" href="/project/admin/men.php">Men</a></li>
                <li><a href="/project/admin/women.php">Women</a></li>
            </ul>
        </div>
        <div class="shop-all">
            <text> MEN </text>
        </div>
        <div class="new-release">
            <!-- Product rows containing 5 products each -->
            <?php
                // Simulated database query result
                $srch_prod = "SELECT prod_name, image, prod_price, prod_type FROM product";
                if($result_prod = $mysqli->query($srch_prod)){
                    while($row = $result_prod->fetch_array()){
                        $newReleaseProducts[] = $row;
                    }
                }
                // Calculate the number of rows
                $rowCount = ceil(count($newReleaseProducts) / 5);
                // Loop through rows
                for ($i = 0; $i < $rowCount; $i++) {
                    echo '<div class="product-row">';
                    // Loop through products in each row
                    for ($j = $i * 5; $j < min(($i + 1) * 5, count($newReleaseProducts)); $j++) {
                        $product = $newReleaseProducts[$j];
                        $page = "men.php";
                        if($product['prod_type'] == "men"){
                            echo '<div class="product">
                                    <a href="/project/admin/product.php?id='.($j+1).'" class="product-link">
                                        <img src="/project/admin/' . $product["image"] . '" alt="Product Image">
                                        <p>' . $product["prod_name"] . '</p>
                                        <p>' . $product["prod_price"] . ' ฿ THB</p>
                                    </a>
                                </div>';
                        }
                    }
                    echo '</div>';
                }
            ?>
        </div>
    </body>
</html>
<?php
    include("/MAMP/htdocs/project/connect.php");
    session_start();
?>

<?php
    if(empty($_SESSION['user_id'])){
        header("Location: /project/login.php");
    }
?>

<!doctype html>
<html>
    <head>
        <title>VINTAGE SHIRT SHOP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/project/customer/css/order.css">
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
                <a href="/project/customer/profile.php"><img src="/project/customer/html/photo/user.png">
            </div>
            <div class="cart">
                <a href="/project/customer/cart.php"><img src="/project/customer/html/photo/cartt.png"></a>
            </div>
        </div>
        <div>
            <ul>
                <li><a href="/project/customer/profile.php">My Profile</a></li>
                <li class="active"><a href="order.php">My Order</a></li>
            </ul>
        </div>
        <div class="order">
            <text> MY ORDER </text>
        </div>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Track NO.</th>
                        <th>Shipping</th>
                        <th></th>
                    </tr>
                </thead>
                    <?php
                        $uid = $_SESSION["user_id"];
                        $srch_order = "SELECT p.prod_ID, p.image, p.prod_name, p.prod_price, c.amount, c.tracking_no, c.deliveryStatus
                                    FROM (product p JOIN container c ON p.prod_ID = c.prod_ID) JOIN orders o ON o.order_ID = c.order_ID
                                    WHERE o.user_ID = $uid";
                        if($result = $mysqli->query($srch_order)){
                            while($row = $result->fetch_array()){
                                    $prod_ID = $row["prod_ID"];
                                    $prod_name = $row["prod_name"];
                                    $prod_price = $row["prod_price"];
                                    $amount = $row["amount"];
                                    $track_no = $row['tracking_no'];
                                    if($row['deliveryStatus'] == 0){
                                        $delStatus = "No";
                                    }else{
                                        $delStatus = "Yes";
                                    }
                                    echo "<tr>
                                            <td>$prod_name</td>
                                            <td>$prod_price ฿ THB</td>
                                            <td>$amount</td>
                                            <td>$track_no</td>
                                            <td id='shippingStatus1'>$delStatus</td>
                                            <td>
                                                <a href='/project/customer/order_detail.php?id=$prod_ID'><button class='edit-button'>Details</button></a>
                                            </td>
                                        </tr>";
                            }
                        }
                    ?> 
            </table>
        </section>
    </body>
</html>


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
        <link rel="stylesheet" href="/project/admin/css/viewOrder.css">
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
                <li class="active"><a href="/project/admin/viewOrder.php">View Order</a></li>
                <li><a href="/project/admin/html/add_product.html">Add Product</a></li>
                <li><a href="/project/admin/addPromo.php">Add Promocode</a></li>
            </ul>
        </div>
        <div class="vieworder">
            <text> VIEW ORDER </text>
        </div>
        
        <section>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Track NO.</th>
                    <th>Shipping</th>
                    <th></th>
                </tr>
            </thead>
            <!-- <tbody> -->
            <?php
                $srch_order = "SELECT p.prod_ID, p.prod_name, p.prod_price, c.amount, c.tracking_no, c.deliveryStatus, o.order_ID
                            FROM (product p JOIN container c ON p.prod_ID = c.prod_ID) JOIN orders o ON o.order_ID = c.order_ID
                            ORDER BY o.order_ID, p.prod_ID ASC";
                if($result = $mysqli->query($srch_order)){
                    while($row = $result->fetch_array()){
                            $order_ID = $row["order_ID"];
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
                                    <td>$order_ID</td>
                                    <td>$prod_name</td>
                                    <td>฿$prod_price</td>
                                    <td>$amount</td>
                                    <td>$track_no</td>
                                    <td id='shippingStatus1'>$delStatus</td>
                                    <td>
                                        <a href='/project/admin/updateShip.php?pid=$prod_ID&oid=$order_ID'>
                                            <button class='edit-button'>Check</button>
                                        </a>
                                        <a href='/project/admin/order_detail.php?pid=$prod_ID&oid=$order_ID'>
                                            <button class='edit-button'>Details</button>
                                        </a>
                                    </td>
                                </tr>";
                    }
                }
            ?> 
            <!-- </tbody> -->
        </table>
    </section>
    </body>
</html>
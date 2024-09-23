<?php
    include("/MAMP/htdocs/project/connect.php");
    session_start();
?>

<?php
    if(empty($_SESSION['m_id'])){
        header("Location: /project/login.php");
    }
?>

<?php
    $_SESSION['pID'] = $_GET['pid'];
    $_SESSION['oID'] = $_GET['oid'];
    $pID = $_SESSION['pID'];
    $srch_order = "SELECT p.image, p.prod_name, p.prod_price, c.amount, o.deliveryAddress, o.order_ID 
                   FROM (product p JOIN container c ON p.prod_ID = c.prod_ID) JOIN orders o ON o.order_ID = c.order_ID
                   WHERE p.prod_ID = $pID";
    if($result_prod = $mysqli->query($srch_order)){
        $row_prod = $result_prod->fetch_array();
        $oid = $row_prod["order_ID"];
        $prod_name = $row_prod["prod_name"];
        $prod_price = $row_prod["prod_price"];
        $prod_amount = $row_prod["amount"];
        $prod_detail = $row_prod["prod_detail"];
        $image = $row_prod["image"];
        $deliverAd = $row_prod['deliveryAddress'];
        $ads = explode(" ", $deliverAd);
        $addressl1 = $ads[0];
        $addressl2 = $ads[1];
        $postcode = $ads[2];
        $state = $ads[3];
        $country = $ads[4];
    }
?>

<!doctype html>
<html>
    <head>
        <title>VINTAGE SHIRT SHOP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/project/admin/css/order_detail.css">
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
                <li><a href="/project/admin/html/view_promocode.html">Add Promocode</a></li>
            </ul>
        </div>

        <div class="orderdetail">
            <text> ORDER DETAIL </text>
        </div>
        <div class="order-detail-body">
            <div class="order-detail-container">
                <div class="photo-container">
                  <img id="imagePreview" class="image-preview" src="/project/admin/<?php echo $image; ?>">
                </div>
            
                <div class="personal-info-container">
                  <h2>Product Information</h2><br>
                  <div class="form-group">
                    <label for="name">Product Name:</label>
                    <text name="productName"><?php echo $prod_name; ?></text>
                  </div>
          
                  <div class="form-group">
                    <label for="price">price:</label>
                    <text  name="productPrice"><?php echo "$prod_price ฿ THB"; ?></text>
                  </div>
          
                  <div class="form-group">
                    <label for="amount">Amount:</label>
                    <text name="productAmount"><?php echo $prod_amount; ?></text>
                  </div>
                </div>
            
                <div class="address-info-contrainer">
                    <h2>Address Information</h2><br>
                      <div class="form-group">
                        <label for="address1">Address Line1:</label>
                        <text name="address1"><?php echo $addressl1; ?></text> 
                      </div>
                      <div class="form-group">
                        <label for="address2">Address Line2:</label>
                        <text name="address2"><?php echo $addressl2; ?></text>
                      </div>
                      <div class="form-group">
                        <label for="postcode">Postcode:</label>
                        <text name="postcode1"><?php echo $postcode; ?></text>
                      </div>
                      <div class="form-group">
                        <label for="state">State/Province:</label>
                        <text name="state1"><?php echo $state; ?></text>
                      </div>
                      <div class="form-group">
                        <label for="country">Country:</label>
                        <text name="country"><?php echo $country; ?></text>
                      </div>
                      <form action="updateTrack.php" method="post">
                        <div class="form-group">
                            <input type="text" name="track" placeholder="track" required>
                            <button type='submit' name='addtrack'>submit</button>";
                        </div>
                      </form>
                  </div>
              </div>
        </div>
    </body>
</html>
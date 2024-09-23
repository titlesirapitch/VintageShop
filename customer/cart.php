<?php
    include("/MAMP/htdocs/project/connect.php");
    session_start();
?>

<?php
    if(empty($_SESSION['user_id'])){
        header("Location: /project/login.php");
    }
?>

<?php
    $uid = $_SESSION["user_id"];
    $srch_order = "SELECT c.prod_ID, p.prod_name, p.prod_price, p.image, c.amount 
                   FROM product p inner join cart c
                   on p.prod_ID = c.prod_ID
                   WHERE c.user_ID = $uid";
    $result_order = $mysqli->query($srch_order);
?>

<!doctype html>
<html>
    <head>
        <title>VINTAGE SHIRT SHOP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/project/customer/css/cart.css">
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
        <div class="mycart">
            <text> MY CART </text>
        </div>
            <section>
            <form action="cart.php" method="post">
                <div id="cart-container">
                    <div id="product-list">
                        <?php
                            $totalPrice = 0;
                            $shippingFee = 100;
                            $discount = 0;
                            $finalPrice = 0;

                            while($row_order = $result_order->fetch_array()){
                                $prodID[] = $row_order['prod_ID'];
                                $prodName[] = $row_order['prod_name'];
                                $prodPrice = $row_order['prod_price'];
                                $image[] = $row_order['image'];
                                $amount[] = $row_order['amount'];
                                $newPrice = explode(",", $prodPrice);
                                $newPrice = implode("", $newPrice);
                                $prices[] = $newPrice;
                            }
                            $result_order->free();
                            for($i=0; $i < count($prodID); $i++){
                                $totalPrice += $prices[$i]*$amount[$i];
                                echo "<div class='product' data-id='$prodID[$i]'>
                                        <tr>
                                            <td><img src='/project/admin/$image[$i]'</td>
                                            <td>$prodName[$i]</td><br>
                                            <div class='price'><td>฿$prices[$i]</td></div>
                                            <div class='product-actions'>
                                                <button type='submit' name='minus' value='$i'>-</button>
                                                <div class='quantity'>$amount[$i]</div>
                                                <button type='submit' name='plus' value='$i'>+</button>
                                            </div>
                                        </tr>
                                    </div>";
                            }

                            $finalPrice = $totalPrice + $shippingFee; 
                            $_SESSION['finalPrice'] = $finalPrice;

                            if(isset($_POST["apply"])){
                                $srch_code = "SELECT code_ID, code, discountPercentage, discountAmount FROM promo_code";
                                if(isset($_POST['promocode'])){
                                    $result_code = $mysqli->query($srch_code);
                                    while($row = $result_code->fetch_array()){
                                        if($_POST['promocode'] == $row['code']){
                                            $_SESSION['promocodeID'] = $row['code_ID'];
                                            if(isset($row['discountPercentage'])){
                                                $discount = $totalPrice * ($row['discountPercentage']/100);
                                                $finalPrice = $totalPrice - $discount + $shippingFee;
                                                $_SESSION['finalPricePrm'] = $finalPrice;
                                            }else{
                                                $discount = $row['discountAmount'];
                                                $finalPrice = $totalPrice - $discount + $shippingFee;
                                                $_SESSION['finalPricePrm'] = $finalPrice;
                                            }
                                        }
                                    }
                                    $result_code->free();
                                }
                            }

                            if(isset($_POST['minus'])){
                                $id = $_POST['minus'];
                                $oldAm = $amount[$id];
                                $newAmount = $oldAm - 1;
                                if($oldAm > 1){
                                    $updt_cart = "UPDATE cart SET amount = $newAmount WHERE prod_ID = $prodID[$id]";
                                    if($mysqli->query($updt_cart)){
                                        echo "Update Cart Successfully!";
                                        header("Location: cart.php");
                                    }else{
                                        echo "Update Cart Error: ".$mysqli->error;
                                        header("Location: cart.php");
                                    }
                                }else{
                                    $updt_cart = "DELETE FROM cart WHERE prod_ID = $prodID[$id]";
                                    if($mysqli->query($updt_cart)){
                                        echo "Update Cart Successfully!";
                                        header("Location: cart.php");
                                    }else{
                                        echo "Update Cart Error: ".$mysqli->error;
                                        header("Location: cart.php");
                                    }
                                }
                            }

                            if(isset($_POST['plus'])){
                                $id = $_POST['plus'];
                                $oldAm = $amount[$id];
                                $newAmount = $oldAm + 1;
                                $updt_cart = "UPDATE cart SET amount = $newAmount WHERE prod_ID = $prodID[$id]";
                                if($mysqli->query($updt_cart)){
                                    echo "Update Cart Successfully!";
                                    header("Location: cart.php");
                                }else{
                                    echo "Update Cart Error: ".$mysqli->error;
                                    header("Location: cart.php");
                                }
                            }

                        ?>
                        
                    </div>
            
                    <div id="address-container">
                        <h2>Shipping Address</h2><br>
                        <label for="address-input-type">Select Address:</label>
                        <select id="address-input-type" name="addressType" onchange="toggleAddressInput()">
                            <option value="address1">Address 1</option>
                            <option value="address2">Address 2</option>
                            <option value="newAddress">New Address</option>
                        </select><br>
            
                        <div id="predefined-addresses">
                        </div>
                            <div id="new-address-form">
                                <label for="address-line-1">Address Line 1:</label> <br>
                                <input type="text" id="address-line-1" name="address1"> <br>
                
                                <label for="address-line-2">Address Line 2:</label> <br>
                                <input type="text" id="address-line-2" name="address2"> <br>
                
                                <label for="country">Country:</label> <br>
                                <input type="text" id="country" name="country"> <br>
                
                                <label for="state">State/Province:</label> <br>
                                <input type="text" id="state" name="state"> <br>
                
                                <label for="postcode">Postcode:</label> <br>
                                <input type="text" id="postcode" name="postcode"> <br>
                
                                <label for="mobile-number">Mobile Number:</label> <br>
                                <input type="text" id="mobile-number" name="phone"> <br><br>
                            </div>
                
                            <br><div id="total-price">Total Price: <?php echo "$totalPrice ฿ THB"; ?></div>
                            <div id="shipping-fee">Shipping Fee: ฿100.00 ฿ THB</div>
                            <div id="discount-info">Discount: <?php echo "$discount ฿ THB"; ?></div>
                            <div id="final-price">Final Price: <?php echo "$finalPrice ฿ THB"; ?></div>
                
                            <input type="text" name="promocode" id="promo-code-input" placeholder="Enter promo code">
                            <button type="submit" name="apply">Apply</button><br>
                            
                            <button type="submit" id="checkout-btn" name="checkout">Checkout</button>
                    </div>
                </div>
                </form>
            </section>
            <script>
                function toggleAddressInput() {
                    var addressInputType = document.getElementById('address-input-type').value;
                    var predefinedAddresses = document.getElementById('predefined-addresses');
                    var newAddressForm = document.getElementById('new-address-form');
        
                    if (addressInputType === 'newAddress') {
                        predefinedAddresses.style.display = 'none';
                        newAddressForm.style.display = 'block';
                    } else {
                        predefinedAddresses.style.display = 'block';
                        newAddressForm.style.display = 'none';
                    }
                }
            </script>
        </body>
</html>

<?php
    if(isset($_POST['checkout'])){
        $userID = $_SESSION['user_id'];
        if(isset($_POST['addressType'])){
            if(($_POST['addressType'] == "address1")){
                $deliverAd = $_SESSION['address1'];
                $phone2 = $_SESSION['phone'];
            }else if(($_POST['addressType'] == "address2")){
                $deliverAd['deliverAd'] = $_SESSION['address2'];
                $phone2 = $_SESSION['phone'];
            }else{
                $address31 = $_POST['address1'];
                $address32 = $_POST['address2'];
                $country3 = $_POST['country'];
                $state3 = $_POST['state'];
                $postcode3 = $_POST['postcode'];
                $phone2 = $_POST['phone'];
                $address3 = array($address31, $address32, $postcode3, $state3, $country3);
                $deliverAd = implode(" ", $address3);
            }
            
            $srch_user = "SELECT using_promo FROM user WHERE user_ID = $userID";
            if($result = $mysqli->query($srch_user)){
                $row = $result->fetch_array();
                if($row['using_promo'] == 0){
                    $resetOID = "ALTER TABLE orders AUTO_INCREMENT = 1";
                    $q_order = "INSERT INTO orders(user_ID, deliveryAddress, phone)
                                VALUES ($userID, '$deliverAd', $phone2)";
                    $mysqli->query($resetOID);
                    if($mysqli->query($q_order)){
                        $_SESSION['orderID'] = $mysqli->insert_id;
                        $oid = $_SESSION['orderID'];
                        foreach($prodID as $id){
                            $q_contain = "INSERT INTO container(prod_ID, amount, order_ID)
                                        VALUES ((SELECT prod_ID FROM cart WHERE (prod_ID = $id AND user_ID = $userID)),
                                                (SELECT amount FROM cart WHERE (prod_ID = $id AND user_ID = $userID)),
                                                (SELECT order_ID FROM orders WHERE order_ID = $oid))";
                            if($mysqli->query($q_contain)){
                                echo "Insert Container Successfully!!";
                            }else{
                                echo "Insert Container Error: ".$mysqli->error;
                            }
                        }
                        if(isset($_SESSION['finalPricePrm'])){
                            $cid = $_SESSION['promocodeID'];
                            $updt_order = "UPDATE orders SET code_ID = $cid WHERE order_ID = $oid";
                            if($mysqli->query($updt_order)){
                                echo "Update Code Successfully!";
                                $updt_user = "UPDATE user SET using_promo = 1 WHERE user_ID = $userID";
                                if($mysqli->query($updt_user)){
                                    echo "Update User Successfully!";
                                    header("Location: payment.php");
                                }else{
                                    echo "Update User Failed: ".$mysqli->error;
                                }
                            }else{
                                echo "Update Code Failed: ".$mysqli->error;
                            }
                        }else{
                            echo "Insert Order Successfully!<br>";
                            header("Location: payment.php");
                        }
                    }else{
                        echo "Insert Order Failed: ".$mysqli->error;
                    }
                }else{
                    if(isset($_SESSION['finalPricePrm'])){
                        $_SESSION['finalPricePrm'] = null;
                        echo "You've already used the code";
                    }else{
                        $resetOID = "ALTER TABLE orders AUTO_INCREMENT = 1";
                        $q_order = "INSERT INTO orders(user_ID, deliveryAddress, phone)
                                    VALUES ($userID, '$deliverAd', $phone2)";
                        $mysqli->query($resetOID);
                        if($mysqli->query($q_order)){
                            $_SESSION['orderID'] = $mysqli->insert_id;
                            $oid = $_SESSION['orderID'];
                            echo "Insert Order Successfully!<br>";
                            foreach($prodID as $id){
                                $q_contain = "INSERT INTO container(prod_ID, amount, order_ID)
                                            VALUES ((SELECT prod_ID FROM cart WHERE (prod_ID = $id AND user_ID = $userID)),
                                                    (SELECT amount FROM cart WHERE (prod_ID = $id AND user_ID = $userID)),
                                                    (SELECT order_ID FROM orders WHERE order_ID = $oid))";
                                if($mysqli->query($q_contain)){
                                    echo "Insert Container Successfully!!";
                                }else{
                                    echo "Insert Container Error: ".$mysqli->error;
                                }
                            }   
                            header("Location: payment.php");
                        }else{
                            echo "Insert Order Failed: ".$mysqli->error;
                        }
                    }
                }
            }
        }
    }

?>
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
    $userID = $_SESSION['user_id'];
    $srch_info = "SELECT * FROM user_info WHERE user_ID = $userID";
    if($result_info = $mysqli->query($srch_info)){
        $row_info = $result_info->fetch_array();
        $fullname = $row_info["fName"]." ".$row_info["lName"];
        if(!empty($row_info['address1'])){
            $address = $row_info['address1'];
        }else{
            $address = $row_info['address2'];
        }
        $exp_address = explode(' ', $address);
        $billing_address = $exp_address[0]." ".$exp_address[1];
        $postcode = $exp_address[2];
        $province = $exp_address[3];
        $country = $exp_address[4];
    }
?>

<?php
    include("/MAMP/htdocs/project/customer/html/payment.html");
    $result_info->free();
?>

<?php
    if(isset($_POST['proceed'])){
        $cardhdName;
        $cardNum = $_POST['card_number'];
        $expM = $_POST['expMonth'];
        $expY = $_POST['expYear'];
        $cvcNum = $_POST['CVC'];
        $payment_method = $_POST['payment_method'];
        if((!empty($payment_method) && $payment_method != "-") && !empty($cardNum) 
            && !empty($expM) && !empty($expY) && !empty($cvcNum)){
            if(empty($_POST['cardhd_fullname']) && !empty($fullname)){
                $cardhdName = $fullname;
            }else if(!empty($_POST['cardhd_fullname'])){
                $cardhdName = $_POST['cardhd_fullname'];
            }else{
                echo "Please Enter Cardholder Name!!";
                exit();
            }
            $hash = password_hash($cvcNum, PASSWORD_BCRYPT);
            $resetCID = "ALTER TABLE credit_card AUTO_INCREMENT = 1";
            $q_card = "INSERT INTO credit_card (cardholder_name, card_no, expM, expY, CVC_no)
                       VALUES ('$cardhdName', '$cardNum', $expM, $expY, '$hash')";
            $mysqli->query($resetCID);
            if(!$mysqli->query($q_card)){
                echo "Insert Card Error: ".$mysqli->error;
            }else{
                echo "Insert Card Successfully!<br>";
                $cid = $mysqli->insert_id;
                $oid = $_SESSION['orderID'];
                $srch_order = "SELECT code_ID FROM orders WHERE order_ID = $oid";
                if($result = $mysqli->query($srch_order)){
                    $row = $result->fetch_array();
                    if(!empty($row["code_ID"])){
                        $amountPaid = $_SESSION['finalPricePrm'];
                    }else{
                        $amountPaid = $_SESSION['finalPrice'];
                    }
                }
                $resetPmID = "ALTER TABLE payment AUTO_INCREMENT = 1";
                $q_payment = "INSERT INTO payment (payment_method, amountPaid, credit_ID)
                             VALUES ('$payment_method', $amountPaid, 
                             (SELECT credit_ID FROM credit_card WHERE credit_ID = $cid))";
                $mysqli->query($resetPmID);
                if(!$mysqli->query($q_payment)){
                    echo "Insert Payment Error: ".$mysqli->error;
                }else{
                    echo "Insert Payment Successfully!<br>";
                    $billName;
                    $pid = $mysqli->insert_id;
                    $updt_order = "UPDATE orders SET payment_ID = $pid WHERE order_ID = $oid";
                    if($mysqli->query($updt_order)){
                        echo "Update Order Successfully!";
                        $uid = $_SESSION["user_id"];
                        $del_cart = "DELETE FROM cart WHERE user_ID = $uid";
                        if($mysqli->query($del_cart)){
                            echo "Delete Cart Successfully!";
                        }else{
                            echo "Delete Cart Failed: ".$mysqli->error;
                        }
                    }else{
                        echo "Update Order Failed: ".$mysqli->error;
                    }
                    if(empty($_POST['fullname']) && !empty($fullname)){
                        $billName = $fullname;
                    }else if(!empty($_POST['fullname'])){
                        $billName = $_POST['fullname'];
                    }
                    if(!empty($_POST['billing_address']) && !empty($_POST['province']) 
                        && !empty($_POST['zipcode']) && !empty($_POST['country'])){
                        $billing_address = $_POST['billing_address'];
                        $province = $_POST['province'];
                        $postcode = $_POST['zipcode'];
                        $country = $_POST['country'];
                    }
                    $resetBID = "ALTER TABLE bill AUTO_INCREMENT = 1";
                    $q_bill = "INSERT INTO bill (name, billingAddress, city, ZIP_code, country, payment_ID)
                               VALUES ('$billName', '$billing_address', '$province', $postcode, '$country',
                              (SELECT payment_ID FROM payment WHERE payment_ID = $pid))";
                    $mysqli->query($resetBID);
                    if(!$mysqli->query($q_bill)){
                        echo "Insert Bill Error: ".$mysqli->error;
                    }else{
                        echo "Insert Bill Successfully!";
                        header("Location: order.php");
                    }    
                }
            }
        }
    }else if(isset($_POST['return'])){
        $oid = $_SESSION['orderID'];
        $del_contain = "DELETE FROM container WHERE order_ID = $oid";
        $del_order = "DELETE FROM orders WHERE order_ID = $oid";
        if($mysqli->query($del_contain)){
            echo "Delete Container Successfully!";
            if($mysqli->query($del_order)){
                echo "Delete Order Successfully!";
                header("Location: /project/customer/cart.php");
            }else{
                echo "Delete Order Failed: ".$mysqli->error;
                header("Location: /project/customer/cart.php");
            }
        }else{
            echo "Delete Container Failed: ".$mysqli->error;
            header("Location: /project/customer/cart.php");
        }
    }
?>
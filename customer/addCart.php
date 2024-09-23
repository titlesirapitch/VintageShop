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
    $pid = $_GET['id'];
    $page = $_GET['page'];
    $uid = $_SESSION["user_id"];
    $srch_cart = "SELECT prod_ID, amount FROM cart WHERE (prod_ID = $pid AND user_ID = $uid)";
    if($result = $mysqli->query($srch_cart)){
        $row = $result->fetch_array();
        if(empty($row)){
            $result->free();
            $resetID = "ALTER TABLE cart AUTO_INCREMENT = 1";
            $q_addCart = "INSERT INTO cart (amount, user_ID, prod_ID)
                          VALUES (1, (SELECT user_ID FROM user WHERE user_ID = $uid), 
                                     (SELECT prod_ID FROM product WHERE prod_ID = $pid))";
            $mysqli->query($resetID);
            if($mysqli->query($q_addCart)){
                echo "Insert Cart Successfully!";
                header("Location: $page");
            }else{
                echo "Insert Cart Error: ".$mysqli->error;
                header("Location: $page");
            }
        }else{
            $newAmount = $row['amount'] + 1;
            $updt_cart = "UPDATE cart SET amount = $newAmount WHERE prod_ID = $pid";
            if($mysqli->query($updt_cart)){
                echo "Update Cart Successfully!";
                header("Location: $page");
            }else{
                echo "Update Cart Error: ".$mysqli->error;
                header("Location: $page");
            }
        }
    }
?>
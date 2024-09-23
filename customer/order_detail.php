<?php
    include("/MAMP/htdocs/project/connect.php");
    session_start();
?>

<?php
    $pID = $_GET['id'];
    $uID = $_SESSION["user_id"];
    $srch_order = "SELECT p.image, p.prod_name, p.prod_price, c.amount, c.tracking_no, o.deliveryAddress
                   FROM (product p JOIN container c ON p.prod_ID = c.prod_ID) JOIN orders o ON o.order_ID = c.order_ID
                   WHERE (p.prod_ID = $pID AND o.user_ID = $uID)";
    if($result_prod = $mysqli->query($srch_order)){
        $row_prod = $result_prod->fetch_array();
        $prod_name = $row_prod["prod_name"];
        $prod_price = $row_prod["prod_price"];
        $prod_amount = $row_prod["amount"];
        $prod_detail = $row_prod["prod_detail"];
        $image = $row_prod["image"];
        $trachNo = $row_prod["tracking_no"];
        $deliverAd = $row_prod['deliveryAddress'];
        $ads = explode(" ", $deliverAd);
        $addressl1 = $ads[0];
        $addressl2 = $ads[1];
        $postcode = $ads[2];
        $state = $ads[3];
        $country = $ads[4];
    }else{
        echo "Error: ".$mysqli->error;
        header("Location: /project/customer/order.php");
    }
?>

<?php
    if(empty($_SESSION['user_id'])){
        header("Location: /project/login.php");
    }
?>

<?php
    include("/MAMP/htdocs/project/customer/html/order_detail_cus.html");
?> 
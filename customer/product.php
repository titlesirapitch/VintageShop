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
    $pID = $_GET['id'];
    $_SESSION['pID'] = $pID;
    $srch_prod = "SELECT * FROM product WHERE prod_ID = $pID";
    if($result_prod = $mysqli->query($srch_prod)){
        $row_prod = $result_prod->fetch_array();
        $prod_name = $row_prod["prod_name"];
        $prod_price = $row_prod["prod_price"];
        $prod_amount = $row_prod["amount"];
        $prod_detail = $row_prod["prod_detail"];
        $image = $row_prod["image"];
    }
?>

<?php
    include("/MAMP/htdocs/project/customer/html/product.html");
?>
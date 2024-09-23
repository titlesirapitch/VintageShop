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
    if(isset($_POST['search'])){
        if(!empty($_POST['searchTxt'])){
            $txt = $_POST['searchTxt'];
            $srch_prod = "SELECT prod_ID FROM product WHERE prod_name LIKE '%$txt%'";
            if($result = $mysqli->query($srch_prod)){
                $row = $result->fetch_array();
                $pid = $row["prod_ID"];
                header("Location: /project/customer/product.php?id=$pid");
            }
            // else{
            //     echo "Error: ".$mysqli->error;
            // }
        }
    }
?>
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
    $pid = $_GET['pid'];
    $oid = $_GET['oid'];
    $delStatus;
    $srch_con = "SELECT deliveryStatus FROM container WHERE (prod_ID = $pid AND order_ID = $oid)";
    if($result = $mysqli->query($srch_con)){
        $row = $result->fetch_array();
        if($row['deliveryStatus'] == 0){
            $delStatus = 1;
        }else{
            $delStatus = 0;
        }
        $updt_con = "UPDATE container SET deliveryStatus = $delStatus WHERE (prod_ID = $pid AND order_ID = $oid)";
        if($mysqli->query($updt_con)){
            echo "Update Track No. Successfully!";
            header("Location: /project/admin/viewOrder.php");
        }else{
            echo "Update Track No. Failed: ".$mysqli->error;
            header("Location: /project/admin/viewOrder.php");
        }
    }    
?>
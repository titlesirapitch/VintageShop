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
    if(isset($_POST['addtrack'])){
        $pid = $_SESSION['pID'];
        $oid = $_SESSION['oID'];
        if(!empty($_POST['track'])){
            $trackNo = $_POST['track'];
            $updt_con = "UPDATE container SET tracking_no = '$trackNo' WHERE (prod_ID = $pid AND order_ID = $oid)";
            if($mysqli->query($updt_con)){
                echo "Update Track No. Successfully!";
                header("Location: /project/admin/viewOrder.php");
            }else{
                echo "Update Track No. Failed: ".$mysqli->error;
                header("Location: /project/admin/order_detail.php?pid=$pid&oid=$oid");
            }
        }
    }
?>
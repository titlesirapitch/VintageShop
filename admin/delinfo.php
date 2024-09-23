<?php
    session_start();
    if(empty($_SESSION['m_id'])){
        header("Location: /project/login.php");
    }
?>

<?php
    include("/MAMP/htdocs/project/connect.php");
    $codeID = $_GET['id'];
    $delCode = "DELETE FROM promo_code WHERE code_ID = $codeID";
    if(!$mysqli->query($delCode)){
        echo "Delete Code Error: ".$mysqli->error;
        header("Location: addPromo.php");
    }
    $mysqli->close();
    header("Location: addPromo.php");
?>
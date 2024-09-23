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
    $userID = $_SESSION["user_id"];
    include("sessionVar.php");
?>

<?php
    include("/MAMP/htdocs/project/customer/html/profile.html");
?>

<?php
    if(isset($_POST['edit'])){
        header("Location: /project/customer/html/profile_edit.html");
    }
    elseif(isset($_POST['logout'])){
        session_destroy();
        header("Location: /project/login.php");
    }
?>
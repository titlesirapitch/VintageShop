<?php
    session_start();
    if(empty($_SESSION['m_id'])){
        header("Location: /project/login.php");
    }
?>

<?php
    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: /project/login.php");
    }else if(isset($_POST["admin"])){
        header("Location: /project/admin/viewOrder.php");
    }
?>
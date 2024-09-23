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
    $hash = password_hash("sponge12", PASSWORD_BCRYPT);
    $resetID = "ALTER TABLE manager auto_increment = 1";
    $q = "INSERT INTO manager(fName, lName, email, username, password)
          VALUES ('Spongebob','Squarepants', 'sponge321@gmail.com', 'spongebob123','$hash')";
    $mysqli->query($resetID);
    if(!$mysqli->query($q)){
        echo "INSERT failed. Error: ".$mysqli->error;
    }
?>
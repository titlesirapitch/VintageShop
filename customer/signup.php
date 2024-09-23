<?php
    include("/MAMP/htdocs/project/connect.php");
?>

<?php
    if(empty($_SESSION['user_id'])){
        header("Location: /project/login.php");
    }
?>

<?php
    $email = $_POST["email"];
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $confPass = filter_input(INPUT_POST, "confPass", FILTER_SANITIZE_SPECIAL_CHARS);

    if(isset($_POST["signup"])){
        if(!empty($email)){
            if(!empty($username)){
                if(!empty($password)){
                    if(!empty($confPass)){
                        if($password == $confPass){
                            $hash = password_hash($password, PASSWORD_BCRYPT);
                            $resetID = "ALTER TABLE user auto_increment = 1";
                            $q = "INSERT INTO user(email, username, password)
                                  VALUES ('$email', '$username', '$hash')";
                            $mysqli->query($resetID);
                            if(!$mysqli->query($q)){
                                echo "INSERT failed. Error: ".$mysqli->error;
                                header("Location: /project/customer/html/signup.html");
                            }else{
                                header("Location: /project/login.php");
                            }
                        }else{
                            echo "You entered the wrong password!";
                            header("Location: /project/customer/html/signup.html");
                        }
                    }else{
                        echo "Please fill your Confirm Password!";
                        header("Location: /project/customer/html/signup.html");
                    }     
                }else{
                    echo "Please fill your Password!";
                    header("Location: /project/customer/html/signup.html");
                }
            }else{
                echo "Please fill your Username!";
                header("Location: /project/customer/html/signup.html");
            }
        }else{
            echo "Please fill your Email!";
            header("Location: /project/customer/html/signup.html");
        }
    }
?>
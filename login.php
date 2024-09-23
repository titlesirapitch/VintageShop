<?php
    session_start();
    include("/MAMP/htdocs/project/connect.php");
?>

<!doctype html>
<html>
    <head>
        <title>VINTAGE SHIRT SHOP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/project/login.css">
    </head>
   
    <body>
        <div class="container">
            <div class="box">
                <div class="box-login">
                    <div class="logo">
                        <img src="/project/customer/html/photo/logo.png">
                    </div>
                    <form action="/project/login.php" method="post">
                        <div class="input-group">
                            <div class="input-field">
                                <input type="text" class="input-box" name="username" required>
                                <label for="logusername">Username</label>
                            </div>
                            <div class="input-field">
                                <input type="password" class="input-box" name="password" required>
                                <label for="logPassword">Password</label>
                            </div>
                            <div class="input-field submit-box">
                                <input type="submit" class="input-submit" name="login" value="Sign In" required></a>
                            </div> 
                        </div>
                    </form>
                    <div class="createaccount">
                        <a href="/project/customer/html/signup.html">CREATE AN ACCOUNT</a>
                    </div>  
                </div> 
            </div>
        </div>
    </body>
</html>

<?php
    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $q_user = "SELECT * FROM user WHERE username = '$username'";
        $q_admin = "SELECT * FROM manager WHERE username = '$username'";
        if(!$mysqli->query($q_user) || !$mysqli->query($q_admin)){
            echo "Error: ".$mysqli->error;
            header("Location: /project/login.php");
        }else{
            $result_user = $mysqli->query($q_user);
            $row_user = $result_user->fetch_array();
            if($username == $row_user['username']){
                if(password_verify($password, $row_user['password'])){
                    $_SESSION["user_id"] = $row_user["user_ID"];
                    $userID = $_SESSION["user_id"];
                    $_SESSION["email"] = $row_user['email'];
                    $_SESSION["username"] = $username;
                    include("/MAMP/htdocs/project/customer/sessionVar.php");
                    header("Location: /project/customer/homepage.php");
                }else{
                    header("Location: /project/login.php");
                    echo "Please enter the correct Password!!";
                }
            }else if($username != $row_user['username']){
                $result_admin = $mysqli->query($q_admin);
                $row_admin = $result_admin->fetch_array();
                if($username == $row_admin['username']){
                    if(password_verify($password, $row_admin['password'])){
                        $_SESSION['m_id'] = $row_admin['M_id'];
                        $_SESSION['username'] = $username;
                        $fname = $row_admin['fName'];
                        $lname = $row_admin['lName'];
                        $_SESSION['name'] = $fname." ".$lname;
                        header("Location: /project/admin/homepage.php");
                    }else{
                        header("Location: /project/login.php");
                        echo "Please enter the correct Password!!";
                    }
                }
            }else{
                header("Location: /project/login.php");
                echo "Please enter the correct Username!!";
            }
        }
    }
?>
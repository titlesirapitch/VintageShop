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
    if(isset($_POST['save'])){
        include('profileVar.php');
        $userID = $_SESSION['user_id'];
        if(!empty($image)){
            $imageName = $image['name'];
            $tmp_name = $image['tmp_name'];
            $file_extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $allowed_exs = array("jpeg", "jpg", "png");
            if(in_array($file_extension, $allowed_exs)){
                // $new_img_name = uniqid("IMG-", true).'.'.$file_extension;
                $upload_path = 'usersImage/'.$imageName;
                move_uploaded_file($tmp_name, $upload_path);
                $updt_img = "UPDATE user_info
                            SET image = '$upload_path'
                            WHERE user_ID = $userID";
                if(!$mysqli->query($updt_img)){
                    echo "Image Error: ".$mysqli->error;
                    header("Location: profile.php");
                }else{
                    echo "Update Image Successfully!";
                    header("Location: profile.php");
                }
            }
        }
        
        if(!empty($email_new)){
            $updt_email = "UPDATE user
                           SET email = '$email_new'
                           WHERE user_ID = $userID";
            if(!$mysqli->query($updt_email)){
                echo "Email Error: ".$mysqli->error;
                header("Location: profile.php");
            }else{
                echo "Update Email Successfully!";
                header("Location: profile.php");
            }
        }

        if(!empty($firstname) && !empty($lastname) && !empty($dob) && !empty($phone)){
            $srch_info = "SELECT * FROM user_info WHERE user_ID = $userID";
            if($result_info = $mysqli->query($srch_info)){
                $row_info = $result_info->fetch_array();
                $_SESSION['info_id'] = $row_info['info_ID'];
                if(isset($row_info['fName'])){
                    $updt_info = "UPDATE user_info 
                             SET fName = '$firstname', lName = '$lastname', DOB = '$dob', phone = '$phone'
                             WHERE user_ID = $userID";
                    if(!$mysqli->query($updt_info)){
                        echo "Update Info Error: ".$mysqli->error;
                        header("Location: profile.php");
                    }else{
                        echo "Update Info Successfully!";
                        header("Location: profile.php");
                    }
                }else{
                    $resetID = "ALTER TABLE user_info auto_increment = 1";
                    $q_info = "INSERT INTO user_info(fName, lName, DOB, phone, user_ID)
                          VALUES ('$firstname', '$lastname', '$dob', '$phone',
                          (SELECT user_ID FROM user WHERE user_ID = $userID))";
                    $mysqli->query($resetID);
                    if(!$mysqli->query($q_info)){
                        echo "Insert Info Error: ".$mysqli->error;
                        header("Location: profile.php");
                    }else{
                        echo "Insert Info Successfully!";
                        header("Location: profile.php");
                    }
                }
            }else{
                echo "Retrieve Info Error: ".$mysqli->error;
            }
        }else{
            echo "Please fill in Firstname, Surname, Date of Birth, and Mobile Number!!<br>";
            header("Location: profile.php");
        }

        if((!empty($address11)&& !empty($address12)&& !empty($postcode1)&& !empty($state1)&& !empty($country1))){
            $updt_ad1 = "UPDATE user_info 
                        SET address1 = '$address11 $address12 $postcode1 $state1 $country1'
                        WHERE user_ID = $userID";
            if(!$mysqli->query($updt_ad1)){
                echo "Address 1 Error: ".$mysqli->error;
                header("Location: profile.php");
            }else{
                echo "Update Address 1 Successfully!";
                header("Location: profile.php");
            }
        }else{
            echo "Please fill in your Address 1";
            header("Location: profile.php");
        }

        if((!empty($address21)&& !empty($address22)&& !empty($postcode2)&& !empty($state2)&& !empty($country2))){
            $updt_ad2 = "UPDATE user_info 
                        SET address2 = '$address21 $address22 $postcode2 $state2 $country2'
                        WHERE user_ID = $userID";
            if(!$mysqli->query($updt_ad2)){
                echo "Address 2 Error: ".$mysqli->error;
                header("Location: profile.php");
            }else{
                echo "Update Address 2 Successfully!";
                header("Location: profile.php");
            }
        }else{
            echo "Please fill in your Address 2";
            header("Location: profile.php");
        }
    }
    elseif(isset($_POST["return"])){
        header("Location: profile.php");
    }
?>
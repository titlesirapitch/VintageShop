<?php
    session_start();
    if(empty($_SESSION['user_id'])){
        header("Location: /project/login.php");
    }
?>

<?php
    $srch_info = "SELECT ui.info_ID, ui.fName, ui.lName, ui.DOB, ui.phone, 
                         ui.image, ui.address1, ui.address2, u.email
                  FROM user_info ui RIGHT JOIN user u
                  ON ui.user_ID = u.user_ID
                  WHERE u.user_ID = $userID";
    if($result_info = $mysqli->query($srch_info)){
        $row = $result_info->fetch_array();
        $_SESSION['info_id'] = $row['info_ID'];
        $_SESSION['firstname'] = $row['fName'];
        $_SESSION['lastname'] = $row['lName'];
        $_SESSION['dob'] = $row['DOB'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['image'] = $row['image'];
        $_SESSION['email'] = $row['email'];
        if(!empty($row['address1'])){
            $_SESSION['address1'] = $row['address1'];
            $ads1 = explode(" ", $_SESSION['address1']);
            $_SESSION['address11'] = $ads1[0];
            $_SESSION['address12'] = $ads1[1];
            $_SESSION['postcode1'] = $ads1[2];
            $_SESSION['state1'] = $ads1[3];
            $_SESSION['country1'] = $ads1[4];
        }
        if(!empty($row['address2'])){
            $_SESSION['address2'] = $row['address2'];
            $ads2 = explode(" ", $_SESSION['address2']);
            $_SESSION['address21'] = $ads2[0];
            $_SESSION['address22'] = $ads2[1];
            $_SESSION['postcode2'] = $ads2[2];
            $_SESSION['state2'] = $ads2[3];
            $_SESSION['country2'] = $ads2[4];
        }
    }else{
        echo "Retrieve Info Error: ".$mysqli->error;
    }
?>
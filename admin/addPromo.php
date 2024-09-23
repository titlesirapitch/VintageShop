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
    include("/MAMP/htdocs/project/admin/html/view_promocode.html");
?>

<?php
    if (isset($_POST['addCode'])){
        $code = $_POST['code'];
        $codeType = $_POST['code_type'];
        $discount = $_POST['discount'];
        $sDate = $_POST['sDate'];
        $eDate = $_POST['eDate'];
        $amount = $_POST['amount'];
        if (!empty($code) && ($codeType != "-") && !empty($discount) 
            && !empty($sDate) && !empty($eDate) && !empty($amount)){
            $sYear = date('y', strtotime($sDate)); $sMonth = date('n', strtotime($sDate));
            $stDate = date('j', strtotime($sDate)); $eYear = date('y', strtotime($eDate));
            $eMonth = date('n', strtotime($eDate)); $edDate = date('j', strtotime($eDate));
            if((($sYear <= $eYear) && ($sMonth <= $eMonth) && ($stDate <= $edDate))){
                $mID = $_SESSION['m_id'];
                $resetID = "ALTER TABLE promo_code AUTO_INCREMENT = 1";
                $mysqli->query($resetID);
                $cdType = null;
                $disType = null;
                if($codeType == "Percentage"){
                    $cdType = "percentage";
                    $disType = "discountPercentage";
                }else{
                    $cdType = "Amount";
                    $disType = "discountAmount";
                }
                $q_code = "INSERT INTO promo_code (code, amount, start_date, end_date, 
                                                    code_type, $disType, M_ID)
                           VALUES ('$code', $amount, '$sDate', '$eDate', '$cdType', 
                                    $discount, (SELECT M_ID FROM manager WHERE M_ID = $mID))";
                if(!$mysqli->query($q_code)){
                    echo "Insert Code Error: ".$mysqli->error;
                }else{
                    echo "Insert Code Successfully!";
                    header("Location: addPromo.php");
                }
            }else{
                echo "Please Enter the Correct End Date!!";
            }
        }else{
            echo "Please Fill All the Information and Choose the Correct Code Type!!";
        }
    }
?>
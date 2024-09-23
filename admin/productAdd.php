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
    if(isset($_POST['add'])){
        $productName = $_POST['productName'];
        $productPrice = $_POST["productPrice"];
        $productDetails = $_POST["productDetails"];
        $productAmount = $_POST['productAmount'];
        $productImage = $_FILES['photo'];
        $productType = $_POST['producttype'];
        $mID = $_SESSION['m_id'];
        if(!empty($productName) && !empty($productPrice) && !empty($productDetails) && !empty($productAmount) 
            && isset($productImage) && (!empty($productType) && ($productType != "-"))){
            $imageName = $productImage['name'];
            $tmp_name = $productImage['tmp_name'];
            $file_extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $allowed_exs = array("jpeg", "jpg", "png");
            if(in_array($file_extension, $allowed_exs)){
                // $new_img_name = uniqid("IMG-", true).'.'.$file_extension;
                $upload_path = 'prodImage/'.$imageName;
                move_uploaded_file($tmp_name, $upload_path);
                $resetID = "ALTER TABLE product auto_increment = 1";
                $q_prod = "INSERT INTO product (prod_name, prod_detail, prod_price, amount, image, prod_type, M_ID)
                           VALUES ('$productName', '$productDetails', '$productPrice', $productAmount, 
                                   '$upload_path', '$productType', (SELECT M_ID FROM manager WHERE M_ID = $mID))";
                $mysqli->query($resetID);
                if($mysqli->query($q_prod)){
                    echo "Insert Product Successfully!";
                    header("Location: /project/admin/html/add_product.html");
                }
            }
        }else{
            header("Location: /project/admin/html/add_product.html");
        }
    }
?>
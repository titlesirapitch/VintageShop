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
    include("/MAMP/htdocs/project/admin/html/edit_product.html");
?> 

<?php
    if(isset($_POST['save'])){
        $prodID = $_SESSION['pID'];
        if(!empty($_FILES['photo'])){
            $image = $_FILES['photo'];
            $imageName = $image['name'];
            $tmp_name = $image['tmp_name'];
            $file_extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $allowed_exs = array("jpeg", "jpg", "png");
            if(in_array($file_extension, $allowed_exs)){
                // $new_img_name = uniqid("IMG-", true).'.'.$file_extension;
                $upload_path = 'prodImage/'.$imageName;
                move_uploaded_file($tmp_name, $upload_path);
                $updt_prod = "UPDATE product SET image = '$upload_path' WHERE prod_ID = $prodID";
                if($mysqli->query($updt_prod)){
                    echo "Update Image Successfully!";
                    header("Location: /project/admin/product.php?id=$prodID");
                }else{
                    echo "Update Product Failed: ".$mysqli->error;
                    header("Location: /project/admin/productEdit.php?id=$prodID");
                }
            }
        }
        if(!empty($_POST['productName'])){
            $prodName = $_POST['productName'];
            $updt_prod = "UPDATE product SET prod_name = '$prodName' WHERE prod_ID = $prodID";
            if($mysqli->query($updt_prod)){
                echo "Update Product Name Successfully!";
                header("Location: /project/admin/product.php?id=$prodID");
            }else{
                echo "Update Product Failed: ".$mysqli->error;
                header("Location: /project/admin/productEdit.php?id=$prodID");
            }
        }
        if(!empty($_POST['producttype']) && ($_POST['producttype'] != "-")){
            $prodType = $_POST['producttype'];
            $updt_prod = "UPDATE product SET prod_type = '$prodType' WHERE prod_ID = $prodID";
            if($mysqli->query($updt_prod)){
                echo "Update Product Type Successfully!";
                header("Location: /project/admin/product.php?id=$prodID");
            }else{
                echo "Update Product Failed: ".$mysqli->error;
                header("Location: /project/admin/productEdit.php?id=$prodID");
            }
        }
        if(!empty($_POST['productPrice'])){
            $prodPrice = $_POST['productPrice'];
            $updt_prod = "UPDATE product SET prod_price = '$prodPrice' WHERE prod_ID = $prodID";
            if($mysqli->query($updt_prod)){
                echo "Update Product Price Successfully!";
                header("Location: /project/admin/product.php?id=$prodID");
            }else{
                echo "Update Product Failed: ".$mysqli->error;
                header("Location: /project/admin/productEdit.php?id=$prodID");
            }
        }
        if(!empty($_POST['productAmount'])){
            $prodAmount = $_POST['productAmount'];
            $updt_prod = "UPDATE product SET amount = $prodAmount WHERE prod_ID = $prodID";
            if($mysqli->query($updt_prod)){
                echo "Update Product Amount Successfully!";
                header("Location: /project/admin/product.php?id=$prodID");
            }else{
                echo "Update Product Failed: ".$mysqli->error;
                header("Location: /project/admin/productEdit.php?id=$prodID");
            }
        }
        if(!empty($_POST['productDetails'])){
            $prodDetail = $_POST['productDetails'];
            $updt_prod = "UPDATE product SET prod_detail = '$prodDetail' WHERE prod_ID = $prodID";
            if($mysqli->query($updt_prod)){
                echo "Update Product Detail Successfully!";
                header("Location: /project/admin/product.php?id=$prodID");
            }else{
                echo "Update Product Failed: ".$mysqli->error;
                header("Location: /project/admin/productEdit.php?id=$prodID");
            }
        }
    }else if(isset($_POST['cancel'])){
        $prodID = $_SESSION['pID'];
        header("Location: /project/admin/product.php?id=$prodID");
    }
?>
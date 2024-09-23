<?php
    session_start();
    if(empty($_SESSION['user_id'])){
        header("Location: /project/login.php");
    }
?>

<?php
    $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
    $image = $_FILES['photo'];
    $email = $_SESSION['email'];
    $email_new = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $dob = $_POST['dob'];
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);
    $address11 = filter_input(INPUT_POST, "address11", FILTER_SANITIZE_SPECIAL_CHARS);
    $address12 = filter_input(INPUT_POST, "address12", FILTER_SANITIZE_SPECIAL_CHARS);
    $postcode1 = filter_input(INPUT_POST, "postcode1", FILTER_SANITIZE_NUMBER_INT);
    $state1 = filter_input(INPUT_POST, "state1", FILTER_SANITIZE_SPECIAL_CHARS);
    $country1 = filter_input(INPUT_POST, "country1", FILTER_SANITIZE_SPECIAL_CHARS);
    $address21 = filter_input(INPUT_POST, "address21", FILTER_SANITIZE_SPECIAL_CHARS);
    $address22 = filter_input(INPUT_POST, "address22", FILTER_SANITIZE_SPECIAL_CHARS);
    $postcode2 = filter_input(INPUT_POST, "postcode2", FILTER_SANITIZE_NUMBER_INT);
    $state2 = filter_input(INPUT_POST, "state2", FILTER_SANITIZE_SPECIAL_CHARS);
    $country2 = filter_input(INPUT_POST, "country2", FILTER_SANITIZE_SPECIAL_CHARS);
?>
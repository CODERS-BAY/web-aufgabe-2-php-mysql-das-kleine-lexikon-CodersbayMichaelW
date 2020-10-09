<?php
session_start();
require_once('../inc/login.inc.php');

if(isset($_GET['register'])) {
    $error = false;
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_POST['password2']));
    $familyname = trim(htmlspecialchars($_POST['familyname']));
    $forename = trim(htmlspecialchars($_POST['forename']));
    $username = trim(htmlspecialchars($_POST['username']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Pls enter a valid e-mail adress<br/>';
        $error = true;
    }
    if (strlen($password) == 0) {
        echo 'Pls enter a password<br/>';
        $error = true;
    }
    if ($password != $password2) {
        echo 'Both passwords has to be identical<br/>';
        $error = true;
    }

    if(!$error) {
        $stmt = $connection->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            echo '<p class="bg-danger text-white m-5 p-5 text-center">The email-adresse ist already in use</p>';
            $error = true;
        }
    }

    // no errors
    if(!$error) {
        // prepare sql and bind parameters
        $stmt = $connection->prepare("INSERT INTO user (username, email, forename, familyname, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $forename, $familyname, $hash);

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt->execute();
        $stmt->close();
        $connection->close();

        $_SESSION['username'] = $username;
        // redirect user
        header("Location: ../index.php");
    }
}
?>
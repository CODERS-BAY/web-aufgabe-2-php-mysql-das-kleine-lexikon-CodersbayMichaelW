<?php session_start();
require_once('../inc/login.inc.php');
$location = "Location: ";
/**
 * Anmeldung
 */
if (isset($_GET['login'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
    //Benutzereingaben validieren
    if (!empty($username) && !empty($password)) {
        $query = $connection->prepare("SELECT username, password FROM user WHERE username = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $query->bind_result($username, $passwordDB);
        $query->store_result();
        if ($query->num_rows() == 1) {
            if ($query->fetch()) {
                if (password_verify($password, $passwordDB)) {
                    $_SESSION['username'] = $username;
                    //redirect to secret.php
                    $location .= "secret.php";
                }
            }
        } 
        else {
            // $error = 'Ihre Anmeldedaten sind nicht korrekt. Bitte wiederholen Sie den Vorgang.';
            $location .= "../index.php";
            $error = "Username or Password is incorrect.";
        }
    } 
    // the login checks if the inputs are filled out -> not possible
    else {
        // $error = "Bitte f&uuml;llen Sie alle Felder aus.";
        $location .= "../index.php";
        $error = "";
    }
}
// the login checks if the inputs are filled out -> not possible
else {
    $error = NULL;
    $username = NULL;
    $location .= "../index.php";
}
// redirection
header($location);
?>
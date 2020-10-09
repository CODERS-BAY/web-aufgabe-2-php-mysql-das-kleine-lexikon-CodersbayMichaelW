<?php session_start();
require_once('../inc/login.inc.php'); ?>
<?php
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
                    //redirect to index.php
                    header("Location: secret.php");
                }
            }
        } else {
            $error = 'Ihre Anmeldedaten sind nicht korrekt. Bitte wiederholen Sie den Vorgang.';
        }
    } else {
        $error = "Bitte f&uuml;llen Sie alle Felder aus.";
    }
} else {
    $error = NULL;
    $username = NULL;
}
?>

<!-- <?php
// session_start();
// require_once('../inc/login.inc.php');

// if(isset($_GET['login'])) {
//     $username = trim(htmlspecialchars($_POST['username']));
//     $password = trim(htmlspecialchars($_POST['password']));

//     // input validation
//     if(!empty($username) && !empty($password)) {
//         $query = $connection->prepare('SELECT username, password FROM user WHERE username = ?');

//         $password = password_hash($password, PASSWORD_DEFAULT);
//         $query->bind_param('s', $username);
//         $query->execute();
//         $query->store_result();
//         $query->bind_result($username, $password);
//         if($query->num_rows != 1) {
//             $error = 'Your login details are not correct. Pls repeat your input again.';
//         }
//         else {
//             var_dump($username); // Debug
//             $_SESSION['username'] = $username;
//             // Redirect user to index.php
//             header("Location: ../index.php");
//         }
//     }
//     else {
//         $error = "Pls fill out all the forms correct.";
//     }
// }
// else {
//     $error = NUll;
//     $email = NULL;
// }

?> -->
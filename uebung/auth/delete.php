<?php

define('SECURE', true);
include('../inc/login.inc.php');

if(!empty($_POST)) {
    $output = '';
    $message = '';

    if ($_POST['entry_id'] != NULL) {
        if ($_POST['deleteIMG'] != NULL) {
            $target_dir = "../img/";
            $checkFile = $_POST['deleteIMG'];
            if (file_exists($target_dir.$checkFile)) {
                unlink($target_dir.$checkFile);
            }
        }
    }

    $stmt = $connection->prepare("DELETE FROM content WHERE id=?");

    if (false === $stmt) {
        die('prepare() failed: ' . htmlspecialchars($connection->error));
    }

    $id = $_POST['entry_id'];
    $rc = $stmt->bind_param('s', $id);

    if (false === $rc) {
        die('bind_param() failed ' . htmlspecialchars($stmt->error));
    }

    $result = $stmt->execute();
    $message = 'Data Delete';

    if ($result) {
        $output .= '<label class="text-success">' . $message . '</label>';
        $result = $connection->query("SELECT * FROM content ORDER BY id ASC");
        echo $output;

        while ($entry = $result->fetch_assoc()) {
            $output = include('../inc/dataTable.inc.php');
        }
    }
    
}

?>
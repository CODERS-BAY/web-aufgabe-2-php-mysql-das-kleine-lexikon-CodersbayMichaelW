<?php
define('SECURE', true);

session_start();
    include('login.inc.php');

    // print_r($_REQUEST);
    $entryID = $_REQUEST['lexikonID'];

    $qeury = "SELECT title, imgpath, description FROM content WHERE id = " . $entryID;
    $result = $connection->query($qeury);

    $response = "<div class='modal-header'>";

    while($row = $result->fetch_assoc()) {
        $response .= "<h5 class='modal-title' id='exampleModalLabel'>" . $row['title'] . "</h5>";
        $response .= "<button type='button' class='close my-close-btn' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
        $response .= "</div>";
        $response .= "<div class='modal-body'>";

        $response .= "<img src='img/" . $row['imgpath'] . "' class='card-img-top pb-2' alt='...'>";

        $response .= $row['description'];
        $response .= "</div>";
    }
    echo $response;
    exit;
?>


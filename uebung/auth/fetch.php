<?php
include("../inc/login.inc.php");

if(isset($_POST["entry_id"])) {
    $stmt = $connection->prepare("SELECT DISTINCT * FROM content WHERE id = ? GROUP BY id");
    $stmt->bind_param("s", $id);
    $id = $_POST["entry_id"];
    $stmt->execute();
    $newData = $stmt->get_result()->fetch_assoc();
    echo json_encode($newData);
}


?>
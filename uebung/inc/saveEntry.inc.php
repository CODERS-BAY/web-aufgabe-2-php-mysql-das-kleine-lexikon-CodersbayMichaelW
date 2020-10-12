<?php

$title = $_POST['title'];
$teaser = $_POST['teaser'];
$description = $_POST['description'];

if ($_FILES) {
    $file = $_FILES['fileUpload']['name'];
}
else {
    $file = NULL;
}

$target_dir = "../img/";
$uploadOK = 1;
$target_file = $target_dir . basename($_FILES['fileUpload']['name']);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake
if(isset($_POST['submit'])) {
    $check = getimagesize($_FILES['fileUpload']['temp_name']);
    if($check !== false) {
        echo "File is an image - " . $check['mine'] . ".";
        $uploadOK = 1;
    }
    else {
        echo "File is not an image.";
        $uploadOK = 0;
    }
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only jpg, jpeg, png & gif are allowed.";
    $uploadOK = 0;
}

// Check if $uploadOK is set to 0 by an error
if ($uploadOK == 0) {
    echo "Sorry, your file was not uploaded.";
}
else {
    if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_file)) {
        echo "The file " . basename( $_FILES['fileUpload']['name']). " has been uploaded.";
    }
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// echo $target_file, $imageFileType;
include("login.inc.php");

$stmt = $connection->prepare("INSERT INTO content(title, teaser, description, imgpath) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $teaser, $description, $file);

$stmt->execute();
$stmt->close();
$connection->close();

// redirect
if(isset($_SERVER['HTTP_REFERER'])) {
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
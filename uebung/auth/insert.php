<?php
define('SECURE', true);
include('../inc/login.inc.php');

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $id = $_POST['entry_id'];
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $teaser = mysqli_real_escape_string($connection, $_POST['teaser']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    if ($_POST['entry_id'] != '') {

        if ($_FILES['fileUpdate']['size'] != 0) {
            $file = $_FILES['fileUpdate']['name'];
            $checkFile = $connection->prepare("SELECT imgpath FROM content WHERE id=?");
            $checkFile->bind_param('s', $id);
            $checkFile->execute();
            $checkFile->bind_result($imgpath);
            $checkFile->fetch();
            $checkFile->free_result();
            $target_dir = "../img/";
            if(file_exists($target_dir.$imgpath)) {
                unlink($target_dir.$imgpath);
            }
            $uploadOK = 1;
            $target_file = $target_dir . basename($_FILES["fileUpdate"]["name"]);
            $imageFileType = strtolower((pathinfo($target_file, PATHINFO_EXTENSION)));
            // Check if image file is a actual image of fake
            if (isset($_POST['submit'])) {
                $check = getimagesize($_FILES['fileUpdate']['temp_name']);
                if($check !== false) {
                    echo "File is an image - " . $check['mine'] . ".";
                    $uploadOK = 1;
                }
                else {
                    echo "File is not an image.";
                    $uploadOK = 0;
                }
            }

            // alow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only jpg, jpeg, png & gif files are allowed.";
                $uploadOK = 0;
            }
            // Check if $uploadOK is set to 0 by an error
            if ($uploadOK == 0) {
                echo "Sorry, your file was not uploaded.";
            }
            else {
                if (move_uploaded_file($_FILES['fileUpdate']['tmp_name'], $target_file)) {
                    echo "The file " . basename($_FILES["fileUpdate"]["name"]). " has been uploaded.";
                }
                else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        else {
            $file = NULL;
        }

        $stmt = $connection->prepare("UPDATE content SET title=?, teaser=?, imgpath=?, description=? WHERE id=?");

        if (false === $stmt) {
            die('prepare() faile: ' . htmlspecialchars($connection->error));
        }

        $rc = $stmt->bind_param('sssss', $title, $teaser, $imgpathnew, $description, $id);
        $id = $id;
        $title = $title;
        $teaser = $teaser;
        $description = $description;
        $imgpathnew = $file;

        if (false === $rc) {
            die('bind_param() failed: ' . htmlspecialchars($stmtm->error));
        }

        $result = $stmt->execute();
    }

    if ($result) {
        $output .= include('../inc/dataTable.inc.php');
    }
}
?>
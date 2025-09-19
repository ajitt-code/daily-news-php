<?php
include 'config.php';

$id    = $_POST['News_Id'];
$title = $_POST['News_Title'];
$desc  = $_POST['News_Description'];

if ($_FILES['News_Banner_Image']['size'] > 0) {
    $image = file_get_contents($_FILES['News_Banner_Image']['tmp_name']);
    $stmt = $conn->prepare("UPDATE news SET News_Title=?, News_Description=?, News_Banner_Image=?, UpdatedOn=NOW(), UpdatedBy='Admin' WHERE News_Id=?");
    $stmt->bind_param("ssbi", $title, $desc, $null, $id);
    $stmt->send_long_data(2, $image);
} else {
    $stmt = $conn->prepare("UPDATE news SET News_Title=?, News_Description=?, UpdatedOn=NOW(), UpdatedBy='Admin' WHERE News_Id=?");
    $stmt->bind_param("ssi", $title, $desc, $id);
}

if ($stmt->execute()) {
    header("Location: view.php?id=$id");
} else {
    echo "Error: " . $stmt->error;
}
?>
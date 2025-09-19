<?php
include 'config.php';
$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM news WHERE News_Id=?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}
?>
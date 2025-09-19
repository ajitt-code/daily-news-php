<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Capture all fields
    $CreatedBy       = $_POST['CreatedBy'];  
    $News_Title      = $_POST['News_Title'];
    $News_Description= $_POST['News_Description'];
    $Category        = $_POST['Category'];
    $Region          = $_POST['Region'];
    $Status          = $_POST['Status'];
    $Language        = $_POST['Language'];
    $City            = $_POST['City'];
    $Country         = $_POST['Country'];

    // Handle image upload
    $image = null;
    if (isset($_FILES['News_Banner_Image']) && $_FILES['News_Banner_Image']['error'] == 0) {
        $image = file_get_contents($_FILES['News_Banner_Image']['tmp_name']);
    }

    // Prepare insert query
    $stmt = $conn->prepare("INSERT INTO news 
        (News_Title, News_Description, News_Banner_Image, Category, Region, Status, Language, City, Country, CreatedBy) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind params (image as BLOB placeholder)
    $null = NULL;
    $stmt->bind_param(
        "ssbsssssss",
        $News_Title,
        $News_Description,
        $null,
        $Category,
        $Region,
        $Status,
        $Language,
        $City,
        $Country,
        $CreatedBy
    );

    // Send actual image data
    if ($image !== null) {
        $stmt->send_long_data(2, $image); // 2 = index of News_Banner_Image in bind_param
    }

    // Execute and redirect
    if ($stmt->execute()) {
        header("Location: index.php?success=1");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
}
?>
<?php
include 'config.php';

$id = $_GET['id'] ?? null;

// Fetch existing news data
$stmt = $conn->prepare("SELECT * FROM news WHERE News_Id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo "<div class='container mt-5'><p class='text-danger'>News not found.</p></div>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UpdatedBy        = $_POST['UpdatedBy'];
    $News_Title       = $_POST['News_Title'];
    $News_Description = $_POST['News_Description'];
    $Category         = $_POST['Category'];
    $Region           = $_POST['Region'];
    $Status           = $_POST['Status'];
    $Language         = $_POST['Language'];
    $City             = $_POST['City'];
    $Country          = $_POST['Country'];

    // Check if a new image is uploaded
    if (isset($_FILES['News_Banner_Image']) && $_FILES['News_Banner_Image']['error'] == 0) {
        $image = file_get_contents($_FILES['News_Banner_Image']['tmp_name']);

        $stmt = $conn->prepare("UPDATE news 
            SET News_Title=?, News_Description=?, News_Banner_Image=?, Category=?, Region=?, Status=?, Language=?, City=?, Country=?, UpdatedBy=?, UpdatedOn=NOW() 
            WHERE News_Id=?");

        $null = NULL; // placeholder for BLOB
        $stmt->bind_param("ssbsssssssi", $News_Title, $News_Description, $null, $Category, $Region, $Status, $Language, $City, $Country, $UpdatedBy, $id);
        $stmt->send_long_data(2, $image); // 2 = index of News_Banner_Image in bind_param
    } else {
        // Update without changing the image
        $stmt = $conn->prepare("UPDATE news 
            SET News_Title=?, News_Description=?, Category=?, Region=?, Status=?, Language=?, City=?, Country=?, UpdatedBy=?, UpdatedOn=NOW() 
            WHERE News_Id=?");
        $stmt->bind_param("sssssssssi", $News_Title, $News_Description, $Category, $Region, $Status, $Language, $City, $Country, $UpdatedBy, $id);
    }

    if ($stmt->execute()) {
        header("Location: view.php?id=$id");
        exit;
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
    }
}
?>

<?php include 'header.php'; ?>

<div class="container mt-4">
    <h2>Update News</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <!-- Updated By -->
        <div class="mb-3">
            <label>Your Name (Updated By)</label>
            <input type="text" name="UpdatedBy" class="form-control" required value="<?= htmlspecialchars($row['UpdatedBy'] ?? '') ?>">
        </div>

        <!-- Title -->
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="News_Title" class="form-control" required value="<?= htmlspecialchars($row['News_Title']) ?>">
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label>Description</label>
            <textarea name="News_Description" class="form-control" rows="4" required><?= htmlspecialchars($row['News_Description']) ?></textarea>
        </div>

        <!-- Banner Image -->
        <div class="mb-3">
            <label>Banner Image</label>
            <input type="file" name="News_Banner_Image" class="form-control">
            <?php if (!empty($row['News_Banner_Image'])): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($row['News_Banner_Image']) ?>" alt="Banner" class="img-fluid mt-2" style="max-height:150px;">
            <?php endif; ?>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="Category" class="form-control" value="<?= htmlspecialchars($row['Category']) ?>">
        </div>

        <!-- Region -->
        <div class="mb-3">
            <label>Region</label>
            <input type="text" name="Region" class="form-control" value="<?= htmlspecialchars($row['Region']) ?>">
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="Status" class="form-control" value="<?= htmlspecialchars($row['Status']) ?>">
        </div>

        <!-- Language -->
        <div class="mb-3">
            <label>Language</label>
            <input type="text" name="Language" class="form-control" value="<?= htmlspecialchars($row['Language']) ?>">
        </div>

        <!-- City -->
        <div class="mb-3">
            <label>City</label>
            <input type="text" name="City" class="form-control" value="<?= htmlspecialchars($row['City']) ?>">
        </div>

        <!-- Country -->
        <div class="mb-3">
            <label>Country</label>
            <input type="text" name="Country" class="form-control" value="<?= htmlspecialchars($row['Country']) ?>">
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>
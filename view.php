<?php include 'config.php'; ?>
<?php include 'header.php'; ?>

<?php
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM news WHERE News_Id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg rounded-3 border-0">
        <!-- Banner Image -->
        <?php if (!empty($row['News_Banner_Image'])): ?>
          <img src="data:image/jpeg;base64,<?= base64_encode($row['News_Banner_Image']) ?>" 
               class="card-img-top img-fluid" 
               style="max-height: 350px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;" 
               alt="News Banner">
        <?php endif; ?>

        <!-- Card Content -->
        <div class="card-body">
          <h2 class="card-title mb-3"><?= htmlspecialchars($row['News_Title']) ?></h2>

          <p class="card-text"><?= nl2br(htmlspecialchars($row['News_Description'])) ?></p>

          <p class="text-muted small">
            <b>Category:</b> <?= $row['Category'] ?> | 
            <b>Region:</b> <?= $row['Region'] ?> | 
            <b>City:</b> <?= $row['City'] ?> | 
            <b>Country:</b> <?= $row['Country'] ?> | 
            <b>Language:</b> <?= $row['Language'] ?> | 
            <b>Status:</b> <?= $row['Status'] ?>
          </p>

                    <!-- Published Info -->
            <div class="mb-3 p-2 bg-light rounded">
                <p class="mb-1 small">
                    <b>Created On:</b> <?= $row['CreatedOn'] ?> | 
                    <b>Created By:</b> <?= htmlspecialchars($row['CreatedBy']) ?>
                </p>

                <?php if (!empty($row['UpdatedOn']) && !empty($row['UpdatedBy'])): ?>
                    <p class="mb-0 small">
                        <b>Updated On:</b> <?= $row['UpdatedOn'] ?> | 
                        <b>Updated By:</b> <?= htmlspecialchars($row['UpdatedBy']) ?>
                    </p>
                <?php endif; ?>
</div>
          <!-- Action Buttons -->
          <div class="mt-2 d-flex justify-content-between">
            <a href="update.php?id=<?= $row['News_Id'] ?>" class="btn btn-warning btn-sm">Update</a>
            <a href="delete.php?id=<?= $row['News_Id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
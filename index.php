<?php include 'config.php'; ?>
<?php include 'header.php'; ?>

<h1 class="mb-4">All News</h1>

<div class="row">
<?php
$result = $conn->query("SELECT * FROM news ORDER BY News_Id DESC");
while ($row = $result->fetch_assoc()) {
?>
  <div class="col-md-4 mb-3">
    <div class="card h-100">
      <img src="data:image/jpeg;base64,<?= base64_encode($row['News_Banner_Image']) ?>" class="card-img-top" height="200">
      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($row['News_Title']) ?></h5>
        <p class="card-text"><?= substr(htmlspecialchars($row['News_Description']),0,100) ?>...</p>
        <a href="view.php?id=<?= $row['News_Id'] ?>" class="btn btn-sm btn-primary">View</a>
      </div>
    </div>
  </div>
<?php } ?>
</div>

<?php include 'footer.php'; ?>
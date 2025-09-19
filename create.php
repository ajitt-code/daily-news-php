<?php include 'header.php'; ?>
<h2>Add News</h2>
<form method="POST" action="insert.php" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Your Name (Created By)</label>
    <input type="text" name="CreatedBy" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Title</label>
    <input type="text" name="News_Title" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Description</label>
    <textarea name="News_Description" class="form-control" required></textarea>
  </div>
  <div class="mb-3">
    <label>Banner Image</label>
    <input type="file" name="News_Banner_Image" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Category</label>
    <input type="text" name="Category" class="form-control">
  </div>
  <div class="mb-3">
    <label>Region</label>
    <input type="text" name="Region" class="form-control">
  </div>
  <div class="mb-3">
    <label>Status</label>
    <input type="text" name="Status" class="form-control">
  </div>
  <div class="mb-3">
    <label>Language</label>
    <input type="text" name="Language" class="form-control">
  </div>
  <div class="mb-3">
    <label>City</label>
    <input type="text" name="City" class="form-control">
  </div>
  <div class="mb-3">
    <label>Country</label>
    <input type="text" name="Country" class="form-control">
  </div>
  <button type="submit" class="btn btn-success">Save</button>
</form>
<?php include 'footer.php'; ?>
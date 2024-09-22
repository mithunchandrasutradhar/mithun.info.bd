<?php
include_once("../common/functions.php");
checklogin();

$mode = $_GET['mode'];
if ($mode == 'edit' || $mode == 'delete') {
  $id = mysqli_real_escape_string($con, $_GET['id']);
  $item = mysqli_query($con, "SELECT * FROM `projects` WHERE id = $id");
  if (mysqli_num_rows($item) < 1) {
    die("Projects Information Empty");
  }
  $item = mysqli_fetch_assoc($item);
}

if ($mode == 'add') { ?>
<div class="modal-header">
  <h4 class="modal-title">Add Projects Details</h4>
</div>
<form action="./submit/projects.php?action=add" method="POST" enctype="multipart/form-data" autocomplete="off">
  <div class="modal-body">
    <label><strong>Title</strong></label>
    <div class="form-group">
      <input type="text" name="title" placeholder="Enter Project Title" class="form-control" required>
    </div>
    <label><strong>Domain</strong></label>
    <div class="form-group">
      <input type="text" name="domain" placeholder="Enter Domain Name" class="form-control" required>
    </div>
    <label><strong>Url</strong></label>
    <div class="form-group">
      <input type="text" name="url" placeholder="Enter Website URL" class="form-control" required>
    </div>
    <label><strong>Description</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="description" id="" cols="30" rows="5"
        placeholder="Enter Projects Details... " required></textarea>
    </div>
    <div class="form-check form-group">
      <div class="checkbox">
        <input type="checkbox" id="home" name="home" class="form-check-input" />
        <label for="home">Show on Home Page</label>
      </div>
    </div>
    <label><strong>Status</strong></label>
    <div class="form-group">
      <select class="form-select" name="status" required>
        <option value="1">Active</option>
        <option value="0">Deactive</option>
      </select>
    </div>
    <label><strong>Photo</strong></label>
    <div class="input-group">
      <input name="image" type="file" class="form-control inputfile d-none" accept="image/x-png,image/jpeg">
      <div class="imagearea">
        <span>Drag & Drop your project photo</span>
      </div>
    </div>
  </div>
  <div class="modal-footer d-flex justify-content-between">
    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
      <i class="bx bx-x d-block d-sm-none"></i>
      <span class="d-none d-sm-block">Close</span>
    </button>
    <button type="submit" class="btn btn-primary ml-1">
      <i class="bx bx-check d-block d-sm-none"></i>
      <span class="d-none d-sm-block">Save</span>
    </button>
  </div>
</form>


<?php } else if ($mode == 'edit') {
?>
<div class="modal-header">
  <h4 class="modal-title">Edit projects Details</h4>
</div>
<form action="./submit/projects.php?action=edit" method="POST" enctype="multipart/form-data" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Title</strong></label>
    <div class="form-group">
      <input type="text" name="title" placeholder="Enter Project Title" class="form-control" required
        value="<?= $item['title'] ?>">
    </div>
    <label><strong>Domain</strong></label>
    <div class=" form-group">
      <input type="text" name="domain" placeholder="Enter Domain Name" class="form-control" required
        value="<?= $item['domain'] ?>">
    </div>
    <label><strong>Url</strong></label>
    <div class="form-group">
      <input type="text" name="url" placeholder="Enter Website URL" class="form-control" required
        value="<?= $item['url'] ?>">
    </div>
    <label><strong>Description</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="description" id="" cols="30" rows="5"
        placeholder="Enter Projects Details... " required><?= $item['description'] ?>
      </textarea>
    </div>
    <div class="form-check form-group">
      <div class="checkbox">
        <input type="checkbox" id="home" name="home" class="form-check-input"
          <?= ($item['home'] == 1 ? "checked" : "") ?> />
        <label for="home">Show on Home Page</label>
      </div>
    </div>
    <label><strong>Status</strong></label>
    <div class="form-group">
      <select class="form-select" name="status">
        <option <?= $item['status'] == 1 ? "selected" : "" ?> value="1">Active</option>
        <option <?= $item['status'] == 0 ? "selected" : "" ?> value="0">Deactive</option>
      </select>
    </div>
    <label><strong>Image</strong></label>
    <div class="input-group">
      <input name="image" type="file" class="form-control inputfile d-none" accept="image/x-png,image/jpeg">
      <div class="imagearea">
        <span>Drag & Drop your project photo</span>
      </div>
    </div>
  </div>
  <div class="modal-footer d-flex justify-content-between">
    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
      <i class="bx bx-x d-block d-sm-none"></i>
      <span class="d-none d-sm-block">Close</span>
    </button>
    <button type="submit" class="btn btn-primary ml-1">
      <i class="bx bx-check d-block d-sm-none"></i>
      <span class="d-none d-sm-block">Save</span>
    </button>
  </div>
</form>
<?php } else if ($mode == 'delete') {
?>
<div class="modal-header">
  <h4 class="modal-title">Delete Project</h4>
</div>
<form action="./submit/projects.php?action=delete" method="POST" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Are you sure to delete this Projects!</strong></label>

  </div>
  <div class="modal-footer d-flex justify-content-between">
    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
      <i class="bx bx-x d-block d-sm-none"></i>
      <span class="d-none d-sm-block">Cancel</span>
    </button>
    <button type="submit" class="btn btn-primary ml-1">
      <i class="bx bx-check d-block d-sm-none"></i>
      <span class="d-none d-sm-block">OK</span>
    </button>
  </div>
</form>
<?php } ?>

<script>
$(document).ready(function() {

  var inputfile = $(".inputfile");

  $(".imagearea").on('click', function() {
    $(".inputfile").click();
  })

  $(".imagearea").on("dragover", function(event) {

    event.preventDefault();

  });
  $(".imagearea").on("drop", function(event) {
    event.preventDefault();
    // File recieve_____
    image = event.originalEvent.dataTransfer.files[0];
    $(".inputfile").eq(0).prop("files", event.originalEvent.dataTransfer.files);
    image_display()
  });

  $(".inputfile").on("change", function() {
    // File recieve_____
    image = event.srcElement.files[0]
    image_display();
  })

});

// Extra Function_______________

function image_display() {

  let fileReader = new FileReader();

  fileReader.onload = function() {

    let imgTag =
      `<img loading="lazy" src="${fileReader.result}" alt="profile-picture" height="100">`;

    $(".imagearea").html(imgTag);
  };

  fileReader.readAsDataURL(image);
}
</script>
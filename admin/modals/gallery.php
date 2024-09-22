<?php
include_once("../common/functions.php");
checklogin();

$mode = $_GET['mode'];
if ($mode == 'edit' || $mode == 'delete') {
  $id = mysqli_real_escape_string($con, $_GET['id']);
  $item = mysqli_query($con, "SELECT * FROM `gallery` WHERE id = $id");
  if (mysqli_num_rows($item) < 1) {
    die("Gallery Information Empty");
  }
  $item = mysqli_fetch_assoc($item);
}

if ($mode == 'add') { ?>
<div class="modal-header">
  <h4 class="modal-title">Add Photo Details</h4>
</div>
<form action="./submit/gallery.php?action=add" method="POST" enctype="multipart/form-data" autocomplete="off">
  <div class="modal-body">
    <label><strong>Title</strong></label>
    <div class="form-group">
      <input type="text" name="title" placeholder="Enter photo title" class="form-control" required>
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
        <span>Drag & Drop your photo</span>
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
  <h4 class="modal-title">Edit Photo Information</h4>
</div>
<form action="./submit/gallery.php?action=edit" method="POST" enctype="multipart/form-data" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Title</strong></label>
    <div class="form-group">
      <input type="text" name="title" placeholder="Enter photo title" class="form-control" required
        value="<?= $item['title'] ?>">
    </div>
    <label><strong>Status</strong></label>
    <div class="form-group">
      <select class="form-select" name="status">
        <option <?= $item['status'] == 1 ? "selected" : "" ?> value="1">Active</option>
        <option <?= $item['status'] == 0 ? "selected" : "" ?> value="0">Deactive</option>
      </select>
    </div>
    <label><strong>Photo</strong></label>
    <div class="input-group">
      <input name="image" type="file" class="form-control inputfile d-none" accept="image/x-png,image/jpeg">
      <div class="imagearea">
        <span>Drag & Drop your photo</span>
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
  <h4 class="modal-title">Delete Photo</h4>
</div>
<form action="./submit/gallery.php?action=delete" method="POST" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Are you sure to delete this Photo!</strong></label>

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
<?php
include_once("../common/functions.php");

$id = mysqli_real_escape_string($con, $_GET['id']);
$item = mysqli_query($con, "SELECT * FROM `users` WHERE id = $id");
if (mysqli_num_rows($item) < 1) {
  die("Information Empty");
}
$item = mysqli_fetch_assoc($item);
?>
<div class="modal-header">
  <h4 class="modal-title">Edit Information</h4>
</div>
<form action="./submit/profile.php" method="POST" autocomplete="off" enctype="multipart/form-data"
  onSubmit="return checkPassword(this)">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Name</strong></label>
    <div class="form-group">
      <input type="text" name="name" class="form-control" required value="<?= $item['name'] ?>">
    </div>
    <label><strong>Email</strong></label>
    <div class="form-group">
      <input type="email" name="email" class="form-control" required value="<?= $item['email'] ?>">
    </div>
    <label><strong>Phone</strong></label>
    <div class="form-group">
      <input type="number" name="phone" class="form-control" required value="<?= $item['phone'] ?>">
    </div>
    <label><strong>User Name</strong></label>
    <div class="form-group">
      <input type="text" name="username" class="form-control" required value="<?= $item['username'] ?>">
    </div>
    <label><strong>Current Password</strong></label>
    <div class="form-group">
      <input type="Password" name="password" class="form-control" required>
    </div>
    <label><strong>New Password</strong></label>
    <div class="form-group">
      <input type="Password" name="new_password" class="form-control">
    </div>
    <label><strong>Profile Picture</strong></label>
    <div class="input-group">
      <input name="avatar" type="file" class="form-control inputfile d-none" accept="image/x-png,image/jpeg">
      <div class="imagearea">
        <span>Drag & Drop your image</span>
      </div>
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
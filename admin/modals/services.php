<?php
include_once("../common/functions.php");
checklogin();

$mode = $_GET['mode'];
if ($mode == 'edit' || $mode == 'delete') {
  $id = mysqli_real_escape_string($con, $_GET['id']);;
  $item = mysqli_query($con, "SELECT * FROM `services` WHRE WHERE id = $id");
  if (mysqli_num_rows($item) < 1) {
    die("Empty Service Information");
  }
  $item = mysqli_fetch_assoc($item);
}

if ($mode == 'add') { ?>
<div class="modal-header">
  <h4 class="modal-title">Add Service</h4>
</div>
<form action="./submit/services.php?action=add" method="POST" autocomplete="off">
  <div class="modal-body">
    <label><strong>Title</strong></label>
    <div class="form-group">
      <input type="text" name="title" placeholder="Enter Service Title" class="form-control" required>
    </div>
    <label><strong>Status</strong></label>
    <div class="form-group">
      <select class="form-select" name="status" required>
        <option value="1">Active</option>
        <option value="0">Deactive</option>
      </select>
    </div>
    <label><strong>Icon</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="icon" id="" cols="10" rows="5" placeholder="Enter SVG Code... "
        required></textarea>
    </div>
    <label><strong>Description</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="description" id="" cols="30" rows="5" placeholder="Enter Service Details... "
        required></textarea>
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
  <h4 class="modal-title">Edit Service</h4>
</div>
<form action="./submit/services.php?action=edit" method="POST" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Title</strong></label>
    <div class="form-group">
      <input type="text" name="title" class="form-control" required value="<?= $item['title'] ?>">
    </div>
    <label><strong>Status</strong></label>
    <div class="form-group">
      <select class="form-select" name="status">
        <option <?= $item['status'] == 1 ? "selected" : "" ?> value="1">Active</option>
        <option <?= $item['status'] == 0 ? "selected" : "" ?> value="0">Deactive</option>
      </select>
    </div>

    <label><strong>Icon</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="icon" id="" cols="30" rows="5" required><?= $item['icon'] ?></textarea>
    </div>
    <label><strong>Description</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="description" id="" cols="30" rows="5"
        required><?= $item['description'] ?></textarea>
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
  <h4 class="modal-title">Delete Service</h4>
</div>
<form action="./submit/services.php?action=delete" method="POST" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Are you sure to delete this Service!</strong></label>

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
<?php
include_once("../common/functions.php");
checklogin();

$mode = $_GET['mode'];
if ($mode == 'edit' || $mode == 'delete') {
  $id = mysqli_real_escape_string($con, $_GET['id']);;
  $item = mysqli_query($con, "SELECT * FROM `jobs` WHRE WHERE id = $id");
  if (mysqli_num_rows($item) < 1) {
    die("Empty Jobs Information");
  }
  $item = mysqli_fetch_assoc($item);
}

if ($mode == 'add') { ?>
<div class="modal-header">
  <h4 class="modal-title">Add Jobs</h4>
</div>
<form action="./submit/jobs.php?action=add" method="POST" autocomplete="off">
  <div class="modal-body">
    <label><strong>Title</strong></label>
    <div class="form-group">
      <input type="text" name="title" placeholder="Enter Title" class="form-control" required>
    </div>
    <label><strong>Institute</strong></label>
    <div class="form-group">
      <input type="text" name="institute" placeholder="Enter Institute Name" class="form-control" required>
    </div>
    <label><strong>Country</strong></label>
    <div class="form-group">
      <input type="text" name="country" placeholder="Enter Country Name" class="form-control" required>
    </div>
    <label><strong>Year</strong></label>
    <div class="form-group">
      <input type="text" name="year" placeholder="Enter year" class="form-control" required>
    </div>
    <label><strong>Description</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="description" id="" cols="30" rows="5" placeholder="Enter Details... "
        required></textarea>
    </div>
    <label><strong>Status</strong></label>
    <div class="form-group">
      <select class="form-select" name="status" required>
        <option value="1">Active</option>
        <option value="0">Deactive</option>
      </select>
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
  <h4 class="modal-title">Edit Jobs</h4>
</div>
<form action="./submit/jobs.php?action=edit" method="POST" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Title</strong></label>
    <div class="form-group">
      <input type="text" name="title" class="form-control" required value="<?= $item['title'] ?>">
    </div>
    <label><strong>Institute</strong></label>
    <div class="form-group">
      <input class="form-control" name="institute" id="" required value="<?= $item['institute'] ?>"></input>
    </div>
    <label><strong>Country</strong></label>
    <div class="form-group">
      <input class="form-control" name="country" id="" required value="<?= $item['country'] ?>"></input>
    </div>
    <label><strong>Description</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="description" id="" cols="30" rows="5"
        required><?= $item['description'] ?></textarea>
    </div>
    <label><strong>Year</strong></label>
    <div class="form-group">
      <input class="form-control" name="year" id="" required value="<?= $item['year'] ?>"></input>
    </div>
    <label><strong>Status</strong></label>
    <div class="form-group">
      <select class="form-select" name="status">
        <option <?= $item['status'] == 1 ? "selected" : "" ?> value="1">Active</option>
        <option <?= $item['status'] == 0 ? "selected" : "" ?> value="0">Deactive</option>
      </select>
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
  <h4 class="modal-title">Delete Jobs</h4>
</div>
<form action="./submit/jobs.php?action=delete" method="POST" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Are you sure to delete this Jobs!</strong></label>

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
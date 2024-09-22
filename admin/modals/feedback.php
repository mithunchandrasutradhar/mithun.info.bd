<?php
include_once("./common/functions.php");
checklogin();

$mode = $_GET['mode'];
if ($mode == 'edit' || $mode == 'view' || $mode == 'delete') {
  $id = mysqli_real_escape_string($con, $_GET['id']);
  $item = mysqli_query($con, "SELECT f.*,f.id AS feed_id, f.published_on AS published, u1.id, u1.name AS created_by, u1.group_id AS group_id, u1.group_name AS group_name, u2.name AS published_on FROM `feedback` AS f JOIN `users` AS u1 ON f.created_by = u1.id JOIN `users` AS u2 ON f.published_on = u2.id WHERE f.id = $id");
  if (mysqli_num_rows($item) < 1) {
    die("Feedback Information Empty");
  }
  $item = mysqli_fetch_assoc($item);
}

if ($mode == 'add') { ?>
<div class="modal-header">
  <h4 class="modal-title">Add FeedBack</h4>
</div>
<form action="../form_submit/admin_feedback.php?action=add" method="POST" enctype="multipart/form-data"
  autocomplete="off">
  <div class="modal-body">
    <label><strong>Name</strong></label>
    <div class="form-group">
      <input type="text" name="name" placeholder="Enter you name" class="form-control" required>
    </div>
    <label><strong>Designation</strong></label>
    <div class="form-group">
      <input type="text" name="designation" placeholder="Enter your designation" class="form-control" required>
    </div>
    <label><strong>Description</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="description" id="" cols="30" rows="5"
        placeholder="Enter Feedback Details... " required></textarea>
    </div>
    <label><strong>Pulbished On</strong></label>
    <div class="form-group">
      <select class="form-select" name="published_on" required>
        <option value="1">All</option>
        <?php
          $published_on = GetData("SELECT id, name, email FROM `users` WHERE id != 1");
          foreach ($published_on as $published) {
          ?>
        <option value="<?= $published['id'] ?>"><?= $published['name'] ?> (<?= $published['email'] ?>)</option>
        <?php } ?>
      </select>
    </div>
    <label><strong>Status</strong></label>
    <div class="form-group">
      <select class="form-select" name="status" required>
        <option value="1">Active</option>
        <option value="0">Deactive</option>
      </select>
    </div>
    <label><strong>Image</strong></label>
    <div class="input-group">
      <label class="input-group-text" for="image"><i class="bi bi-upload"></i></label>
      <input type="file" class="form-control" name="image" accept="image/x-png,image/jpeg">
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
  <h4 class="modal-title">Edit News</h4>
</div>
<form action="../form_submit/admin_feedback.php?action=edit" method="POST" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Title</strong></label>
    <div class="form-group">
      <input type="text" name="name" class="form-control" required value="<?= $item['name'] ?>">
    </div>
    <label><strong>Designation</strong></label>
    <div class="form-group">
      <input type="text" name="designation" class="form-control" required value="<?= $item['designation'] ?>">
    </div>
    <label><strong>Description</strong></label>
    <div class="form-group">
      <textarea class="form-control" name="description" id="" cols="30" rows="5"
        required><?= $item['description'] ?></textarea>
    </div>
    <label><strong>Status</strong></label>
    <div class="form-group">
      <select class="form-select" name="status">
        <option <?= $item['status'] == 1 ? "selected" : "" ?> value="1">Active</option>
        <option <?= $item['status'] == 0 ? "selected" : "" ?> value="0">Deactive</option>
      </select>
    </div>
    <label><strong>Pulbished On</strong></label>
    <div class="form-group">
      <select class="form-select" name="published_on">
        <option value="1">All</option>
        <?php
          $published_on = GetData("SELECT id, name, email FROM `users` WHERE id != 1");
          foreach ($published_on as $published) {
            echo "<option value='$published[id]' " . ($published['id'] === $item['published'] ? 'selected' : '')
              . ">$published[name] ($published[email])</option>";
          } ?>
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
<?php } else if ($mode == 'view') { ?>
<div class="p-3 text-center">
  <h3><?= $item['name'] ?></h3>
  <h4><?= $item['designation'] ?></h4>
</div>

<div class="modal-body">
  <img class="img-fluid d-block m-auto mb-3" loading="lazy" src="../assets/img/testimonials/<?= $item['image'] ?>"
    alt="<?= $item['title'] ?>" width="450" height="350">
  <p class="text-justify"><?= $item['description'] ?></p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
    <i class="bx bx-x d-block d-sm-none"></i>
    <span class="d-none d-sm-block">Close</span>
  </button>
</div>
<?php } else if ($mode == 'delete') {
?>
<div class="modal-header">
  <h4 class="modal-title">Delete News</h4>
</div>
<form action="../form_submit/admin_feedback.php?action=delete" method="POST" autocomplete="off">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="modal-body">
    <label><strong>Are you sure to delete this feedback!</strong></label>

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
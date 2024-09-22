<?php

include_once("../common/functions.php");
require_once "ImageResizer.php";
checklogin();

$action = $_GET['action'];

if ($action == 'add') {

  $requiredFields = ["title", "status"];
  $validated = true;
  foreach ($requiredFields as $field) {
    if (isset($_POST[$field]) && $_POST[$field] != '') {
      $_POST[$field] = mysqli_real_escape_string($con, $_POST[$field]);
    } else {
      $validated = false;
      $_SESSION['error'] = 'Form validation Failed, Please fill the form correctly';
      break;
    }
  }

  if (!empty($_FILES['image'])) {

    $resizer = new ImageResizer($_FILES['image']);
    $resizer->maintainAspectRatio = true;
    $resizer->savePath = "../../assets/images/gallery/";
    $resizer->resize('full', 1920);
    $resizer->resize('thumb', 400);
    $file_name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);

    if ($validated) {
      $sql = "INSERT INTO `gallery` (`title`, `image`, `status`) 
                      VALUES ('$_POST[title]','$file_name', '$_POST[status]')";
      $query = mysqli_query($con, $sql);

      $query ? $_SESSION['success'] = "Photo Successfully Inserted" : $_SESSION['error'] = "Sorry! Failed to Insert Photo Information.";
    }
  }
} else if ($action == 'edit') {

  $requiredFields = ["title", "status"];
  $validated = true;
  foreach ($requiredFields as $field) {
    if (isset($_POST[$field]) && $_POST[$field] != '') {
      $_POST[$field] = mysqli_real_escape_string($con, $_POST[$field]);
    } else {
      $validated = false;
      $_SESSION['error'] = 'Form validation Failed, Please fill the form correctly';
      break;
    }
  }
  if ($validated) {
    $sql = "UPDATE `gallery` SET `title`= '$_POST[title]', `status` = '$_POST[status]'  WHERE `id` = '$_POST[id]'";

    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Gallery Information Successfully Updated') : setAlert('danger', 'Sorry! Failed to Update Gallery Information.');

    if (!empty($_FILES['image']['tmp_name'])) {

      $resizer = new ImageResizer($_FILES['image']);
      $resizer->maintainAspectRatio = true;
      $resizer->savePath = "../../assets/images/gallery/";
      $resizer->resize('full', 1920);
      $resizer->resize('thumb', 400);
      $file_name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);

      $sql = "UPDATE `gallery` SET `image`= '$file_name' WHERE id = '$_POST[id]'";
      $query = mysqli_query($con, $sql);

      $query ? $_SESSION['success'] = "Photo Successfully Inserted" : $_SESSION['error'] = "Sorry! Failed to Insert Photo Information.";
    }
  }
} else if ($action == 'delete') {

  mysqli_real_escape_string($con, $_POST['id']);
  $del = mysqli_query($con, "DELETE FROM  `gallery` WHERE id='$_POST[id]'");
  if ($del) {
    setAlert('success', 'Gallery Information Successfully Deleted');
  } else {
    setAlert('danger', 'Sorry! Failed to Delete Gallery Information.');
  }
}

goback();

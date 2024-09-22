<?php

include_once("../common/functions.php");
checklogin();

$action = $_GET['action'];

if ($action == 'add') {

  $requiredFields = ["title", "status", "icon", "description"];
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
    $sql = "INSERT INTO `services` (`title`, `icon`, `description`, `status`) 
                      VALUES ('$_POST[title]', '$_POST[icon]',  '$_POST[description]', '$_POST[status]')";
    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Service Successfully Inserted') : setAlert('danger', 'Sorry! Failed to Insert Service.');
  }
} else if ($action == 'edit') {

  $requiredFields = ["id", "title", "icon", "description", "status"];
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
    $sql = "UPDATE `services` SET `title`= '$_POST[title]', `icon` = '$_POST[icon]', `status` = '$_POST[status]', `description` = '$_POST[description]'  WHERE `id` = '$_POST[id]'";
    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Service Successfully Updated') : setAlert('danger', 'Sorry! Failed to Update Service.');
  }
} else if ($action == 'delete') {

  mysqli_real_escape_string($con, $_POST['id']);
  $del = mysqli_query($con, "DELETE FROM  `services` WHERE id='$_POST[id]'");
  if ($del) {
    setAlert('success', 'Service Successfully Deleted');
  } else {
    setAlert('danger', 'Sorry! Failed to Delete Service.');
  }
}

goback();
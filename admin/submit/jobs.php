<?php

include_once("../common/functions.php");
checklogin();

$action = $_GET['action'];

if ($action == 'add') {

  $requiredFields = ["title", "institute", "country", "year", "description", "status"];
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
    $sql = "INSERT INTO `jobs` (`title`, `institute`, `country`, `year`, `description`, `status`) 
                      VALUES ('$_POST[title]', '$_POST[institute]', '$_POST[country]', '$_POST[year]',  '$_POST[description]',  '$_POST[status]')";
    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Jobs Successfully Inserted') : setAlert('danger', 'Sorry! Failed to Insert Jobs.');
  }
} else if ($action == 'edit') {

  $requiredFields = ["id", "title", "institute", "country",  "description", "year", "status"];
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
    $sql = "UPDATE `jobs` SET `title`= '$_POST[title]', `institute` = '$_POST[institute]', `country` = '$_POST[country]', `year` = '$_POST[year]', `description` = '$_POST[description]', `status` = '$_POST[status]'  WHERE `id` = '$_POST[id]'";
    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Jobs Successfully Updated') : setAlert('danger', 'Sorry! Failed to Update Jobs.');
  }
} else if ($action == 'delete') {

  mysqli_real_escape_string($con, $_POST['id']);
  $del = mysqli_query($con, "DELETE FROM  `jobs` WHERE id='$_POST[id]'");
  if ($del) {
    setAlert('success', 'Jobs Successfully Deleted');
  } else {
    setAlert('danger', 'Sorry! Failed to Delete Jobs.');
  }
}

goback();
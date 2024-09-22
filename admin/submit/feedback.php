<?php

include_once("./common/functions.php");
checklogin();

$action = $_GET['action'];

if ($action == 'add') {

  $requiredFields = ["name", "designation", "description", "published_on", "status"];
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
  if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != "") {

    $check = getimagesize($_FILES['image']['tmp_name']);

    if ($check !== false) {

      if ($_FILES['image']['size'] > 500000) {

        setAlert('danger', 'Sorry, Your file is too large. Upload Size is Maximum 500KB');
      } else {

        if ($validated) {
          $sql = "INSERT INTO `feedback` (`name`, `designation`, `description`, `status`, `created_by`, `published_on`, `created`) 
                      VALUES ('$_POST[name]', '$_POST[designation]', '$_POST[description]', '$_POST[status]', '$_SESSION[id]', '$_POST[published_on]', '$timestamp')";


          $query = mysqli_query($con, $sql);


          $query ? $_SESSION['success'] = "Feedback Successfully Inserted" : $_SESSION['error'] = "Sorry! Feedback not inserted.";
        }

        $last_id = $con->insert_id;

        $img_name = $last_id . ".png";

        $save_path = "../assets/img/testimonials/" . $last_id . ".png";

        if ($validated) {

          if (move_uploaded_file($_FILES['image']['tmp_name'], $save_path)) {
            $sql = "UPDATE `feedback` SET `image`= '$img_name' WHERE id = '$last_id'";
            $query = mysqli_query($con, $sql);
            $query ? setAlert('success', 'Feedback Successfully Inserted') : setAlert('danger', 'Sorry! Failed to insert image.');
          } else {

            setAlert('danger', 'Sorry, Failed to upload Image');
          }
        }
      }
    } else {

      setAlert('danger', 'Sorry, Your file is not an image.');
    }
  } else {
    setAlert('danger', 'Select an Image');
  }
} else if ($action == 'edit') {

  $requiredFields = ["id", "name", "designation", "description", "published_on", "status"];

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
    $sql = "UPDATE `feedback` SET `name`= '$_POST[name]', `designation` = '$_POST[designation]', `description` = '$_POST[description]', `published_on` = '$_POST[published_on]', `status` = '$_POST[status]'  WHERE `id` = '$_POST[id]'";

    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Feedback Successfully Updated') : setAlert('danger', 'Sorry! Failed to Update Feedback.');
  }
} else if ($action == 'delete') {

  mysqli_real_escape_string($con, $_POST['id']);
  $del = mysqli_query($con, "DELETE FROM  `feedback` WHERE id='$_POST[id]'");
  if ($del) {
    setAlert('success', 'Feedback Successfully Deleted');
  } else {
    setAlert('danger', 'Sorry! Failed to Delete Feedback.');
  }
}

goback();
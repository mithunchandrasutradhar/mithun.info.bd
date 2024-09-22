<?php

include_once("../common/functions.php");
checklogin();

$action = $_GET['action'];

if ($action == 'add') {

  $requiredFields = ["title", "domain", "url", "description", "status"];

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
          $home = ($_POST['home'] == 'on' ? '1' : '0');
          $sql = "INSERT INTO `projects` (`title`, `description`, `domain`, `url`, `home`, `status`) 
                      VALUES ('$_POST[title]',  '$_POST[description]', '$_POST[domain]', '$_POST[url]', $home, '$_POST[status]')";

          $query = mysqli_query($con, $sql);


          $query ? $_SESSION['success'] = "Project Successfully Inserted" : $_SESSION['error'] = "Sorry! Failed to Insert Project.";
        }
        $last_id = $con->insert_id;

        $img_name = $_FILES['image']['name'];

        $save_path = "../../assets/images/projects/" . $img_name;
        if ($validated) {
          if (move_uploaded_file($_FILES['image']['tmp_name'], $save_path)) {
            $sql = "UPDATE `projects` SET `image`= '$img_name' WHERE id = '$last_id'";

            $query = mysqli_query($con, $sql);
            $query ? setAlert('success', 'Projects Successfully Inserted') : setAlert('danger', 'Sorry! Failed to insert Project.');
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

  $requiredFields = ["title", "domain", "url", "description", "status"];
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
    $home = ($_POST['home'] == 'on' ? '1' : '0');
    $sql = "UPDATE `projects` SET `title`= '$_POST[title]', `domain` = '$_POST[domain]', `url` = '$_POST[url]', `description` = '$_POST[description]', `home` = $home, `status` = '$_POST[status]'  WHERE `id` = '$_POST[id]'";

    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Project Information Successfully Updated') : setAlert('danger', 'Sorry! Failed to Update Project Information.');
  }
  if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != "") {

    $check = getimagesize($_FILES['image']['tmp_name']);

    if ($check !== false) {

      if ($_FILES['image']['size'] > 500000) {

        setAlert('danger', 'Sorry, Your file is too large. Upload Size is Maximum 500KB');
      } else {

        $img_name = $_FILES['image']['name'];

        $save_path = "../../assets/images/projects/" . $img_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $save_path)) {
          $sql = "UPDATE `projects` SET `image`= '$img_name' WHERE id = '$_POST[id]'";
          $query = mysqli_query($con, $sql);
          setAlert('success', 'Project Photo Successfully Inserted');
        } else {

          setAlert('danger', 'Sorry, Failed to upload Image');
        }
      }
    } else {

      setAlert('danger', 'Sorry, Your file is not an image.');
    }
  }
} else if ($action == 'delete') {

  mysqli_real_escape_string($con, $_POST['id']);
  $del = mysqli_query($con, "DELETE FROM  `projects` WHERE id='$_POST[id]'");
  if ($del) {
    setAlert('success', 'Project Successfully Deleted');
  } else {
    setAlert('danger', 'Sorry! Failed to Delete Project.');
  }
}

goback();

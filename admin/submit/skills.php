<?php

include_once("../common/functions.php");
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
  if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != "") {
    $image_type = ['image/svg+xml', 'image/png', 'image/jpeg'];

    if (in_array($_FILES['image']['type'], $image_type)) {

      if ($_FILES['image']['size'] > 500000) {

        setAlert('danger', 'Sorry, Your file is too large. Upload Size is Maximum 500KB');
      } else {

        if ($validated) {
            $best = ($_POST['best'] == 'on' ? '1' : '0');
          $sql = "INSERT INTO `skills` (`title`, `best`, `status`) 
                      VALUES ('$_POST[title]', $best, '$_POST[status]')";


          $query = mysqli_query($con, $sql);


          $query ? $_SESSION['success'] = "Skill Successfully Inserted" : $_SESSION['error'] = "Sorry! Failed to Insert Skill.";
        }
        $last_id = $con->insert_id;

        $img_name = $_FILES['image']['name'];

        $save_path = "../../assets/images/skills/" . $img_name;
        if ($validated) {
          if (move_uploaded_file($_FILES['image']['tmp_name'], $save_path)) {
            $sql = "UPDATE `skills` SET `image`= '$img_name' WHERE id = '$last_id'";

            $query = mysqli_query($con, $sql);
            $query ? setAlert('success', 'Skill Successfully Inserted') : setAlert('danger', 'Sorry! Failed to insert Skill.');
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
      $best = ($_POST['best'] == 'on' ? '1' : '0');
    $sql = "UPDATE `skills` SET `title`= '$_POST[title]',`best` = $best, `status` = '$_POST[status]'  WHERE `id` = '$_POST[id]'";

    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Skill Information Successfully Updated') : setAlert('danger', 'Sorry! Failed to Update Skill Information.');
  }
  if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != "") {

    $image_type = ['image/svg+xml', 'image/png', 'image/jpeg'];

    if (in_array($_FILES['image']['type'], $image_type)) {

      if ($_FILES['image']['size'] > 500000) {

        setAlert('danger', 'Sorry, Your file is too large. Upload Size is Maximum 500KB');
      } else {

        $img_name = $_FILES['image']['name'];

        $save_path = "../../assets/images/skills/" . $img_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $save_path)) {
          $sql = "UPDATE `skills` SET `image`= '$img_name' WHERE id = '$_POST[id]'";
          $query = mysqli_query($con, $sql);
          setAlert('success', 'Skill Logo Successfully Inserted');
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
  $del = mysqli_query($con, "DELETE FROM  `skills` WHERE id='$_POST[id]'");
  if ($del) {
    setAlert('success', 'Skill Successfully Deleted');
  } else {
    setAlert('danger', 'Sorry! Failed to Delete Skill.');
  }
}

goback();
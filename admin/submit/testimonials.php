<?php

include_once("../common/functions.php");
checklogin();

$action = $_GET['action'];

if ($action == 'add') {

  $requiredFields = ["title", "name", "designation", "source", "date", "description", "status"];
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
          $sql = "INSERT INTO `testimonials` (`title`, `name`, `designation`, `source`, `date`, `description`, `status`) 
                      VALUES ('$_POST[title]', '$_POST[name]', '$_POST[designation]', '$_POST[source]', '$_POST[date]', '$_POST[description]', '$_POST[status]')";

          $query = mysqli_query($con, $sql);


          $query ? $_SESSION['success'] = "Testimonial Successfully Inserted" : $_SESSION['error'] = "Sorry! Failed to Insert Testimonial.";
        }
        $last_id = $con->insert_id;

        $img_name = $_FILES['image']['name'];

        $save_path = "../../assets/images/testimonials/" . $img_name;
        if ($validated) {
          if (move_uploaded_file($_FILES['image']['tmp_name'], $save_path)) {
            $sql = "UPDATE `testimonials` SET `image`= '$img_name' WHERE id = '$last_id'";

            $query = mysqli_query($con, $sql);
            $query ? setAlert('success', 'Testimonial Successfully Inserted') : setAlert('danger', 'Sorry! Failed to insert Testimonial.');
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

  $requiredFields = ["title", "name", "designation", "source", "description", "status"];
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
    $sql = "UPDATE `testimonials` SET `title`= '$_POST[title]', `name` = '$_POST[name]', `designation` = '$_POST[designation]', `source` = '$_POST[source]', `description` = '$_POST[description]', `status` = '$_POST[status]'  WHERE `id` = '$_POST[id]'";

    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Testimonial Information Successfully Updated') : setAlert('danger', 'Sorry! Failed to Update Testimonial Information.');
  }
  if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != "") {

    $check = getimagesize($_FILES['image']['tmp_name']);

    if ($check !== false) {

      if ($_FILES['image']['size'] > 500000) {

        setAlert('danger', 'Sorry, Your file is too large. Upload Size is Maximum 500KB');
      } else {

        $img_name = $_FILES['image']['name'];

        $save_path = "../../assets/images/testimonials/" . $img_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $save_path)) {
          $sql = "UPDATE `testimonials` SET `image`= '$img_name' WHERE id = '$_POST[id]'";
          $query = mysqli_query($con, $sql);
          setAlert('success', 'Testimonial Photo Successfully Inserted');
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
  $del = mysqli_query($con, "DELETE FROM  `testimonials` WHERE id='$_POST[id]'");
  if ($del) {
    setAlert('success', 'Testimonial Successfully Deleted');
  } else {
    setAlert('danger', 'Sorry! Failed to Delete Testimonial.');
  }
}

goback();
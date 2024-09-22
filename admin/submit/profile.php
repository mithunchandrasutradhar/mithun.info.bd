<?php

include_once("../common/functions.php");
checklogin();


if (!empty($_POST['password'])) {
  $requiredFields = ["id", "name", "email", "phone",  "username"];
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
    $sql = "UPDATE `users` SET `name`= '$_POST[name]', `email` = '$_POST[email]', `phone` = '$_POST[phone]', `username` = '$_POST[username]'  WHERE `id` = '$_POST[id]'";
    $query = mysqli_query($con, $sql);
    $query ? setAlert('success', 'Information Successfully Updated') : setAlert('danger', 'Sorry! Failed to Update Information.');
  }

  if (!empty($_POST['new_password'])) {
    $userp = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `users` WHERE id='$_SESSION[id]'"));
    $userpass = $userp['password'];

    if (crypt($_POST['password'], "founder") == $userpass) {
      $newpass = crypt($_POST['new_password'], "founder");
      $change_pass = mysqli_query($con, "UPDATE `users` SET password='$newpass' WHERE id='$_SESSION[id]'");
      if ($change_pass) {
        setAlert('success', 'Password Successfully Updated');
      } else {
        setAlert('danger', 'Sorry! Failed to Update Password.');
      }
    } else {
      setAlert('danger', 'Sorry! Your given password is not correct.');
    }
  }
  if (isset($_FILES['avatar']) && $_FILES['avatar']['tmp_name'] != "") {

    $check = getimagesize($_FILES['avatar']['tmp_name']);

    if ($check !== false) {

      if ($_FILES['avatar']['size'] > 500000) {

        setAlert('danger', 'Sorry, Your file is too large. Upload Size is Maximum 500KB');
      } else {

        $last_id = $_POST['id'];

        $img_name = $last_id . ".png";

        $save_path = "../assets/images/" . $img_name;

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $save_path)) {

          setAlert('success', 'Profile Picture Successfully Inserted');
        } else {

          setAlert('danger', 'Sorry, Failed to upload Profile Picture');
        }
      }
    } else {

      setAlert('danger', 'Sorry, Your file is not an image.');
    }
  }
} else {
  setAlert('danger', 'Sorry, Please Enter Current Password.');
}
goback();
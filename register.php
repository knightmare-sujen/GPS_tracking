<?php
session_start();
include_once 'database.php';
$number = $_POST['number'];
$password = $_POST['password'];

$file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
$file_loc = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];
$folder = "uploads/";

// new file size in KB
$new_size = $file_size / 1024;
// new file size in KB

// make file name in lower case
$new_file_name = strtolower($file);
// make file name in lower case

$final_file = str_replace(' ', '-', $new_file_name);

$query = mysqli_query($con, "SELECT * FROM usertable WHERE number='$number'");
if (mysqli_num_rows($query) != 0) {
      header('location:registerpage.php?error=already_exist');
} elseif (move_uploaded_file($file_loc, $folder . $final_file)) {
      $sql = "INSERT INTO usertable(password,number,file) VALUES('$password','$number','$final_file')";
      mysqli_query($con, $sql);
      header('location:index1.php?error=sucess');
}
?>
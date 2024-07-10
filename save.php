<?php
require "conn.php";
if (isset($_POST['save'])){
    $image_name = $_FILES['photo']['name'];
    $image_temp = $_FILES['photo']['tmp_name'];
$firstname = $_POST ['firstname'];
    $lastname = $_POST ['lastname'];

    $exp = explode(".",$image_name);
    $ext = end($exp);
    $name = time(). ".".$ext;
    $path = "upload/".$name;
    $allowed_ext = array ("jpeg", "jpg", "gif", "png","PNG");
    if (in_array($ext, $allowed_ext)){
        if(move_uploaded_file($image_temp,$path)){
            mysqli_query($conn, "INSERT INTO `user` (`firstname`,`lastname`, `photo`) VALUES ('$firstname','$lastname','$path')");
            echo "<script> alert('User account saved!); </script>";
            header("location: index.php");
        }
    }
    else{
        echo "<script> alert('Invalid file format. Only JPG, JPEG, PNG, GIF are allowed.'); </script>";
    }
}

?>
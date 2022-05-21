<?php

session_start();

include "../classes/user.php";

$user_id = $_SESSION['id'];
$photo_name = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];

$user = new User;
$user->uploadPhoto($user_id, $photo_name, $tmp_name);

// [name] -> name of the file
// [tmp_name] ->  path of the file inside the temporary storage in your computer (Example: /tmp/php/php6hst32)
// [size] -> size of the file in bytes
// [error] -> the error code of the file (0 if no error)


?>
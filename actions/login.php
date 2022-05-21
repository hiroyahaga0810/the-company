<?php

include "../classes/user.php";

//data for the form
$username = $_POST['username'];
$password = $_POST['password'];

//create an object
$user = new User;

$user->login($username, $password);


?>
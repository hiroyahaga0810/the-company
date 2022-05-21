<?php

include "../classes/user.php";

$user = new User;
$user->deleteUser($_GET['id']);

?>
<?php

session_start();

include "../classes/user.php";

$user = new User;
$user_details = $user->getUser($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="dashboard.php" class="navbar-brand">
            <h1 class="h3">The company</h1>
        </a>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="profile.php" class="nav-link"><?= $_SESSION['username'] ?></a></li>
                <li class="nav-item"><a href="../actions/logout.php" class="nav-link text-danger">Log out</a></li>
            </ul>
        </div>
    </nav>
    <main class="containser" style="padding-top 80px">
        <div class="card w-50 mx-auto border-0">
            <div class="card-header bg-white border-0">
                <h2 class="text-center">EDIT USER</h2>
            </div>
            <div class="card-body">
                <form action="../actions/editUser.php" method="post">
                    <input type="hidden" name="id" value="<?= $user_details['id'] ?>">

                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control mb-2" value="<?= $user_details['first_name'] ?>" required autofocus>

                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control mb-2" value="<?= $user_details['last_name'] ?>" required>

                    <label for="username" class="font-weight-bold">Username</label>
                    <input type="text" name="username" id="username" class="form-control mb-5 font-weight-bold" maxlength="15" value="<?= $user_details['username'] ?>" required>

                    <div class="text-right">
                        <button type="submit" class="btn btn-warning btn-sm px-5">Save</button>
                        <a href="dashboard.php" class="btn btn-secondary btn-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
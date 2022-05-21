<?php

require "database.php";

class User extends Database{
    public function createUser($first_name, $last_name, $username, $password, $photo){
        $password = password_hash($password, PASSWORD_DEFAULT);

        //query
        $sql ="INSERT INTO `users`(`first_name`, `last_name`, `username`, `password`, `photo`) VALUES ('$first_name','$last_name','$username','$password','$photo')";

        //execute
        if ($this->conn->query($sql)){
            header('location: ../views'); // index.php
            exit;
        } else{
            die("Error creating user " . $this->conn->error);
        }
    }

    public function login($username, $password){
        $sql = "SELECT `id`, username, `password` FROM users WHERE username = '$username'";

        //execute the query
        if ($result = $this->conn->query($sql)){
            //check if the username is existing
            if($result->num_rows == 1){
                //check if the password is correct
                $user_details = $result->fetch_assoc();
                if(password_verify($password, $user_details['password'])){
                    session_start();

                    $_SESSION['id'] = $user_details['id'];
                    $_SESSION['username'] = $user_details['username'];

                    header("location: ../views/dashboard.php");
                    exit;
                }else{
                    die("Password is incorrect!");
                }
            }else{
                die("Username not found!");
            }
        }else{
            die("Error loggin in " . $this->conn->error);
        }
    }

    public function getAllUsers($user_id){
        $sql = "SELECT * FROM users WHERE `id` != $user_id";  //!= -> not equal //

        if ($result = $this->conn->query($sql)){
            return $result;
        }else{
            die ("Error retrieving all users: " . $this->conn->error);
        }
    }

    public function  getUser($user_id){
        $sql = "SELECT * FROM users WHERE `id` = $user_id";  //!= -> not equal //

        if ($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die ("Error retrieving all users: " . $this->conn->error);
        }
    }

    public function uploadPhoto($user_id, $photo_name, $tmp_name){
        $sql = "UPDATE users SET photo = '$photo_name' WHERE `id` = $user_id";

        $destination = "../assets/images/$photo_name";

        if ($this->conn->query($sql)){
            if (move_uploaded_file($tmp_name, $destination)){
                header ("location: ../views/profile.php");
                exit;
            }else{
                die("Error moving the photo");
            }       
         }else{
             die("Error uploading photo: " . $this->conn->error);
         }

    }   

    public function updateUser($user_id, $first_name, $last_name, $username){
        $sql = "UPDATE users SET first_name = '$first_name', `last_name` = '$last_name', `username` = '$username' WHERE `id` = $user_id";
        
        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            die("Error updating user: " . $this->conn->error);
        }
    }

    // public function uploadPhoto($user_id, $image_name, $tmp_name){
    //     $sql = "UPDATE users SET photo = '$image_name' WHERE `id` = $user_id";

    //     if($this->conn->query($sql)){
    //         $destination = "../images/$image_name";
    //         if(move_uploaded_file($tmp_name, $destination)){
    //             header("location: ../views/profile.php");
    //             exit;
    //         }else{
    //             die("Error moving the photo.");
    //         }
    //     }else{
    //         die("Error uploading photo: " . $this->conn->error);
    //     }
    // }

    public function deleteUser($user_id){
        $sql = "DELETE FROM users WHERE `id` = $user_id";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            die("Error deleting user: " . $this->conn->error);
        }
    }

}

?>
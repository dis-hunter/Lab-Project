<?php
require_once 'classes/User.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $password=trim($_POST['password']);

    $user=new User();
    if($user->createUser($username, $email, $password)){
        echo "User created successfully";
}else{
    echo "Error registering user."
}
?>
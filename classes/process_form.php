<?php
require_once 'classes/User.php';

class process_form{
    public function SignUp(){

        if(isset($_POST['signup'])){

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $password=trim($_POST['password']);


    die($username);
}


    if(empty($username) || empty($email) || empty($password)){
        die("Please fill in all fields");
    }

    $user=new User();
    if($user->createUser($username, $email, $password)){
        echo "User created successfully";
}else{
    echo "Error registering user."
}
}
    }
}
?>
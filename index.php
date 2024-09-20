<?php

public  function User_form(){

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <!--------------------------------------Main Container------------------------------------->
<div class="container d-flex justify-content-center align-items-center max-vh-60">




    <!----------------------------------Login Container------------------------------------------>
<div class="row border rounded-5 p-3 bg-white shadow box-area" style="height: 95vh; color:black;">


    <!-----------------------------------Left Box------------------------------------------------>
<div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style=" height: 90vh; background-color: black;">
<div class="featured-image mb-3">
    <img src="images\lab-project1.jpg" class="img-fluid" style="width: 400px; height: 500px; margin-bottom: 40px;">
</div>



</div>


    <!--------------------------------------Right Box-------------------------------------------->

    <div class="col-md-6  right-box">
        <div class="row align-items-center">
            <div class="header-text mb-4">
              <h2> Welcome</h2>
              <p>We are happy to have you .</p>
            </div>
            <form method="post" action="process_form.php"> 
            <div class="input-group mb-2">
                <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
            </div>
            <div class="input-group mb-1">
                <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Username">
            </div>
            <div class="input-group mb-1">
                <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
            </div>
            <div class="input-group mb-1">
                <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Confirm Password">
            </div>
            <div class="input-group mb-5 d-flex justify-content-between">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="formCheck">
                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
              </div>
              
            </div>
            <div class="input-group mb-3">
                <button class="btn btn-lg btn-primary w-100 fs-6">Sign Up</button>
            </div>
            <div class="input-group mb-3">
                <button class="btn btn-lg btn-light w-100 fs-6"><img src="images\google.png" style="width: 20px;" class="me-2"><small>Sign Up with Google</small></button>
            </div>
            </form>
            




        </div>


    </div>

    </div>
    </div>
    
</body>
</html>
<?php
}
?>
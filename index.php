<?php include("login.php");?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="main.js"></script>
</head>
<body>


<div id="indexMenu">
    <div class="nav">
        <a class="register" style="text-decoration: underline">Register</a>
        <a href="about.php">About Us</a>
        <a href="">Contact Us</a>
    </div>
</div>

<div class="loginPlace activeSec">
    <div class="loginLeftSec">
        <p class="firstLine">Nice to see you again!</p>
        <p class="secondLine">Welcome Back</p>
        <div class="breakLine"></div>
        <p class="thin">TBH we are really proud to have you.</p>
        <p class="thin">If any of our services need to be improved<br>Feel free to get in touch with us</p>
        <p class="contactInfo">contact@liber.com</p>
    </div>
    <div class="loginRightSec" >
        <p class="loginTitle">Sign in to Liber</p>
        <form method="post">

            <img class="loginIconImg" src="img/email.png"><br>
            <input class="loginInputs" name="signinEmail" placeholder="Email" type="email">

            <div class="clear"></div>
            <img class="loginIconImg" src="img/padlock.png"><br>
            <input class="loginInputs"  name="signinPassword" placeholder="Password" type="password">

            <a class="grayUnderline" href="forgotPass.php">Forgot your password?</a>

            <input class="loginSignUp" name="loginSubmit" type="submit" value="Sign In">
            <a style="margin-top: 5px" id="createAc" class="grayUnderline">Create an account</a>
        </form>
    </div>
</div>

    <div class="signUpPlace">
        <div class="loginRightSec">
            <p class="loginTitle top" style="margin-top: 50px">Sign in to Liber</p>
            <form method="post">
                <img style="width: 22px" class="loginIconImg" src="img/id-card.png"><br>
                <input class="loginInputs" name="fullName" placeholder="Full Name" type="text">

                <div class="clear"></div>
                <img class="loginIconImg" src="img/email.png"><br>
                <input class="loginInputs" name="signupEmail" placeholder="Email" type="email">

                <div class="clear"></div>
                <img class="loginIconImg" src="img/phone.png"><br>
                <input class="loginInputs" name="signupPhone" placeholder="Phone Numbers" type="text">

                <div class="clear"></div>
                <img class="loginIconImg" src="img/padlock.png"><br>
                <input class="loginInputs" name="signupPassword" placeholder="Password" type="password">

                <input class="loginSignUp1" name="submit" type="submit" value="Sign Up">
                <a style="margin-top: 40px" class="grayUnderline">Already have an account?</a>
            </form>
        </div>
        <div class="loginLeftSec">
            <p class="firstLine">Nice to see you again!</p>
            <p class="secondLine">Welcome Back</p>
            <div class="breakLine"></div>
            <p class="thin">TBH we are really proud to have you.</p>
            <p class="thin">If any of our services need to be improved<br>Feel free to get in touch with us</p>
            <p class="contactInfo">contact@liber.com</p>
        </div>

    </div>




</body>
</html>
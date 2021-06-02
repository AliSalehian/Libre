<? include("login.php");?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <? echo $errorS;
       echo "<br>";
    ?>
    <form method="post">
        <label for="fullName">Full Name</label>
        <input name="fullName" placeholder="Full Name" type="text">
        <br>
        <br>
        <label for="signupEmail">Email</label>
        <input name="signupEmail" placeholder="Email" type="email">
        <br>
        <br>
        <label for="signupPhone">Phone Number</label>
        <input name="signupPhone" placeholder="Phone Numbers" type="text">
        <br>
        <br>
        <label for="signupPassword">Password</label>
        <input name="signupPassword" placeholder="Password" type="password">
        <br>
        <br>

        <input name="submit" type="submit" value="Sign Up">
    </form>

    <hr>

    <form method="post">

        <label for="signinEmail">Email</label>
        <input name="signinEmail" placeholder="Email" type="email">

        <label for="signinPassword">Password</label>
        <input name="signinPassword" placeholder="Password" type="password">
        <br>
        <br>

        <input name="loginSubmit" type="submit" value="Sign In">
    </form>

</body>
</html>
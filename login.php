<?php

    session_start();
    if(isset($_GET['logout']) == 1 AND isset($_SESSION['id']) ? $_SESSION['id'] : ''){
        session_destroy();
        session_start();
        $message = "You have been logged out";
    }
    include ("connection.php");
    $error = "";
    $errorF = "";
    $errorS = "";
    if(isset($_POST['submit']) == 'Sign Up'){
        if(!$_POST['fullName']){
            $error = "Please  write your name";
        }
        if(!$_POST['signupEmail']){
            $error .= "<br>Please  write your email address";
        }else if(!(filter_var($_POST['signupEmail'], FILTER_VALIDATE_EMAIL))){

            $error.= "<br>Please enter a valid email address.";
        }

        if(!$_POST['signupPassword']){
            $error .= "<br>Please choose a Password";
        }else{
            if(strlen($_POST['signupPassword']) < 8){
                $error .= "<br>Your password needs to be more than 8 characters";
            }
            if(!preg_match('`[A-Z]`', $_POST['signupPassword'])){
                $error .= "<br>Your password need to have at least on capital letter";
            }
        }

        if($error){
            echo "Fail to sign up, ".$error;
        }else{
            echo  "<br>pass, email and stuff are oka";
            $query = "SELECT * FROM Student WHERE Email = '".mysqli_real_escape_string($conn, $_POST['signupEmail'])."'";
            $result = mysqli_query($conn, $query);
            $results = mysqli_num_rows($result);

            if($results) $errorF = "This email has already been used";
            else{
                echo  "<br>No duplicate emails<br>";
                $query = "INSERT INTO `Student` (`FullName`, `Email`, `MobileNumber`, `Password`) 
                          VALUES('".mysqli_real_escape_string($conn, $_POST['fullName'])."', 
                          '".mysqli_real_escape_string($conn, $_POST['signupEmail'])."', 
                          '".mysqli_real_escape_string($conn, $_POST['signupPhone'])."', 
                          '".md5(md5($_POST['signupEmail']).$_POST["signupPassword"])."')";
                mysqli_query($conn, $query) or die('Error, insert query failed');
                echo "You have been signed up!";

                $_SESSION['id'] = mysqli_insert_id($conn);
                print_r($_SESSION);


                //Redirect to the dashboard;
            }

        }
    }


    if(isset($_POST['loginSubmit'])){
        if(!$_POST['signinEmail']){
            $errorS = "<br>Please write down your email address";
        }else if(!(filter_var($_POST['signinEmail'], FILTER_VALIDATE_EMAIL))){

            $errorS.= "<br>Please enter a valid email address.";
        }
        if(!$_POST['signinPassword']){
            $errorS = "<br>Plase write down your password<br>";
        }

        if($errorS) echo "Sign in errors, ".$errorS;
        else{
            $query = "SELECT * FROM Student WHERE Email = '".mysqli_real_escape_string($conn, $_POST['signinEmail'])."' 
                      AND Password = '".md5(md5($_POST['signinEmail']).$_POST['signinPassword'])."' AND Status != 0";
            $result = mysqli_query($conn, $query);
            $fetch = mysqli_fetch_array($result);
            $query1 = "SELECT * FROM Student WHERE Email = '".mysqli_real_escape_string($conn, $_POST['signinEmail'])."'
                      AND Status = 0";
            $result1 = mysqli_query($conn, $query1);
            $fetch1 = mysqli_fetch_array($result1);
            if($fetch){
                $_SESSION['id'] = $fetch['id'];
                print_r($_SESSION);
                //Redirect
                header("Location: dashboard.php");
                exit();
            }else if($fetch1){
                $errorS = "<br>You are blocked. Contact 0800 LIBRE";
            }else{
                $errorS = "<br>Either your password or email is wrong. Please try again.";
            }
        }
    }


?>
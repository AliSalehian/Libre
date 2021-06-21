<?php
    include ("connection.php");

    $errorEmail = "";
    $errorName = "";
    $errorPhone = "";
    $errorCurrent = "";
    $errorNew = "";

    $id = $_SESSION['id'];
    $query = "SELECT * FROM Student WHERE id = '".$id."'";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if(isset($_POST['studentProfile'])){
        if(!$_POST['studentNameProfile']){
            $errorName = "<br>Please write down your Name";
        }
        if(!$_POST['studentEmailProfile']){
            $errorEmail = "<br>Please write down your Email address";
        }
        if(!$_POST['studentPhoneProfile']){
            $errorPhone = "<br>Please write down your phone number";
        }

        if($errorEmail OR $errorName OR $errorPhone ) "There is some issues </br>". $errorCurrent;
        else{
            if($_POST['studentNewPassProfile']){
                if(!$_POST['studentCurrentProfile']){
                    $errorCurrent = "<br>Please write down your Current Password First";
                }else{
                    $query = "SELECT * 
                              FROM Student
                              WHERE id = '".$id."' AND Password = '".md5(md5($row['Email']).$_POST['studentCurrentProfile'])."'";

                    $result = mysqli_query($conn, $query);
                    $results = mysqli_num_rows($result);

                    if(!$results) $errorCurrent = "<br>Your current password is wrong";
                    else{
                        $query = "UPDATE Student
                          SET FullName = '" .$_POST['studentNameProfile']. "',
                          Email = '" .$_POST['studentEmailProfile']. "',
                          MobileNumber = '" .$_POST['studentPhoneProfile']. "',
                          Password = '" .md5(md5($_POST['studentEmailProfile']).$_POST['studentNewPassProfile']). "'
                          WHERE id = '".$id."'";
                        mysqli_query($conn, $query) or die('Error, insert query failed');
                    }
                }
            }else{

                $query = "UPDATE Student
                          SET FullName = '" .$_POST['studentNameProfile']. "',
                          Email = '" .$_POST['studentEmailProfile']. "',
                          MobileNumber = '" .$_POST['studentPhoneProfile']. "'
                          WHERE id = '".$id."'";
                mysqli_query($conn, $query) or die('Error, insert query failed');
            }
        }

    }

    if(isset($_POST['submitPhoto'])){
        $file = addslashes(file_get_contents($_FILES['updateProfilePhoto']['tmp_name']));
        $query = "UPDATE Student
                  SET profileImg = '" .$file. "'
                  WHERE id = '".$id."'";
        mysqli_query($conn, $query) or die('Error, insert query failed');


    }

?>
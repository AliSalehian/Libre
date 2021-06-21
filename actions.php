<?php

    session_start();
    include ("connection.php");

    if($_POST['code'] == 1){
        $query = "UPDATE Student SET Status = '".$_POST['status']."' WHERE id = '".$_POST['id']."' LIMIT 1";
        mysqli_query($conn, $query);
    }
    if($_POST['code'] == 2){
        $query = "SELECT * FROM `IssueDetails` WHERE issueBookID = '" .$_POST['id']. "'";
        $result = mysqli_num_rows(mysqli_query($conn, $query));
        if(!$result){
            $query = "INSERT INTO `IssueDetails` (`studentID`, `issueBookID`, `issueStatus`)
                  VALUES(
                     '" .$_SESSION['id']. "',
                     '" .$_POST['id']. "',
                     2
                  )";
            mysqli_query($conn, $query);
        }

    }
    if($_POST['code'] == 3){
        $query = "SELECT * FROM `IssueDetails` WHERE issueBookID = '" .$_POST['id']. "'";
        $result = mysqli_num_rows(mysqli_query($conn, $query));
        if(!$result){
            $query = "INSERT INTO `IssueDetails` (`studentID`, `issueBookID` ,`issueStatus`)
                      VALUES(
                         '" .$_SESSION['id']. "',
                         '" .$_POST['id']. "',
                         1
                      )";
            mysqli_query($conn, $query);
            $queryUpdate = "UPDATE IssueDetails 
                        SET `ReturnDate` = DATE_ADD(`IssueDate` , INTERVAL 14 DAY)
                        WHERE issueBookID = '" .$_POST['id']. "'";
            mysqli_query($conn, $queryUpdate);
        }

    }

    if($_POST['code'] == 4){
        $query = "DELETE FROM IssueDetails WHERE issueID= '".$_POST['id']."'";
        mysqli_query($conn, $query);
    }
    if($_POST['code'] == 5){
        $query = "SELECT * FROM Student WHERE FullName = '".$_POST['userName']."'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_array($result);
        //echo $user['Email'];
        if(mail($user['Email'],"Email from Liber",$_POST['emailText'])){
            echo "Email Sent";
        }else{
            echo "Email failed";
        }
    }

    if($_POST['code'] == 6){
        $query = "DELETE FROM Book WHERE bookID= '".$_POST['id']."'";
        mysqli_query($conn, $query);
    }

/*if(mysqli_query($conn, $query)){
        echo "updated";
    }else{
        echo "failed";
    }
    //print_r($_SESSION);*/
?>
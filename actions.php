<?php

    session_start();
    include ("connection.php");

    $query = "UPDATE Student SET Status = '".$_POST['status']."' WHERE id = '".$_POST['id']."' LIMIT 1";

    if(mysqli_query($conn, $query)){
        echo "updated";
    }else{
        echo "failed";
    }


    //print_r($_SESSION);


?>
<?php


function findInQuery($select,$table, $conn){


    $query = "SELECT ".$select." 
              FROM ".$table."";

    $result = mysqli_query($conn, $query);

    return $row = mysqli_num_rows($result);


}

?>
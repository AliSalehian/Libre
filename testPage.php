<?php


function findInQuery($select,$table, $conn){
    $query = "SELECT ".$select." 
              FROM ".$table."";

    $result = mysqli_query($conn, $query);

    return $row = mysqli_num_rows($result);
}

function findInQueryWithWhere($select,$table,$where, $conn){
    $query = "SELECT ".$select." 
              FROM ".$table."
              WHERE ".$where." = 1";

    $result = mysqli_query($conn, $query);

    return $row = mysqli_num_rows($result);
}

?>
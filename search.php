<?php
include ("connection.php");
if(isset($_POST['search'])){
    $req = $_POST['search'];
    $query = "SELECT * 
          FROM Book b 
          JOIN Author a 
            ON b.authorID = a.id  
          JOIN Category c 
            ON b.categoryID = c.id
          LEFT JOIN IssueDetails i
            ON i.issuebookID = b.bookID
          WHERE b.BookName LIKE '%".$req."%' OR a.AuthorName LIKE '%".$req."%'
          ORDER BY i.issueStatus ASC";
    $result1 = mysqli_query($conn, $query);
    $numResults = mysqli_num_rows($result1);
}

?>
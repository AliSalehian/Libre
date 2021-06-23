<?php
session_start();
include ("connection.php");
include("NotLoggedIn.php");
include ("search.php");

echo $_POST['boookid'];


$id = $_SESSION['id'];
$query = "SELECT * FROM Student WHERE id = '".$id."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$query = "SELECT * 
          FROM Book b 
          JOIN Author a 
            ON b.authorID = a.id  
          JOIN Category c 
            ON b.categoryID = c.id
          LEFT JOIN IssueDetails i
            ON i.issuebookID = b.bookID
          ORDER BY i.issueStatus ASC";
$result = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>
        <?php
            echo $row['FullName']. " Dashboard";
        ?>
    </title>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="main.js"></script>

</head>

<body>

<div id="Menu">
    <p id="name">LIBRE</p>
    <ul>
        <?php
        if($_SESSION['id'] == 19){
            echo '<li class="floatLeft"><a href="dashboard.php?">Admin Dashboard</a></li>';
        }
        ?>
        <li class="floatLeft selected"><a href="studentDashboard.php?page=1">Books</a></li>
        <li class="floatLeft"><a href="studentIssueBook.php?page=1">Issue Books</a></li>
        <li class="floatLeft studentProfile">
            <?php
                if(is_null($row['profileImg'])) {
                    echo '<img class="profileImgNo" src="img/user.png"/>';
                }
                else {
                    echo '<img class="profileImg" src="data:image/jpeg;base64,' . base64_encode($row['profileImg']) . '"/>';
                }
            ?>
        </li>
        <li class="floatLeft" id="button"><a href="index.php?logout=1">Logout</a></li>
    </ul>
</div>

<div class="page">

    <div id="pageTitle">Books</div>
    <div id="searchPlace">
        <form method="post" action="result.php">
            <div id="searchIcon"></div>
            <input id="search" type="text" name="search" placeholder="Search books, authors">
        </form>
    </div>
    <div class="clear"></div>

    <div class="bookList">
        <?php

            while($i = mysqli_fetch_array($result)){

                echo '<div class="bookPlace" id = "'.$i['bookID'].'">';
                echo '<img class="bookImgPlace" src="data:image/jpeg;base64,'.base64_encode( $i['img'] ).'"/>';
                echo '<h2>'.$i['BookName'].'</h2>';
                echo '<div class="authorPlace">';
                echo '<img class="poet" src="img/poet.png">';
                echo '<h3 class="authorName">'.$i['AuthorName'].'</h3>';
                echo '</div>';
                echo '<div class="clear"></div>';
                if($i['issueStatus'] == 1)  echo '<h3 class="issued">Issued</h3>';
                else if($i['issueStatus'] == 2) echo '<h3 class="reserved">Reserved</h3>';
                else echo '<h3 class="available">Available</h3>';
                echo '</div>';
            }
        ?>
    </div>
    <br>

</div>
<!--<div id="bottom">
    <p id="footer">&#169; 2021 Libre Online Library Management Panel</p>
</div>-->

</body>

</html>

<?php
session_start();
include ("connection.php");
include("NotLoggedIn.php");


$id = $_SESSION['id'];
$bookID = $_GET['bookId'];
$bookStatus = $_GET['status'];

$query = "SELECT * FROM Student WHERE id = '".$id."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if($bookStatus == "issued"){
    $query = "SELECT * 
          FROM IssueDetails i 
          JOIN Book b 
            ON i.issuebookID = b.bookID
          JOIN Author a 
            ON b.authorID = a.id  
          JOIN Category c 
            ON b.categoryID = c.id
          WHERE i.issuebookID ='".$bookID."'
          LIMIT 1";
    $issueResult = mysqli_query($conn, $query);
    $r= mysqli_fetch_array($issueResult);

//Date
    $date = $r['ReturnDate'];
    $time=strtotime($date);
    $month=date("F",$time);
    $day=date("d",$time);
}else{
    $query = "SELECT * 
          FROM Book b 
          JOIN Author a 
            ON b.authorID = a.id  
          JOIN Category c 
            ON b.categoryID = c.id
          WHERE bookID ='".$bookID."'
          LIMIT 1";
    $result = mysqli_query($conn, $query);
    $r= mysqli_fetch_array($result);
}


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
        <li class="floatLeft studentProfile"><a href="studentProfile.php"></a></li>
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

    <div id="pageTitle"><?php echo $r['BookName'] ?></div>
    <div id="searchPlace">
        <form method="post" action="result.php">
            <div id="searchIcon"></div>
            <input id="search" type="text" name="search" placeholder="Search books, authors">
        </form>
    </div>
    <div class="clear"></div>
    <div class="bookAndDescPlace">

        <div class="bookImgPlace" id="<?php echo $bookID ?>">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $r['img'] ).'"/>'; ?>
        </div>
        <div class="descPlace">
            <div class="BookName">
                <p class="float-left bookName">Name</p>
                <p class="float-left bookNamePlace"><?php echo $r['BookName'] ?></p>
            </div>
            <div class="clear"></div>

            <div class="BookName">
                <p class="float-left bookName">Author</p>
                <p class="float-left bookNamePlace"><?php echo $r['AuthorName'] ?></p>
            </div>
            <div class="clear"></div>

            <div class="BookName">
                <p class="float-left bookName">ISBN</p>
                <p class="float-left bookNamePlace"><?php echo $r['BookISBN'] ?></p>
            </div>
            <div class="clear"></div>

            <div class="BookName">
                <p class="float-left bookName">Category</p>
                <p class="float-left bookNamePlace"><?php echo $r['CategoryName'] ?></p>
            </div>
            <div class="clear"></div>

            <div class="BookName">
                <p class="float-left bookName">Plot</p>
                <p class="float-left bookNamePlace desc"><?php echo $r['Description'] ?></p>
            </div>
            <div class="clear"></div>
            <?php
                if($bookStatus == "issued"){
                    echo '<p class="selectedBookButton red">Issued<span><br>Available '.$month." ".$day.'</span></p>';
                    echo '<p class="selectedBookButton gray">Reserve for 2 hours<br> <span>FREE</span></p>';
                    echo '<p class="selectedBookButton gray">Reserve for a week<br> <span>£2.00</span></p>';
                }
                else if($bookStatus == "available"){
                    echo '<p class="selectedBookButton green">Available <br><span>Reserve Now</span></p>';
                    echo '<p class="selectedBookButton blue">Reserve for 2 hours<br> <span>FREE</span></p>';
                    echo '<p class="selectedBookButton blue">Reserve for a week<br> <span>£2.00</span></p>';
                }else{
                    echo '<p class="selectedBookButton yellow">Reserved <br><span>Try again later!</span></p>';
                    echo '<p class="selectedBookButton gray">Reserve for 2 hours<br> <span>FREE</span></p>';
                    echo '<p class="selectedBookButton gray">Reserve for a week<br> <span>£2.00</span></p>';
                }
            ?>
            <?php

                if(empty($r['summaryPDF'])){

                    echo '<p id="'.$bookID.'" class="freeDownloadButDis">Download the summary</p>';
                }else if(!empty($r['summaryPDF'])){
                    echo '<p id="'.$bookID.'" class="freeDownloadBut">Download the summary</p>';

                }
            ?>


        </div>

    </div>
    <br>

</div>
<!--<div id="bottom">
    <p id="footer">&#169; 2021 Libre Online Library Management Panel</p>
</div>-->

</body>

</html>

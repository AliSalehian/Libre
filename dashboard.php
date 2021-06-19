<?php
session_start();
include ("connection.php");
include("NotLoggedIn.php");
include("AdminCheck.php");

include("testPage.php");

$book = findInQuery("b.bookID", "Book b", $conn);
$author = findInQuery("a.id", "Author a", $conn);
$category = findInQuery("c.id", "Category c", $conn);
$student = findInQuery("s.id", "Student s", $conn);
$issueBooks = findInQueryWithWhere("i.issueID", "IssueDetails i", "i.issueStatus", $conn);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>dashboard</title>

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
        <li class="floatLeft selected"><a href="dashboard.php">Dashboard</a></li>
        <li class="floatLeft"><a href="category.php?page=1">Categories</a></li>
        <li class="floatLeft"><a href="author.php?page=1">Authors</a></li>
        <li class="floatLeft "><a href="book.php?page=1">Books</a></li>
        <li class="floatLeft"><a href="IssueBooks.php?page=1">Issue Books</a></li>
        <li class="floatLeft"><a href="student.php?page=1">Students</a></li>
        <li class="floatLeft"><a href="">Profile</a></li>
        <li class="floatLeft" id="button"><a href="index.php?logout=1">Logout</a></li>
    </ul>
</div>

<div class="page">

    <div id="pageTitle">Admin Dashboard</div>
    <div id="searchPlace">
        <form>
            <div id="searchIcon"></div>
            <input id="search" type="text" name="search" placeholder="Search books, authors">
        </form>
    </div>
    <div class="clear"></div>



    <div class="clearfix" id="boxes">
        <div class="box">
            <div class="iconBack">
                <img src="img/books.png">
            </div>
            <p class="boxTextStyle">Number of books</p>
            <p class="boxNumberStyle"> <?php echo $book ?> </p>
        </div>
        <div class="box">
            <div class="iconBack">
                <img src="img/poet.png">
            </div>
            <p class="boxTextStyle">Number of authors</p>
            <p class="boxNumberStyle"> <?php echo $author ?> </p>
        </div>
        <div class="box">
            <div class="iconBack">
                <img src="img/dashboard.png">
            </div>
            <p class="boxTextStyle">Number of categories</p>
            <p class="boxNumberStyle"> <?php echo $category ?> </p>
        </div>
        <div class="box">
            <div class="forSmallIconBack">
                <img src="img/students.png">
            </div>
            <p class="boxTextStyle">Number of students</p>
            <p class="boxNumberStyle"> <?php echo $student ?> </p>
        </div>
        <div class="box">
            <div class="iconBack">
                <img src="img/read.png">
            </div>
            <p class="boxTextStyle">Number of issued books</p>
            <p class="boxNumberStyle"> <?php echo $issueBooks ?> </p>
        </div>


    </div>

</div>


<div id="bottom">
    <p id="footer">&#169; 2021 Libre Online Library Management Panel</p>
</div>

</body>

</html>

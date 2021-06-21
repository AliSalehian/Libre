<?php
session_start();
include ("connection.php");
include("NotLoggedIn.php");

if(!isset($_GET['option'])) $option = 10;
else $option = $_GET['option'];

$resultPerPage = $option;

$id = $_SESSION['id'];
$query = "SELECT * FROM Student WHERE id = '".$id."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$query = "SELECT * 
          FROM IssueDetails i 
          JOIN Book b
            ON i.issuebookID = b.bookID
          JOIN Student s
            ON s.id = i.studentID
          WHERE s.id = '".$id."'";
$result = mysqli_query($conn, $query);
$numberOfResults = mysqli_num_rows($result);

$numberOfPages = ceil($numberOfResults/$resultPerPage);

if(!isset($_GET['page'])) $page = 1;
else $page = $_GET['page'];
$this_page_first_result = ($page-1)*$resultPerPage;

$query = "SELECT * 
          FROM IssueDetails i 
          JOIN Book b
            ON i.issuebookID = b.bookID
          JOIN Student s
            ON s.id = i.studentID
          WHERE s.id = '".$id."'
          LIMIT ".$this_page_first_result.','.$resultPerPage;
$result = mysqli_query($conn, $query);
$rows = $this_page_first_result;
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
        <li class="floatLeft"><a href="studentDashboard.php?page=1">Books</a></li>
        <li class="floatLeft selected"><a href="studentIssueBook.php?page=1">Issue Books</a></li>
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
        <form>
            <div id="searchIcon"></div>
            <input id="search" type="text" name="search" placeholder="Search books, authors">
        </form>
    </div>
    <div class="clear"></div>
    <form class="rowNums">
        <select id="records" class="options" name="rows">
            <option value="0">Select</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </form>
    <p id="recordsPerPage">Records per page</p>
    <div class="pageNum">
        <i class="fas fa-chevron-left float-left leftrightIcon"></i>
        <?php
        for($page = 1; $page <= $numberOfPages; $page++){
            echo "<p class='numPage'><a href='IssueBooks.php?page=".$page."'>".$page."</a></p>";
        }
        ?>
        <i class="fas fa-chevron-right float-left leftrightIcon"></i>
    </div>
    <div class="clear"></div>
    <div id="tbl" style="overflow-x:auto;">
        <table id="category">
            <tr>
                <th>#</th>
                <th>Book</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php

            while($row = mysqli_fetch_array($result)){
                echo "<td>".++$rows."</td>";
                echo "<td><img class='issueBookImg' src='data:image/jpeg;base64,".base64_encode( $row['img'] )."'><p>".$row['BookName']."</p></td>";
                echo "<td>".$row['IssueDate']."</td>";
                echo "<td>".$row['ReturnDate']."</td>";
                if($row['issueStatus'] == 1 ){
                    echo "<td><p class='issueBtn'>Issued</p></td>";
                    echo "<td><a id='".$row['issueID']."' class='returnBtnS'>Return Book</a>";
                }
                else if($row['issueStatus'] == 2 ){
                    echo "<td><p class='reserveBtn'>Reserved</p></td>";
                    echo "<td><a id='".$row['issueID']."' class='returnBtnS'>Dismiss Reserve</a></td>";
                }


                echo "</tr>";
            }
            ?>


        </table>
    </div>
    <br>

</div>
<!--<div id="bottom">
    <p id="footer">&#169; 2021 Libre Online Library Management Panel</p>
</div>-->

</body>

</html>

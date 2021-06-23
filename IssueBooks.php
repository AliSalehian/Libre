<?php
session_start();
include ("connection.php");
include("NotLoggedIn.php");
include ("AdminCheck.php");

include("add.php");
include("edit.php");

if(!isset($_GET['option'])) $option = 10;
else $option = $_GET['option'];

$resultPerPage = $option;
$query = "SELECT * 
          FROM IssueDetails i 
          JOIN Book b
            ON i.issuebookID = b.bookID
          JOIN Student s
            ON s.id = i.studentID";
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
          LIMIT ".$this_page_first_result.','.$resultPerPage;
$result = mysqli_query($conn, $query);
$rows = $this_page_first_result;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Admin-Issue Books</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="main.js"></script>
</head>

<body>
<div class="blackBackPop"></div>
<div class="popup center">
    <i class="fas fa-times exitIcon"></i>
    <div class="icon">
        <i class="fa fa-at"></i>
    </div>
    <div class="title">
        Send an Email
    </div>
    <div class="description">
        <form method="post">
            <p class="addName">Name</p>
            <input id="userEmail" name="userEmail" class="addFormTextArea" readonly>
            <p class="addName">Sample Emails</p><br><br><br>
            <p class="sampleEmail">Dear <span class="issuedName"></span>  <br><br>Plase contact 0800Liber ASAP <br><br>Regards, Liber Customer service.</p>
            <p class="sampleEmail">Dear <span class="issuedName"></span>  <br><br>You have issued '<span id="bookNamePlace"></span>'.
                <br>Please return the book within the next 2 days<br><br>Regards, Liber Customer service.</p>
            <p class="addName">Email</p>
            <textarea name="emailText" placeholder="Email text" class="addFormTextArea addBookText"></textarea>
            <input class="popUpSubmitBtn" type="submit" name="submitEmail" value="Send Email">
        </form>
    </div>
</div>

<div id="Menu">
    <p id="name">LIBRE</p>
    <ul>
        <li class="floatLeft"><a href="dashboard.php">Dashboard</a></li>
        <li class="floatLeft"><a href="studentDashboard.php?page=1">BL</a></li>
        <li class="floatLeft"><a href="category.php?page=1">Categories</a></li>
        <li class="floatLeft"><a href="author.php?page=1">Authors</a></li>
        <li class="floatLeft"><a href="book.php?page=1">Books</a></li>
        <li class="floatLeft selected"><a href="IssueBooks.php?page=1">Issue Books</a></li>
        <li class="floatLeft"><a href="student.php?page=1">Students</a></li>
        <li class="floatLeft"><a href="adminProfile.php">Profile</a></li>
        <li class="floatLeft" id="button"><a href="index.php?logout=1">Logout</a></li>
    </ul>
</div>

<div class="page">
    <div id="pageTitle">Issue Books</div>
    <div id="searchPlace">
        <form method="post" action="result.php">
            <div id="searchIcon"></div>
            <input id="search" type="text" name="search" placeholder="Search books, authors">
        </form>
    </div>
    <div class="clear"></div>
    <!--<?php echo $_SESSION['id']; ?> -->
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
                <th>Student Name</th>
                <th>Book</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php

            while($row = mysqli_fetch_array($result)){
                echo "<td>".++$rows."</td>";
                echo "<td>".$row['FullName']."</td>";
                echo "<td><img class='issueBookImg' src='data:image/jpeg;base64,".base64_encode( $row['img'] )."'><p>".$row['BookName']."</p></td>";
                echo "<td>".$row['IssueDate']."</td>";
                echo "<td>".$row['ReturnDate']."</td>";
                if($row['issueStatus'] == 1 ){
                    echo "<td><p class='issueBtn'>Issued</p></td>";
                    echo "<td><a id='".$row['issueID']."' class='returnBtn'>Return Book</a><a class='emailNotif'><img src='img/email.png'></a></td>";
                }
                else if($row['issueStatus'] == 2 ){
                    echo "<td><p class='reserveBtn'>Reserved</p></td>";
                    echo "<td><a id='".$row['issueID']."' class='returnBtn'>Dismiss Reserve</a><a class='emailNotif'><img src='img/email.png'></a></td>";
                }


                echo "</tr>";
            }
            ?>


        </table>
    </div>


</div>

<script>


</script>
</body>

</html>

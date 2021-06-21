<?php
session_start();
include ("connection.php");
include("NotLoggedIn.php");
include("AdminCheck.php");
include("add.php");
include("edit.php");

if(!isset($_GET['option'])) $option = 10;
else $option = $_GET['option'];

$resultPerPage = $option;
$query = "SELECT * FROM Author";
$result = mysqli_query($conn, $query);
$numberOfResults = mysqli_num_rows($result);

$numberOfPages = ceil($numberOfResults/$resultPerPage);

if(!isset($_GET['page'])) $page = 1;
else $page = $_GET['page'];
$this_page_first_result = ($page-1)*$resultPerPage;

$query = "SELECT * FROM Author LIMIT ".$this_page_first_result.','.$resultPerPage;
$result = mysqli_query($conn, $query);
$rows = $this_page_first_result;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Admin-Author</title>
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
        <i class="fa fa-plus"></i>
    </div>
    <div class="title">
        Add an Author
    </div>
    <div class="description">

        <form method="post">
            <p class="addName">Author Name</p>
            <input placeholder="Name of the Author" name="addAuthor" type="text" class="addFormTextArea">
            <input class="popUpSubmitBtn" type="submit" name="submitNewAuthor" value="Add">
        </form>
    </div>
</div>

<div class="blackBackPopEdit"></div>
<div class="popupEdit center">
    <i class="fas fa-times exitIconEdit"></i>
    <div class="icon">
        <i class="far fa-edit"></i>
    </div>
    <div class="title">
        Edit Author Name
    </div>
    <div class="description">

        <form method="post">
            <p class="addName">ID</p>
            <input id="authorIdPlaceHolder" name="AuthorId" class="addFormTextArea" readonly>
            <p class="addName">Author Name</p>
            <input id="authorPlaceHolder" placeholder="Name of the Author" name="editAuthor" type="text" class="addFormTextArea">
            <input class="popUpSubmitBtn" type="submit" name="submitEditAuthor" value="Edit">
        </form>
    </div>
</div>
<div id="Menu">
    <p id="name">LIBRE</p>
    <ul>

        <li class="floatLeft"><a href="dashboard.php">Dashboard</a></li>
        <li class="floatLeft"><a href="studentDashboard.php?page=1">BL</a></li>
        <li class="floatLeft"><a href="category.php?page=1">Categories</a></li>
        <li class="floatLeft selected"><a href="author.php?page=1">Authors</a></li>
        <li class="floatLeft"><a href="book.php?page=1">Books</a></li>
        <li class="floatLeft"><a href="IssueBooks.php?page=1">Issue Books</a></li>
        <li class="floatLeft"><a href="student.php?page=1">Students</a></li>
        <li class="floatLeft"><a href="adminProfile.php">Profile</a></li>
        <li class="floatLeft" id="button"><a href="index.php?logout=1">Logout</a></li>
    </ul>
</div>

<div class="page">
    <div id="pageTitle">Author</div>
    <div id="searchPlace">
        <form>
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
        <div class="floatLeft popupBtnn">
            <i class="fas fa-plus float-left plusIcon"></i>
            <p class="float-left addBtn">Add</p>
        </div>
        <i class="fas fa-chevron-left float-left leftrightIcon"></i>
        <?php
        for($page = 1; $page <= $numberOfPages; $page++){
            echo "<p class='numPage'><a href='author.php?page=".$page."'>".$page."</a></p>";
        }
        ?>
        <i class="fas fa-chevron-right float-left leftrightIcon"></i>
    </div>
    <div class="clear"></div>
    <div id="tbl" style="overflow-x:auto;">
        <table id="category">
            <tr>
                <th>#</th>
                <th>Author Name</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>
            <?php

                while($row = mysqli_fetch_array($result)){
                    echo "<td>".++$rows."</td>";
                    echo "<td>".$row['AuthorName']."</td>";
                    echo "<td>".$row['Reg Date']."</td>";
                    echo "<td><a href='author.php?page='".$_GET['page']." id='".$row['id']."' class='edit'>Edit</a></td>";
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

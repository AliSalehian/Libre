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
$query = "SELECT * FROM Book";
$result = mysqli_query($conn, $query);
$numberOfResults = mysqli_num_rows($result);

$numberOfPages = ceil($numberOfResults/$resultPerPage);

if(!isset($_GET['page'])) $page = 1;
else $page = $_GET['page'];
$this_page_first_result = ($page-1)*$resultPerPage;

$query = "SELECT * 
          FROM Book b 
          JOIN Author a 
            ON b.authorID = a.id  
          JOIN Category c 
            ON b.categoryID = c.id  
          LIMIT ".$this_page_first_result.','.$resultPerPage;
$result = mysqli_query($conn, $query);
$rows = $this_page_first_result;


$categoryQuery = "SELECT * FROM `Category`";
$categoryResult = mysqli_query($conn, $categoryQuery);
$categoryResultEdit = mysqli_query($conn, $categoryQuery);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Admin-Book</title>
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
        Add a Book
    </div>
    <div class="description">
        <form method="post" enctype="multipart/form-data">
            <p class="addName">Book Name</p>
            <input placeholder="Book Name" name="addBook" type="text" class="addFormTextArea">
            <p class="addName">Category Name</p>
            <select id="categoryOption" class="categoryOption" name="categoryOption">
                <option value="Select">Select</option>
                <?php
                    while ($row = mysqli_fetch_array($categoryResult)){
                        echo"hi";
                        echo "<option>".$row['CategoryName']."</option>";
                    }
                ?>
            </select>
            <p class="addName">Author</p>
            <input placeholder="Author Name" name="authorBook" type="text" class="addFormTextArea">
            <p class="addName">Price</p>
            <input placeholder="Price Name" name="priceBook" type="number" class="addFormTextArea">
            <p class="addName">ISBN</p>
            <input placeholder="Internation Standard Book Number" name="isbnBook" type="number" class="addFormTextArea">
            <p class="addName">Book Plot</p>
            <textarea name="Description" placeholder="Book Plot" class="addFormTextArea addBookText"></textarea>
            <p class="addName">Book Image</p>
            <input placeholder="Book image" name="bookImg" type="file" class="addFormTextArea">
            <p class="addName">Book PDF</p>
            <input placeholder="Book PDF" name="bookPDF" type="file" class="addFormTextArea">
            <input class="popUpSubmitBtn" type="submit" name="submitNewBook" value="Add">
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
        Edit Book
    </div>
    <div class="description">

        <form method="post">
            <p class="addName">ID (Not Editable)</p>
            <input id="authorIdPlaceHolder" name="BookId" class="addFormTextArea" readonly style="background-color: #e5e5e5">
            <p class="addName">Book Name</p>
            <input id="authorPlaceHolder" placeholder="Book Name" name="editBook" type="text" class="addFormTextArea">
            <p class="addName">Category Name</p>
            <select class="categoryOption" name="editCategoryOption">
                <option value="Select">Select</option>
                <?php
                while ($row = mysqli_fetch_array($categoryResultEdit)){
                    echo "<option>".$row['CategoryName']."</option>";
                }
                ?>
            </select>
            <p class="addName">Author</p>
            <input id="authorHolder" placeholder="Author Name" name="editAuthorName" type="text" class="addFormTextArea">
            <p class="addName">Price</p>
            <input id="priceHolder" placeholder="Price Name" name="editBookPrice" type="number" class="addFormTextArea">
            <p class="addName">ISBN</p>
            <input id="ISBNHolder"  placeholder="Price Name" name="editISBN" type="number" class="addFormTextArea">
            <input class="popUpSubmitBtn" type="submit" name="submitEditBook" value="Edit">
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
        <li class="floatLeft selected"><a href="book.php?page=1">Books</a></li>
        <li class="floatLeft"><a href="IssueBooks.php?page=1">Issue Books</a></li>
        <li class="floatLeft"><a href="student.php?page=1">Students</a></li>
        <li class="floatLeft"><a href="adminProfile.php">Profile</a></li>
        <li class="floatLeft" id="button"><a href="index.php?logout=1">Logout</a></li>
    </ul>
</div>

<div class="page">
    <div id="pageTitle">Book</div>
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
        <div class="floatLeft popupBtnn">
            <i class="fas fa-plus float-left plusIcon"></i>
            <p class="float-left addBtn">Add</p>
        </div>
        <i class="fas fa-chevron-left float-left leftrightIcon"></i>
        <?php
        for($page = 1; $page <= $numberOfPages; $page++){
            echo "<p class='numPage'><a href='book.php?page=".$page."'>".$page."</a></p>";
        }
        ?>
        <i class="fas fa-chevron-right float-left leftrightIcon"></i>
    </div>
    <div class="clear"></div>
    <div id="tbl" style="overflow-x:auto;">
        <table id="category">
            <tr>
                <th>#</th>
                <th>Book Name</th>
                <th>Author</th>
                <th>Category</th>
                <th>Price</th>
                <th>ISBN</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
            <?php

                while($row = mysqli_fetch_array($result)){
                    echo "<td>".++$rows."</td>";
                    echo "<td>".$row['BookName']."</td>";
                    echo "<td>".$row['AuthorName']."</td>";
                    echo "<td>".$row['CategoryName']."</td>";
                    echo "<td>".$row['BookPrice']."</td>";
                    echo "<td>".$row['BookISBN']."</td>";
                    echo "<td>".$row['Reg Date']."</td>";
                    echo "<td><a id='".$row['bookID']."' class='edit BookPage'>Edit</a><a id='".$row['bookID']."' class='removeBook'>Remove</a></td>";
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

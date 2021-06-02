<?php

include ("connection.php");
if(isset($_POST['submitEditAuthor'])){
    print_r($_POST['editAuthor']);
    print_r($_POST['AuthorId']);
    if(!$_POST['editAuthor']){
        echo "The author name field is empty";
    }else{
        $query = "UPDATE Author SET AuthorName = '".$_POST['editAuthor']."' WHERE id = '".$_POST['AuthorId']."' LIMIT 1";
        mysqli_query($conn, $query);
    }

}

if(isset($_POST['submitEditCategory'])){

    if(!$_POST['editCategory']){
        echo "The Category name field is empty";
    }else{
        $query = "UPDATE Category SET CategoryName = '".$_POST['editCategory']."' WHERE id = '".$_POST['CategoryId']."' LIMIT 1";
        mysqli_query($conn, $query);

        //header("Location: category.php?page=1");
    }

}
$editBookError = "";
if(isset($_POST['submitEditBook'])) {
    if (!$_POST['editBook']) {
        $editBookError = "Please enter a Book name<br>";
    }
    if (!$_POST['editCategoryOption'] and $_POST['categoryOption'] != "Select") {
        $editBookError .= "Please select a category for your book<br>";
    }
    if (!$_POST['editAuthorName']) {
        $editBookError .= "Please enter the book's author name<br>";
    }
    if (!$_POST['editBookPrice']) {
        $editBookError .= "Please enter the book's price<br>";
    }
    if (!$_POST['editISBN']) {
        $editBookError .= "Please enter the book's ISBN No.<br>";
    }

    if ($editBookError) echo "There are some errors, please review them and proceed again, " . $editBookError;
    else {
            $query = "SELECT * FROM `Author` WHERE `AuthorName` = '" . mysqli_real_escape_string($conn, $_POST['editAuthorName']) . "' LIMIT 1";
            $result = mysqli_query($conn, $query);
            $results = mysqli_num_rows($result);

            $query2 = "SELECT * FROM `Category` WHERE `CategoryName` = '" . mysqli_real_escape_string($conn, $_POST['editCategoryOption']) . "' LIMIT 1";
            $result2 = mysqli_query($conn, $query2);

            $fetchCategoryID = mysqli_fetch_array($result2);
            $fetchCategoryID = $fetchCategoryID['id'];
            $fetchAuthorID = mysqli_fetch_array($result);
            $fetchAuthorID = $fetchAuthorID['id'];

            if ($results) {

                $query = "UPDATE Book
                          SET BookName = '" .mysqli_real_escape_string($conn, $_POST['editBook']). "',
                          authorID = '" .$fetchAuthorID. "',
                          categoryID = '" .$fetchCategoryID. "',
                          BookPrice = '" .$_POST['editBookPrice']. "',
                          BookISBN = '" .$_POST['editISBN']."'
                          WHERE BookID = '".$_POST['BookId']."'";

                mysqli_query($conn, $query);
        }
    }
}


?>
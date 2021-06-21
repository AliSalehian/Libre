<?php

    //session_start();
    include ("connection.php");
    //include ("author.php");
    $addError = "";
    if(isset($_POST['submitNewAuthor'])){
        if(!$_POST['addAuthor']){
            $addError = "Please write an author name<br>";
            echo "it's not filled<br>";
        }else{
            echo 'It is filled, we are looking for duplicates';
            $query = "SELECT * FROM Author WHERE AuthorName = '".mysqli_real_escape_string($conn, $_POST['addAuthor'])."'";
            $result = mysqli_query($conn, $query);
            $results = mysqli_num_rows($result);
            echo $results;
            if($results) echo "We have found duplicates";
            else{
                $query = "INSERT INTO `Author` (`AuthorName`) VALUES ('".mysqli_real_escape_string($conn, $_POST['addAuthor'])."')";
                mysqli_query($conn, $query) or die('Error, insert query failed');
            }

        }
    }

    if(isset($_POST['submitNewCategory'])){
        if(!$_POST['addCategory']){
            $addError = "Please enter a category name<br>";
        }else{
            $query = "SELECT * FROM Category WHERE CategoryName = '".mysqli_real_escape_string($conn, $_POST['addCategory'])."'";
            $result = mysqli_query($conn, $query);
            $results = mysqli_num_rows($result);
            if($results) echo "We have found duplicates";
            else{
                $query = "INSERT INTO `Category` (`CategoryName`) VALUES ('".mysqli_real_escape_string($conn, $_POST['addCategory'])."')";
                mysqli_query($conn, $query) or die('Error, insert query failed');
            }

        }
    }

    $addBookError = "";
    if(isset($_POST['submitNewBook'])){

        if(!$_POST['addBook']){
            $addBookError = "Please enter a Book name<br>";
        }
        if(!$_POST['categoryOption'] AND $_POST['categoryOption'] != "Select" ){
            $addBookError .= "Please select a category for your book<br>";
        }
        if(!$_POST['authorBook']){
            $addBookError .= "Please enter the book's author name<br>";
        }
        if(!$_POST['priceBook']){
            $addBookError .= "Please enter the book's price<br>";
        }
        if(!$_POST['isbnBook']){
            $addBookError .= "Please enter the book's ISBN No.<br>";
        }
        if(!$_POST['Description']){
            $addBookError .= "Please enter the book's Plot<br>";
        }

        if($addBookError) echo "There are some errors" . $addBookError;
        else{
            $query = "SELECT * FROM `Book` 
                        WHERE `BookName` = '".mysqli_real_escape_string($conn, $_POST['addBook'])."' OR `BookISBN` = '".$_POST['isbnBook']."'";
            $result = mysqli_query($conn, $query);
            $results = mysqli_num_rows($result);

            if($results){
                echo "There is already a book with this details";
            }else{
                $query = "SELECT * FROM `Author` WHERE `AuthorName` = '".mysqli_real_escape_string($conn, $_POST['authorBook'])."' LIMIT 1";
                $result = mysqli_query($conn, $query);
                $results = mysqli_num_rows($result);

                $query2 = "SELECT * FROM `Category` WHERE `CategoryName` = '".mysqli_real_escape_string($conn, $_POST['categoryOption'])."' LIMIT 1";
                $result2 = mysqli_query($conn, $query2);

                $fetchCategoryID = mysqli_fetch_array($result2);
                $fetchCategoryID = $fetchCategoryID['id'];

                if($results){
                    $fetchAuthorID = mysqli_fetch_array($result);
                    $fetchAuthorID = $fetchAuthorID['id'];

                    $imgFile = addslashes(file_get_contents($_FILES['bookImg']['tmp_name']));
                    $pdfFile = addslashes(file_get_contents($_FILES['bookPDF']['tmp_name']));

                    $query = "INSERT INTO `Book` (`BookName`, `authorID`, `categoryID`, `BookPrice`, `BookISBN` ,`img`, `Description`, `summaryPDF`) 
                    VALUES(
                    '" . mysqli_real_escape_string($conn, $_POST['addBook']) . "',
                    '" . $fetchAuthorID . "', 
                    '" . $fetchCategoryID . "', 
                    '" . $_POST['priceBook'] . "',
                    '" . $_POST['isbnBook'] . "',
                    '" . $imgFile . "',
                    '" . $_POST['Description'] . "',
                    '" . $pdfFile. "')";
                    mysqli_query($conn, $query) or die('Error, insert query failed');

                }else{


                    $query = "INSERT INTO `Author` (`AuthorName`) VALUES ('".mysqli_real_escape_string($conn, $_POST['authorBook'])."')";
                    mysqli_query($conn, $query) or die('Error, insert query failed');

                    $newID = mysqli_insert_id($conn);
                    $query = "INSERT INTO `Book` (`BookName`, `authorID`, `categoryID`, `BookPrice`, `BookISBN`) 
                                VALUES(
                                '".mysqli_real_escape_string($conn, $_POST['addBook'])."',
                                '".$newID."', 
                                '".$fetchCategoryID."', 
                                '".$_POST['priceBook']."',
                                '".$_POST['isbnBook']."')";
                    mysqli_query($conn, $query) or die('Error, insert query failed');
                }
            }
        }
    }

    $submitEmailError = "";
    if(isset($_POST['submitEmail'])){
        if(!$_POST['emailText']){
            $submitEmailError = "Please enter the Email text<br>";
            echo "he";
        }
        if($submitEmailError) echo "There are some errors" . $submitEmailError;
        else{
            $query = "SELECT * FROM Student WHERE FullName = '".$_POST['userEmail']."'";
            $result = mysqli_query($conn,$query);
            $result = mysqli_fetch_array($result);
            if(mail($result['Email'],"Email from Liber",$_POST['emailText'])){
                //echo "Email Sent";
            }else{
                echo "Email failed";
            }

        }


    }
?>
<?php
session_start();
include ("connection.php");
include("NotLoggedIn.php");
include ("AdminCheck.php");
include ("updateProfile.php");


$id = $_SESSION['id'];
$query = "SELECT * FROM Student WHERE id = '".$id."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Admin Profile</title>

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

<div class="blackBackPop"></div>
<div class="popup center">
    <i class="fas fa-times exitIcon"></i>
    <div class="icon">
        <i class="fa fa-camera"></i>
    </div>
    <div class="title">
        Add a profile photo
    </div>
    <div class="description">
        <form method="post" enctype="multipart/form-data">
            <p class="addName">Choose File</p>
            <input placeholder="File" name="updateProfilePhoto" type="file" class="addFormTextArea">
            <input class="popUpSubmitBtn" type="submit" name="submitPhoto" value="Update">
        </form>
    </div>
</div>
<!--<p>--><?php //echo $errorU ?><!--</p>-->
<div id="Menu">
    <p id="name">LIBRE</p>
    <ul>
        <li class="floatLeft"><a href="dashboard.php">Dashboard</a></li>
        <li class="floatLeft"><a href="studentDashboard.php?page=1">Book List</a></li>
        <li class="floatLeft"><a href="category.php?page=1">Categories</a></li>
        <li class="floatLeft"><a href="author.php?page=1">Authors</a></li>
        <li class="floatLeft"><a href="book.php?page=1">Books</a></li>
        <li class="floatLeft"><a href="IssueBooks.php?page=1">Issue Books</a></li>
        <li class="floatLeft"><a href="student.php?page=1">Students</a></li>
        <li class="floatLeft selected"><a href="adminProfile.php">Profile</a></li>
        <li class="floatLeft" id="button"><a href="index.php?logout=1">Logout</a></li>
    </ul>
</div>

<div class="page">

    <div id="pageTitle">Profile</div>
    <div id="searchPlace">
        <form method="post" action="result.php">
            <div id="searchIcon"></div>
            <input id="search" type="text" name="search" placeholder="Search books, authors">
        </form>
    </div>
    <div class="clear"></div>
    <form method="post">
        <div class="leftProfile firstLeftProfile">
            <div class="test">
                <div class="updateImg"><img src="img/photo.png"></div>
                <?php
                if(is_null($row['profileImg'])) {
                    echo '<img class="profileImgNo" src="img/user.png"/>';
                }
                else {
                    echo '<img class="profileImg" src="data:image/jpeg;base64,' . base64_encode($row['profileImg']) . '"/>';
                }
                ?>
            </div>
            <div class="clear"></div>
            <p class="profileInputTitle">Name</p>
            <input name="studentNameProfile" class="inputProfile" value="<?php echo $row['FullName'] ?>">
            <p class="Error"><?php echo $errorName ?></p>

            <p class="profileInputTitle">Roll</p>
            <input name="studentIDProfile" class="inputProfile" value="Admin" readonly>
        </div>

        <div class="leftProfile">
            <p class="profileInputTitle">Email</p>
            <input type="email" name="studentEmailProfile" class="inputProfile" value="<?php echo $row['Email'] ?>">
            <p class="Error"><?php echo $errorEmail ?></p>

            <p class="profileInputTitle">Phone Number</p>
            <input name="studentPhoneProfile" class="inputProfile" value="<?php echo $row['MobileNumber'] ?>">
            <p class="Error"><?php echo  $errorPhone ?></p>

            <div class="gap"></div>
            <p class="profileInputTitle">Current Password</p>
            <input type="password" name="studentCurrentProfile" class="inputProfile">
            <p class="Error"><?php echo  $errorCurrent ?></p>

            <p class="profileInputTitle">New Password</p>
            <input type="password" name="studentNewPassProfile" class="inputProfile">
            <p class="Error"></p>
        </div>

        <div class="leftProfile">
            <div class="gap"></div>
            <div class="gap"></div>
            <div class="gap"></div>
            <div class="gap"></div>
            <div class="gap"></div>
            <div class="gap"></div>
            <div class="gap"></div>
            <div class="gap"></div>
            <input type="submit" name="studentProfile" class="submitProfile" value="Submit Changes">
    </form>
</div>
</div>
<!--<div id="bottom">
    <p id="footer">&#169; 2021 Libre Online Library Management Panel</p>
</div>-->

</body>

</html>

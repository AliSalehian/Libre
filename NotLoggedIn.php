<?php
    if(!isset($_SESSION['id'])) {
        // not logged in
        $errorNoLogin =  "Please login";
        header('Location: index.php');
        exit();
    }

?>
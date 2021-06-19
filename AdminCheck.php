<?php

if($_SESSION['id'] != 19){

    header('Location: errorpage.php');
    exit();
}

?>
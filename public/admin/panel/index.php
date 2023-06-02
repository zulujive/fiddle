<?php
sesssion_start();

if ($_SESSION["logged_in"] == true) {
    echo 'Congrats, you logged in!';
} else {
    header("Location: /admin/");
    exit();
}

?>
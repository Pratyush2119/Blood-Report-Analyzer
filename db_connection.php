<?php
    $connect=new mysqli("localhost","root","","database-name");
    if(!$connect)
    {
        die('Could not connect: '.mysql_error());
    }
?>
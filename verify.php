<?php
include("db_connection.php");
if(isset($_GET['email'])){
    $email=$_GET['email'];
    $sql="UPDATE users SET verification=1 where email='$email'";
    if($connect->query($sql)) {
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <title>Successful Verification</title>
        <style>
            body {
                background-color: azure;
                font-size: 30px;
                font-family:'Lato','Arial',sans-serif;
                font-weight:300;
            }
            p {
                margin-top: 300px;
            }
        </style>
    </head>
    <body>
        <p><center>Your Account has been verified. Now you can proceed to login.</center></p>
    </body>
</html>
<?php
    }
    else
    {
        echo "Error!!";
    }
}
?>

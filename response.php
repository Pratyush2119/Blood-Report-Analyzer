<?php
include("db_connection.php");
if(isset($_POST["submit"]))
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $findus=$_POST["find-us"];
    $cb=$_POST["news"];
    $message=$_POST["message"];
    $sql="INSERT INTO `review` (name,email,findus,newsletter,message) VALUES ('$name','$email','$findus','$cb','$message')";
    $connect->query($sql);
}
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Response Submitted!</title>
        <link rel="icon" href="Resources/img/medical-report.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Resources/css/style.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
        <link rel="stylesheet" type="text/css" href="Resources/css/queries.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <style>
            .response{
                text-align: center;
                width:700px;
                margin-top: 100px;
                margin-left: auto;
                margin-right: auto;
                background-color:#e1fcf0;
                font-size: 50px;
            }
            .response i{
                color: green;
                font-size: 50px;
            }
            .goback{
                margin: -85px auto 24px auto;
                width:500px;    
            }
        </style>
    </head>
    <body>
        <section class="response">
            <div class="row">
                <div class="col span-1-of-1" style="margin-left:32px;">
                    <i class="ion-ios-checkmark"></i>
                    <br>
                    Thank you for your Response!
                </div>
            </div>
        </section>
        <section class="goback">
            <div class="row">
                <div class="col span-2-of-2">
                    <center>
                        <br>
                        <a href="index.html">Go to Home</a>
                    </center>
                </div>
            </div>
        </section>
        <footer style="margin-top:65px;">
            <div class="row">
                <div class="col span-1-of-2">
                    <ul class="footer-nav">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">iOS App</a></li>
                        <li><a href="#">Android App</a></li>
                    </ul>
                </div>
                <div class="col span-1-of-2">
                    <ul class="social-links">
                        <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                        <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <p>
                    Copyright &copy; 2015 by Omnifood. All rights reserved.
                </p>
            </div>
        </footer>
    </body>
</html>
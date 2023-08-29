<?php
include("db_connection.php");
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="icon" href="Resources/img/medical-report.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Resources/css/style.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
        <link rel="stylesheet" type="text/css" href="Resources/css/queries.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <style>
            body{
                background-image:linear-gradient(rgba(0, 0, 0, 0.1),rgba(0, 0, 0, 0.1)),url(Resources/img/wp2469685-medical-doctor-wallpaper-hd2.jpg);
                background-size: cover;
                background-position: center;
                color:white;
                height:100vh;
                font-family:'Lato','Arial',sans-serif;
                font-weight:300;
            }
            table{
                background:rgba(0,0,0,0.5);
            }
        </style>
    </head>
    <body>
        <section class="login-form">
            <table border="1px solid black" width="50%" style="margin:100px auto auto auto" align="center" >
                <tr>
                    <td>
                        <div class="row">
                            <h2>Login to Continue...</h2>
                        </div>
                        <div class="row">
                            <form method="post" action="" class="contact-form" autocomplete="off">
                                <div class="row">
                                    <div class="col span-1-of-3">
                                        <label for="uname">Username :</label>
                                    </div>
                                    <div class="col span-2-of-3">
                                        <input type="text" name="uname" id="uname" placeholder="Enter username" required> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col span-1-of-3">
                                        <label for="pass">Password :</label>
                                    </div>
                                    <div class="col span-2-of-3">
                                        <input type="password" name="pass" id="pass" placeholder="Enter password" required> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col span-1-of-2">
                                        <center><a href="enteremail.php?type=username" class="fgtpass">Forgot Username!</a></center>
                                    </div>
                                    <div class="col span-1-of-2" style="text-align:right;">
                                        <center><a href="enteremail.php?type=password" class="fgtpass">Forgot Password!</a></center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col span-1-of-3">
                                        <label>&nbsp;</label>
                                    </div>
                                    <div class="col span-2-of-3">
                                        <input type="submit" name="submit" value="Login">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </section>
    </body>
</html>

<?php
if(isset($_POST['submit']))
{
    $user=$_POST["uname"];
    $pass=$_POST["pass"];
    $sql="SELECT verification,password FROM `users` WHERE username='$user' or email='$user'";
    $result = $connect -> query($sql);
    $row=$result -> fetch_assoc();
    $count=mysqli_num_rows($result);
    if($count==1)
    {
        if($pass==$row['password'])
        {
            if($row['verification']==1)
            {
                date_default_timezone_set("Asia/Calcutta");
                $date=date("d-m-y,h:i:sa");
                $sql1="UPDATE users SET last_login='$date' where username='$user' or email='$user'";
                $connect -> query($sql1);
                $_SESSION['username']=$user;
                header('location:Home.php');
            }
            else
            {
                header('location:reqverify.php?type=login');
            }
        }
        else
        {
            echo "<script>alert('Invalid Password!');</script>";
        }
    }
    else
    {
        echo "<script>alert('No Such Existing User!');</script>";
    }
}
?>

<?php
include("db_connection.php");
$email='';
if(isset($_POST['submit']))
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $uname=$_POST["uname"];
    $pass=$_POST["pass"];
    $gend=$_POST["gender"];
    $dob=$_POST["dob"];
    $phone=$_POST["phone"];
    $sql="INSERT INTO users (name,email,username,password,gender,dob,phone,verification) VALUES ('$name','$email','$uname','$pass','$gend','$dob','$phone',0)";
    $connect->query($sql);
}  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                      
    $mail->SMTPAuth   = true;                                    
    $mail->Username   = 'sender email address';                     
    $mail->Password   = 'generated app password';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;;        
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('sender email address', 'HealthStack');
    $mail->addAddress($email);                   
    
    $body="<div style='background-color:#d9d7d7;height:700px;font-size:22px;padding:20px;'>
            <div class='white-content' style='width:500px;background-color:white;display:block;position:absolute;margin-top:100px;margin-left:280px;padding:20px;'>
                <center>
                    <b>Confirm Your Analyzer Account</b>
                    <br><br>
                    Thanks for signing up for an account on Analyzer! To Start using, please confirm your email address below so we know you're you...<br><br>
                    <span style='color:red;'>CONFIRM EMAIL ADDRESS</span>
                    <br><br><a href='http://localhost/Brackets/analyzer/verify.php?email=$email'>Verify</a>
                    <br><br>
                    If you did not sign up for an account on Analyzer and believe someone registered this email by mistake, please contact us so we resolve this issue.
                </center>
            </div>
        </div> ";
    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Please Confirm Your Account';
    $mail->Body    = $body;
    //$mail->AltBody = strip_tags($body);

    $mail->send();
    //echo 'Message has been sent';
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Registered Successfully!</title>
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
                width:1000px;
                margin-top: 100px;
                margin-left: auto;
                margin-right: auto;
                background-color:#e1fcf0;
                font-size: 20px;
            }
            .response p{
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
                <div class="col span-2-of-2">
                    <i class="ion-ios-checkmark"></i>
                    <br>
                    <center>
                        <p>Registration Done!</p>
                        <br><br>
                        An email has been sent to your registered Email Id. Verify your Email Id to do successful login.
                    </center>
                </div>
            </div>
        </section>
        <section class="goback">
            <div class="row">
                <div class="col span-2-of-2">
                    <center>
                        <a href="index.html">Go to Home</a>
                    </center>
                </div>
            </div>
        </section>
        <footer>
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
<?php
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

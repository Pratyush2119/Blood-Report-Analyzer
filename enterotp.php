<?php
$email=$_POST['email'];
$type=$_GET['type'];
$otp=rand(100000,999999);
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
    
        $body="<p>Your verification code - $otp.</p>";
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Verification...';
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    } 
?>
<?php
if($_GET['type']=='username')
    
{
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <style>
        body {
                margin: 0;
                padding: 0;
                background-color: azure;
                font-family:'Lato','Arial',sans-serif;
                font-weight:300;
            }
            .box {
                background-color: white;
                border-radius: 5px;
                padding:20px;
                width:600px;
                height: 260px;
                margin-top: 200px;
                margin-left: 450px;
                box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.26);
            }
            p {
                font-size: 28px;
            }
            input[type=tel] {
                width:400px;
                margin-bottom: 25px;
                height: 40px;
                padding:5px;
                font-size: 18px;
                border:1px solid #cdcdcd;
            }
            input[type=submit] {
                width: 100px;
                height: 35px;
                font-weight: 600;
                background-color: #03ff42;
                border:1px solid black;
                border-radius: 2px;
                font-size: 18px;
                box-shadow: 1px 2px 2px 1px rgba(0,0,0,0.26);
            }
            input[type=submit]:hover {
                cursor: pointer;
                background-color: #40e37e;
            }
        </style>
        
    </head>
    <body>
        <div class="box">
            <center>
                <p>A verification code has been sent to your registered email id. Please enter it to confirm yourself as a user.</p>
                <input type="tel" name="otp" id="otp" autocomplete="off" placeholder="Enter the code">
                <input type="tel" name="check" id="check" value="<?php echo $otp;?>" hidden>
                <form action="setpass.php?type=<?php echo $type;?>" method="post" onsubmit="return check();">
                    <input type="email" name="email" value="<?php echo $email;?>" hidden>
                    <input type="submit" name="send" value="Next">
                </form>
            </center>
        </div>
        <script type="text/javascript">
            function check() {
                var val1=document.getElementById('otp').value;
                var val2=document.getElementById('check').value;
                if(val1!==val2)
                    {
                        alert('Invalid OTP!');
                        window.location.href="enteremail.php?type=<?php echo $type;?>";
                        return false;
                    }
            }
        </script>
    </body>
</html>
<?php
}
if($_GET['type']=='password')
{
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <style>
        body {
                margin: 0;
                padding: 0;
                background-color: azure;
                font-family:'Lato','Arial',sans-serif;
                font-weight:300;
            }
            .box {
                background-color: white;
                border-radius: 5px;
                padding:20px;
                width:600px;
                height: 260px;
                margin-top: 200px;
                margin-left: 450px;
                box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.26);
            }
            p {
                font-size: 28px;
            }
            input[type=tel] {
                width:400px;
                margin-bottom: 25px;
                height: 40px;
                padding:5px;
                font-size: 18px;
                border:1px solid #cdcdcd;
            }
            input[type=submit] {
                width: 100px;
                height: 35px;
                font-weight: 600;
                background-color: #03ff42;
                border:1px solid black;
                border-radius: 2px;
                font-size: 18px;
                box-shadow: 1px 2px 2px 1px rgba(0,0,0,0.26);
            }
            input[type=submit]:hover {
                cursor: pointer;
                background-color: #40e37e;
            }
        </style>
        
    </head>
    <body>
        <div class="box">
            <center>
                <p>A verification code has been sent to your registered email id. Please enter it to change your password.</p>
                <input type="tel" name="otp" id="otp" autocomplete="off" placeholder="Enter the code">
                <input type="tel" name="check" id="check" value="<?php echo $otp;?>" hidden>
                <form action="setpass.php?type=<?php echo $type;?>" method="post" onsubmit="return check();">
                    <input type="email" name="email" value="<?php echo $email;?>" hidden>
                    <input type="submit" name="send" value="Next">
                </form>
            </center>
        </div>
        <script type="text/javascript">
            function check() {
                var val1=document.getElementById('otp').value;
                var val2=document.getElementById('check').value;
                if(val1!==val2)
                    {
                        alert('Invalid OTP!');
                        window.location.href="enteremail.php?type=<?php echo $type;?>";
                        return false;
                    }
            }
        </script>
    </body>
</html>
<?php
}
?>
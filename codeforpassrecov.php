<?php
include("db_connection.php");
    session_start();
    $userprofile = $_SESSION['username'];
    if($userprofile==true)
    {
        
    }
    else
    {
        header('location:login.php');
    }
    $sql="SELECT name,password,email FROM `users` WHERE username='$userprofile'";
    $result = $connect -> query($sql);
    $row=$result -> fetch_assoc();
    $email=$_POST['emailid'];
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
    
        $body="<p>Your verification code is - $otp.</p>";
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Verification Code';
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Password Recovery</title>
        <link rel="icon" href="Resources/img/medical-report.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <style>
        body {
            margin: 0;
            padding: 0;
            background-color: azure;
            font-family:'Lato','Arial',sans-serif;
            font-weight:400;
            text-rendering:optimizeLegibility;
            letter-spacing: 1px;
        }
        .main-nav {
            width:100%;
            height:48px;
            background-color: #87f0fa;
            font-size:18px;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.26);
        }
        .tab:hover {
            background-color: #35fca3;
            cursor: pointer;
            color:blue;
        }
        .active {
            background-color: #35fca3;
            color:blue;
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
            font-weight:300;
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
        <div class="main-nav">
            <table style="height:48px;width:80%;margin-left:150px">
                <tr>
                    <td align="center" width="5%"><img src="Resources/img/medical-report.png" style="height:35px;width:35px;margin-top:5px"></td>
                    <td width="40%">&nbsp;Welcome, <?php echo $row['name'];?></td>
                    <td align="center" class="tab" onclick="location.href='Home.php'"><i class="ion-ios-home"></i> Home</td>
                    <td align="center" class="tab active" onclick="location.href='account.php'"><i class="ion-android-person"></i> Account</td>
                    <td align="center" class="tab" onclick="location.href='repohistory.php'"><i class="ion-clipboard"></i> History</td>
                    <td align="center" class="tab" onclick="location.href='graph.php'"><i class="ion-arrow-graph-up-right"></i> Trend</td>
                    <td align="center" class="tab" onclick="location.href='logout.php'">Logout</td>
                </tr>
            </table>
        </div>
        <div class="box">
            <center>
                <p>A verification code has been sent to your registered email id. Please enter it to confirm yourself as a user.</p>
                <input type="tel" name="otp" id="otp" autocomplete="off" placeholder="Enter the code">
                <input type="tel" name="check" id="check" value="<?php echo $otp;?>" hidden>
                <form action="sendpass.php" method="post" onsubmit="return check();">
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
                        return false;
                    }
            }
        </script>
    </body>
</html>
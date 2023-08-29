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
    $sql="SELECT password,email FROM `users` WHERE username='$userprofile'";
    $result = $connect -> query($sql);
    $row=$result -> fetch_assoc();
    $email=$row['email'];
    $pass=$row['password'];
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
    
        $body="<p>Your password for the account registered with email id - $email is $pass.</p>";
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Recover Password';
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
        header('location:reqverify.php?type=recover');
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
?>
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
    if(isset($_POST['submit'])) {
        $name=$_POST["name"];
        $email=$_POST["email"];
        $gend=$_POST["gender"];
        $dob=$_POST["dob"];
        $phone=$_POST["phone"];
        $sql="UPDATE users SET name='$name',email='$email',gender='$gend',dob='$dob',phone='$phone' where username='$userprofile'";
        if($connect->query($sql))
        {
            $_SESSION['username']=$uname;
            header('location:account.php');  
        }
        else
        {
            echo "Error in Connecting to Database";
        }
    }
    if(isset($_POST['add'])) {
        $question=$_POST["question"];
        $answer=$_POST["answer"];
        $sql="UPDATE users SET question='$question',answer='$answer' where username='$userprofile'";
        if($connect->query($sql))
        {
            $_SESSION['username']=$userprofile;
            header('location:account.php');
        }
        else
        {
            echo "Error in Connecting Database";
        }
    }
    if(isset($_POST['setpass'])) {
        $newpass=$_POST['newpass'];
        $sql="UPDATE users SET password='$newpass' where username='$userprofile'";
        if($connect->query($sql))
        {
            $_SESSION['username']=$userprofile;
            header('location:account.php');
        }
        else
        {
            echo "Error in Connecting Database";
        }
    }
?>
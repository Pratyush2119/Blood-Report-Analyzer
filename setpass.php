<?php
include('db_connection.php');
$type=$_GET['type'];
if(isset($_POST['save']))
{
    $newpass=$_POST["newpass"];
    $conpass=$_POST["conpass"];
    $email=$_POST["email"];
    $sql="UPDATE users SET password='$newpass' where email='$email'";
    if($connect->query($sql))
    {
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
        <link rel="stylesheet" type="text/css" href="Resources/css/queries.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <title>Password Changed</title>
        <link rel="icon" href="Resources/img/medical-report.png" type="image/x-icon">
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family:'Lato','Arial',sans-serif;
                font-weight:300;
            }
            .response{
                text-align: center;
                width:600px;
                margin-top: 180px;
                margin-left: auto;
                margin-right: auto;
                background-color:#e1fcf0;
                font-size: 20px;
                padding: 20px;
            }
            .response p.main-text{
                font-size: 50px;
            }
            .response i{
                color: green;
                font-size: 50px;
            }
            a {
                text-decoration: none;
                color: #e67e22;
            }
            a:hover {
                cursor: pointer;
                border-bottom: 1px solid #e67e22;
                transition:border-bottom 0.2s,color 0.2s;
            }
        </style>
    </head>
    <body>
        <section class="response">
            <div class="row">
                <div class="col span-2-of-2">
                    <i class="ion-ios-checkmark"></i>
                    <center>
                        <p class="main-text">Completed Updating!</p>
                        <p class="sub-text">Password Set Successfully.</p>
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="col span-2-of-2">
                    <center>
                        <a href="login.php"><b>Proceed to Login</b></a>
                    </center>
                </div>
            </div>
        </section>
    </body>
</html>

<?php
    }
    else
    {
        echo "Error in Connecting to Database";
    }
}
elseif ($type=='username')
{
    $email=$_POST['email'];
    $sql="SELECT username FROM users WHERE email='$email'";
    if($connect->query($sql))
    {
        $result = $connect -> query($sql);
        $row=$result -> fetch_assoc();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <title>View Username</title>
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
                padding:18px;
                width:600px;
                height: 180px;
                margin-top: 250px;
                margin-left: 450px;
                box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.26);
            }
            p {
                font-size: 28px;
            }
            a {
                font-size: 20px;
                text-decoration: none;
                color: #e67e22;
                font-weight: 400;
            }
            a:hover {
                border-bottom: 1px solid #e67e22;
            }
        </style>
    </head>
    <body>
        <div class="box">
            <center>
                <p>User Verification Successful!</p>
                <p>Your Registered username is - <b><?php echo $row['username']; ?></b></p>
                <a href="login.php">Go to Login</a>
            </center>
        </div>
    </body>
</html>
<?php
}
    else
    {
        echo "Error in Database linking...";
    }
}
else
{
    $email=$_POST['email'];
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <title>Set Password</title>
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
                padding:18px;
                width:600px;
                height: 300px;
                margin-top: 190px;
                margin-left: 450px;
                box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.26);
            }
            p {
                font-size: 28px;
            }
            input[type=password],input[type=text] {
                width:350px;
                height: 30px;
                padding:5px;
                font-size: 18px;
                border:1px solid #cdcdcd;
                float:left;
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
            button {
                margin-left: -30px;
                height: 42px;
                font-size: 16px;
            }
            button:hover {
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <div class="box">
            <center>
                <p>Enter the new Password...</p>
                <form action="" method="POST">
                    <table cellpadding="10px" class="entry">
                        <tr style="display:none">
                            <td colspan="2">
                                <input type="text" name="email" value="<?php echo $email; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:50%"><label for="newpass">New Password: </label></td>
                            <td>
                                <input type="password" name="newpass" id="newpass">
                                <button type="button" id="btn1" onclick="view(1)"><i class="ion-eye"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="conpass">Confirm Password:</label></td>
                            <td>
                                <input type="password" name="conpass" id="conpass" onkeyup="match();">
                                <button type="button" id="btn2" onclick="view(2)"><i class="ion-eye"></i></button>
                            </td>   
                        </tr>
                    </table>
                    <span id="info"></span>
                    <br><br>
                    <input type="submit" name="save" value="Save">
                </form>
            </center>
        </div>
        <script type="text/javascript">
            function match() {
                if(document.getElementById('newpass').value==document.getElementById('conpass').value)
                    {
                        document.getElementById('info').innerHTML="Password match.";
                        document.getElementById('info').style.color="green";
                    }
                else
                    {
                        document.getElementById('info').innerHTML="Password donot match.";
                        document.getElementById('info').style.color="red";
                    }
            }
            var x=0;
            var y=0;
            function view(n){
                if(n==1)
                    {
                        if(x==0)
                            {
                                var val=document.getElementById('newpass').value;
                                document.getElementById('newpass').type="text";
                                document.getElementById('newpass').value=val;
                                document.getElementById('btn1').innerHTML="<i class='ion-eye-disabled'></i>"
                                x=1;
                            }
                        else
                            {
                                var val=document.getElementById('newpass').value;
                                document.getElementById('newpass').type="password";
                                document.getElementById('newpass').value=val;
                                document.getElementById('btn1').innerHTML="<i class='ion-eye'></i>"
                                x=0;
                            }
                    }
                else
                    {
                        if(y==0)
                            {
                                var val=document.getElementById('conpass').value;
                                document.getElementById('conpass').type="text";
                                document.getElementById('conpass').value=val;
                                document.getElementById('btn2').innerHTML="<i class='ion-eye-disabled'></i>"
                                y=1;
                            }
                        else
                            {
                                var val=document.getElementById('conpass').value;
                                document.getElementById('conpass').type="password";
                                document.getElementById('conpass').value=val;
                                document.getElementById('btn2').innerHTML="<i class='ion-eye'></i>"
                                y=0;
                            }
                    }
            }
        </script>
    </body>
</html>
<?php
}
?>

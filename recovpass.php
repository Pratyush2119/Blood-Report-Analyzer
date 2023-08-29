<?php
    $type=$_GET['type'];
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
    $sql="SELECT name,question,answer FROM `users` WHERE username='$userprofile'";
    $result = $connect -> query($sql);
    $row=$result -> fetch_assoc();
    $count=0;
    if(isset($_POST['check'])) {
    $answer=$_POST['answer'];
    if($answer==$row['answer']) {
        header('location:sendpass.php');
    }
    else {
        $count=1;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Recover Password</title>
        <link rel="icon" href="Resources/img/medical-report.png" type="image/x-icon">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
                transition:0.2s;
            }
            .active {
                background-color: #35fca3;
                color:blue;
            }
            .box1,.box2 {
                background-color: white;
                border-radius: 5px;
                padding:20px;
                width:600px;
                height: 250px;
                margin-top: 180px;
                margin-left: 450px;
                box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.26);
                font-weight: 300;
            }
            .box2 {
                width:500px;
                height: 170px;
                margin-left: 500px;
                margin-top: 200px;
            }
            p {
                font-size: 28px;
                margin-bottom: 8px;
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
            input[type=text] {
                width:75%;
                height: 25px;
                font-family:'Lato','Arial',sans-serif;
                letter-spacing: 1px;
            }
            span {
                color:red;
                
            }
        </style>
    </head>
    <body>
        <div class="main-nav">
            <table style="height:48px;width:80%;margin-left:150px">
                <tr>
                    <td align="center" width="5%"><img src="Resources/img/health-check.png" style="height:35px;width:35px;margin-top:5px"></td>
                    <td width="40%">&nbsp;Welcome, <?php echo $row['name'];?></td>
                    <td align="center" class="tab" onclick="location.href='Home.php'"><i class="ion-ios-home"></i> Home</td>
                    <td align="center" class="tab active" onclick="location.href='account.php'"><i class="ion-android-person"></i> Account</td>
                    <td align="center" class="tab" onclick="location.href='repohistory.php'"><i class="ion-clipboard"></i> History</td>
                    <td align="center" class="tab" onclick="location.href='graph.php'"><i class="ion-arrow-graph-up-right"></i> Trend</td>
                    <td align="center" class="tab" onclick="location.href='logout.php'">Logout</td>
                </tr>
            </table>
        </div>
        
<?php
if($type=="secques")
{
?>
        <div class="box1">
            <center>
                <p>Answer the Security question set by you to recover your password.</p>
                <?php
                if($count==1) {
                    echo "<span>Wrong Answer!</span>";
                }?>
                <form action="" method="post">
                    <table width="100%" cellpadding="7px" style="font-size:20px;">
                        <tr>
                            <td width="25%">
                                <label for="question">Question: </label>
                            </td>
                            <td>
                                <?php echo $row['question'];?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="answer">Answer :</label>
                            </td>
                            <td>
                                <input type="text" name="answer">
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="2">
                                <input type="submit" name="check">
                            </td>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
<?php
}
if($type=="email")
{
?>
        <div class="box2">
            <center>
                <p>Enter your registered email id.</p>
                <form action="codeforpassrecov.php" method="post">
                    <table width="100%" cellpadding="7px" style="font-size:20px;">
                        <tr>
                            <td width="25%">
                                <label for="emailid">Email Id :</label>
                            </td>
                            <td>
                                <input type="text" name="emailid">
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="2">
                                <input type="submit" name="verify">
                            </td>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
<?php
}
?>      
    </body>
</html>

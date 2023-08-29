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
    $sql="SELECT * FROM `users` WHERE username='$userprofile'";
    $result = $connect -> query($sql);
    $row=$result -> fetch_assoc();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Choose Method...</title>
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
            .box {
                background-color: white;
                border-radius: 5px;
                padding:20px;
                width:600px;
                height: 240px;
                margin-top: 180px;
                margin-left: 450px;
                box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.26);
                font-weight: 300;
            }
            p {
                font-size: 28px;
            }
            button {
                width:100%;
                height:50px;
                font-size: 18px;
                background-color: transparent;
                border:none;
                outline: none;
                font-weight: 300;
            }
            button:hover {
                cursor: pointer;
                background-color: #d9d9d9;
                transition:background-color 0.1s;
            }
            h3 {
                width: 100%; 
                text-align: center; 
                border-bottom: 1px solid #d1d1d1; 
                line-height: 0.1em;
                margin: 20px 0px 20px; 
                font-weight: 300;
            } 
            h3 span { 
                background:#fff; 
                padding:0 10px; 
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
                <p>Choose a method to verify yourself.</p>
                <button style="border-top:1px solid #d1d1d1" onclick="emailmethod()">
                    Send Verification code to registered email.
                </button>
                <h3><span>OR</span></h3>
                <button style="border-bottom:1px solid #d1d1d1" onclick="questionmethod()">
                    Verify using Security question.
                </button>
            </center>
        </div>
        <script type="text/javascript">
            function emailmethod() {
                window.location.href="recovpass.php?type=email";
            }
            function questionmethod() {
                window.location.href="recovpass.php?type=secques";
            }
        </script>
    </body>
</html>
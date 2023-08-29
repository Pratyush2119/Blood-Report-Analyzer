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
    if(isset($_POST['submit'])) {
        $list=$_POST['list'];
        $array=explode(";",$list);
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Analysing...</title>
        <link rel="icon" href="Resources/img/medical-report.png" type="image/x-icon">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <style>
        body {
            padding: 0;
            margin: 0;
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
        .info-form {
            width:800px;
            margin:40px auto auto auto;
            padding:20px;
            background-color:#e3facd;
            border:2px solid #faaf2d;
            border-radius: 2px;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.26);
        }
        input[type=text],input[type=date] {
            height:25px;
            font-size:18px;
            padding: 5px;
        }
        #txt {
            width:50%;
        }
        input[type=date],#pathtxt {
            width:90%;
        }
        input[type=submit] {
            height:35px;
            width:100px;
            font-size: 18px;
            margin-top: 15px;
        }
        tr.row td {
            border-bottom: 1px solid #b5b5b5;
        }
        h1 {
            font-weight: 300;
            text-transform: uppercase;
        }
    </style>
    <body>
        <div class="main-nav">
            <table style="height:48px;width:80%;margin-left:150px">
                <tr>
                    <td align="center" width="5%"><img src="Resources/img/medical-report.png" style="height:35px;width:35px;margin-top:5px"></td>
                    <td width="40%">&nbsp;Welcome, <?php echo $row['name'];?></td>
                    <td align="center" class="tab active" onclick="location.href='Home.php'"><i class="ion-ios-home"></i> Home</td>
                    <td align="center" class="tab" onclick="location.href='account.php'"><i class="ion-android-person"></i> Account</td>
                    <td align="center" class="tab" onclick="location.href='#'"><i class="ion-clipboard"></i> History</td>
                    <td align="center" class="tab" onclick="location.href='#'"><i class="ion-arrow-graph-up-right"></i> Trend</td>
                    <td align="center" class="tab" onclick="location.href='logout.php'">Logout</td>
                </tr>
            </table>
        </div>
        <center>
        <div class="info-form">
            <h1>Enter the details and test values.</h1>
            <form action="analyze.php" method="post">
                <table cellpadding="10px" width="100%" style="">
                    <tr class="row">
                        <td align="center">Pathology or Test Centre :</td>
                        <td><input type="text" id="pathtxt" name="centre"></td>
                    </tr>
                    <tr  class="row">
                        <td align="center">Date of Test :</td>
                        <td><input type="date" name="dot"></td>
                    </tr>
                    <?php
                    $l=sizeof($array)-1;
                    $i=0;
                    while($l>0) {
                        $sql1="SELECT unit FROM tests WHERE testname='$array[$i]'";
                        $result1 = $connect -> query($sql1);
                        $row1 =$result1 -> fetch_assoc();
                        echo "<tr class='row'>";
                        echo "<td align='center'>$array[$i] :</td>";
                        echo "<td><input type='text' id='txt' name='".strtolower(str_replace(' ',"",$array[$i]))."'> in ".$row1['unit']."</td>";
                        echo "</tr>";
                        $i++;
                        $l--;
                    }
                    ?>
                    <tr>
                        <td align="center" colspan="2">
                            <input type="submit" name="analysis" value="Analyze">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        </center>
    </body>
</html>

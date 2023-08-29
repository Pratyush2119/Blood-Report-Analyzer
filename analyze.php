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
<!DOCTYPE HTML>
<html>
    <head>
        <title>Analyzed Report</title>
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
        .report {
            border:1px solid black;
            width:80%;
            margin-top:30px;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.26);
            border-radius:4px;
        }
        .print-btn {
            margin:40px auto 50px auto;
            height: 30px;
            font-size: 16px;
        }
        .print-btn:hover {
            cursor: pointer;
        }
    </style>
    <body>
        <div class="main-nav">
            <table style="height:48px;width:80%;margin-left:150px">
                <tr>
                    <td align="center" width="5%"><img src="Resources/img/medical-report.png" style="height:35px;width:35px;margin-top:5px"></td>
                    <td width="40%">&nbsp;Welcome, <?php echo $row['name'];?></td>
                    <td align="center" class="tab" onclick="location.href='Home.php'"><i class="ion-ios-home"></i> Home</td>
                    <td align="center" class="tab" onclick="location.href='account.php'"><i class="ion-android-person"></i> Account</td>
                    <td align="center" class="tab" onclick="location.href='repohistory.php'"><i class="ion-clipboard"></i> History</td>
                    <td align="center" class="tab" onclick="location.href='graph.php'"><i class="ion-arrow-graph-up-right"></i> Trend</td>
                    <td align="center" class="tab" onclick="location.href='logout.php'">Logout</td>
                </tr>
            </table>
        </div>
        <center>
            <div class="report" id="report">
                <table cellpadding="10px" width="100%" style="border:1px solid black;border-collapse:collapse;">
                    <tr>
                        <td align="center" width="50%">Patient Name : </td>
                        <td align="center"><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <td align="center">Pathology or Test Centre : </td>
                        <td align="center"><?php echo $_POST['centre']; ?></td>
                    </tr>
                    <tr>
                        <td align="center">Date of Test : </td>
                        <td align="center"><?php echo $_POST['dot']; ?></td>
                    </tr>
                    <tr><td colspan="2"><hr noshade color="black"></td></tr>
                    <tr>
                        <td colspan="2" align="center">
                            <table width="90%" cellpadding="5px" style="border:1px solid black;border-collapse:collapse;">
                                <tr>
                                    <th width="20%">Name</th>
                                    <th width="15%">Calculated</th>
                                    <th width="15%">Normal Range</th>
                                    <th align="left">Remarks</th>
                                </tr>
                                <tr><td colspan="4"><hr noshade color="black" style="margin-top:0;margin-bottom:0;"></td></tr>
                                <?php
                                if(isset($_POST['analysis'])) {
                                    $date=$_POST['dot'];
                                    $path=$_POST['centre'];
                                    $sql3="INSERT INTO records (userid,pathlab,date) VALUES ('$userprofile','$path','$date')";
                                    $connect->query($sql3);
                                    $sql1="SELECT * FROM tests";
                                    $result1 = $connect -> query($sql1);
                                    while($row1=$result1 -> fetch_assoc()) {
                                        $name=strtolower(str_replace(' ',"",$row1['testname']));
                                        if(isset($_POST[$name])) {
                                            $val=$_POST[$name];
                                            echo "<tr>";
                                            echo "<td align='center'>".$row1['testname']."</td>";
                                            echo "<td align='center'>".$val."</td>";
                                            echo "<td align='center'>".$row1['minnorm']." - ".$row1['maxnorm']." ".$row1['unit']."</td>";
                                            if($val<$row1['minnorm']) {
                                                echo "<td>".$row1['low']."</td>";
                                                $remarks=$row1['low'];
                                            } elseif($val>$row1['maxnorm']) {
                                                echo "<td>".$row1['high']."</td>";
                                                $remarks=$row1['high'];
                                            } else {
                                                echo "<td>".$row1['norm']."</td>";
                                                $remarks=$row1['norm'];
                                            }
                                            $sql2="INSERT INTO `$name` (userid,value,remarks,date) VALUES ('$userprofile',$val,'$remarks','$date')";
                                            $connect->query($sql2);
                                            echo "</tr>";
                                        } 
                                    }
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <button class="print-btn" onclick="printDiv()">Print or Download</button>
        </center>
        <script>
            function printDiv() {
                var divContents = document.getElementById("report").innerHTML;
                var a = window.open('', '', 'height=500, width=500');
                a.document.write('<html>');
                a.document.write('<body>');
                a.document.write(divContents);
                a.document.write('</body></html>');
                a.document.close();
                a.print();
            }
        </script>
    </body>
</html>

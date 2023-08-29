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
    $sql1="SELECT date FROM records WHERE userid='$userprofile'";
    $result1 = $connect -> query($sql1);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>HealthStack | Report History</title>
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
            background-color: #edeff0;
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
        .date-selector {
            width:80%;
            height: 150px;
            background-color: white;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        #date_sel {
            height:40px;
            width:400px;
            padding: 5px;
            font-size: 18px;
            border:1px solid #ade7f7;
            outline-color: #8edff5;
        }
        input[type=submit] {
            height:40px;
            width:70px;
            padding: 5px;
            font-size: 18px;
            background-color: #64d9fa;
            outline:none;
            border:1px solid black;
            border-radius: 2px;
        }
        input[type=submit]:hover {
            cursor: pointer;
            background-color: #3dd4ff;
        }
        .report {
            width:80%;
            margin-top:20px;
            background-color: white;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.26);
            border-radius:4px;
            font-size:18px;
        }
        .print-btn {
            margin:40px auto 50px auto;
            height: 30px;
            font-size: 16px;
            background-color: antiquewhite;
            border-radius:2px;
            border:1px solid black;
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
                    <td align="center" class="tab active" onclick="location.href='repohistory.php'"><i class="ion-clipboard"></i> History</td>
                    <td align="center" class="tab" onclick="location.href='graph.php'"><i class="ion-arrow-graph-up-right"></i> Trend</td>
                    <td align="center" class="tab" onclick="location.href='logout.php'">Logout</td>
                </tr>
            </table>
        </div>
        <center>
        <div class="date-selector">
            <table width="45%" style="position:absolute;margin-top:55px;margin-left:270px;">
                <form action="" method="post">
                    <tr>
                        <td align="center" width="20%"><label for="dot" style="font-size:18px">Select Date: </label></td>
                        <td align="center" width="50%">
                            <select name='dot' id="date_sel">
                                <option>choose date</option>
                                <?php
                                    while($row1=$result1 -> fetch_assoc()) {
                                        echo "<option>".$row1['date']."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td align="center" width="10%"><input type="submit" name="retrieve" value="View"></td>
                    </tr>
                </form>
            </table>
        </div>
        </center>
        <?php
        if(isset($_POST['retrieve'])) {
            $date=$_POST['dot'];
            $sql2="SELECT pathlab FROM records WHERE date='$date'";
            $result2 = $connect -> query($sql2);
            $row2=$result2 -> fetch_assoc();
            ?>
        <center>
            <div class="report" id="report">
                <table cellpadding="10px" width="100%" style="">
                    <tr>
                        <td align="center" width="50%">Patient Name: </td>
                        <td align="center"><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <td align="center">Pathology: </td>
                        <td align="center"><?php echo $row2['pathlab']; ?></td>
                    </tr>
                    <tr>
                        <td align="center">Date of Test: </td>
                        <td align="center"><?php echo $date; ?></td>
                    </tr>
                    <tr><td colspan="2"><hr noshade color="black"></td></tr>
                    <tr>
                        <td colspan="2" align="center">
                            <table width="90%" cellpadding="5px" style="">
                                <tr>
                                    <th width="20%">Name</th>
                                    <th width="15%">Calculated</th>
                                    <th width="15%">Normal Range</th>
                                    <th align="left">Remarks</th>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr noshade color="black" style="margin-top:0;margin-bottom:0;"></td>
                                </tr>
                                <?php
                                $sql3="SELECT testname,minnorm,maxnorm,unit FROM tests";
                                $result3 = $connect -> query($sql3);
                                while($row3=$result3 -> fetch_assoc()) {
                                    $name=strtolower(str_replace(' ',"",$row3['testname']));
                                    $sql4="SELECT value,remarks FROM $name WHERE userid='$userprofile' and date='$date'";
                                    $result4 = $connect -> query($sql4);
                                    if($row4=$result4->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td align='center'>".$row3['testname']."</td>";
                                        echo "<td align='center'>".$row4['value']."</td>";
                                        echo "<td align='center'>".$row3['minnorm']." - ".$row3['maxnorm']." ".$row3['unit']."</td>";
                                        echo "<td>".$row4['remarks']."</td>";
                                        echo "</tr>";
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
        <?php
        }
        ?>
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

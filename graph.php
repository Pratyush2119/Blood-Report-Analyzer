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
    $sql1="SELECT testname FROM tests";
    $result1 = $connect -> query($sql1);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>HealthStack | Graphs</title>
        <link rel="icon" href="Resources/img/medical-report.png" type="image/x-icon">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <script src="vendors/js/jquery.min.js"></script>
        <script src="vendors/js/chart.min.js"></script>
        <script src="vendors/js/chart.js"></script>
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
        .test-selector {
            width:80%;
            height: 150px;
            background-color: white;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        #test_sel {
            height:40px;
            width:400px;
            padding: 5px;
            font-size: 18px;
            border:1px solid #ade7f7;
            outline-color: #8edff5;
        }
        .view-btn {
            height:40px;
            width:70px;
            padding: 5px;
            font-size: 18px;
            background-color: #64d9fa;
            outline:none;
            border:1px solid black;
            border-radius: 2px;
        }
        .view-btn:hover {
            cursor: pointer;
            background-color: #3dd4ff;
        }
        .test-graph {
            width:80%;
            margin-top:20px;
            background-color: white;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.26);
            border-radius:4px;
            font-size:18px;
        }
        .test-graph {
            position: relative;
            margin: auto;
            height: 70vh;
            width: 70vw;
            margin-top: 10px;
            padding: 5px;
        }
        #mycanvas {
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
                    <td align="center" class="tab active" onclick="location.href='graph.php'"><i class="ion-arrow-graph-up-right"></i> Trend</td>
                    <td align="center" class="tab" onclick="location.href='logout.php'">Logout</td>
                </tr>
            </table>
        </div>
        <center>
        <div class="test-selector">
            <table width="45%" style="position:absolute;margin-top:55px;margin-left:270px;">
                <tr>
                    <td align="center" width="20%"><label for="dot" style="font-size:18px">Select Test: </label></td>
                    <td align="center" width="50%">
                        <select name='bloodtest' id="test_sel">
                            <option>Choose Test</option>
                            <?php
                                while($row1=$result1 -> fetch_assoc()) {
                                    $name=strtolower(str_replace(' ',"",$row1['testname']));
                                    $sql2="SELECT userid FROM $name WHERE userid='$userprofile'";
                                    $result2=$connect->query($sql2);
                                    if(mysqli_num_rows($result)>0) {
                                        echo "<option value='".$row1['testname']."'>".$row1['testname']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td align="center" width="10%"><button class="view-btn" id="view-btn" name="graphy">View</button></td>
                </tr>
            </table>
        </div>
        </center>
        <center>
            <div class="test-graph" style="display:none;">
                <canvas id="mycanvas"></canvas>
            </div>
        </center>
        <script>
            $(document).ready(function() {
                $("#view-btn").click(function() {
                    var text=$("#test_sel option:selected").text();
                    if(text!='') {
                        $(".test-graph").show();
                        $.ajax({
                            url:'action.php?type=graphdata',
                            method:'post',
                            data:{query:text},
                            success:function(data){
                                var values = [];
                                var dates = [];
                                var len=data.length;
                                for(var i=0;i<len;i++) {
                                    values.push(data[i].value);
                                    dates.push(data[i].date);
                                }
                                var chartdata = {
                                    labels: dates,
                                    datasets: [
                                        {
                                            label: text,
                                            fill: false,
                                            lineTension:0.1,
                                            backgroundColor:"rgba(59,89,152,0.75)",
                                            borderColor:"rgba(59,89,152,1)",
                                            pointHoverBackgroundColor: "rgba(59,89,152,1)",
                                            pointHoverBorderColor:"rgba(59,89,152,1)",
                                            data:values
                                        }
                                    ]
                                };
                                var options = {
                                    maintainAspectRatio: false,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                };

                                var ctx=$("#mycanvas");
                                var LineGraph = new Chart(ctx,{
                                    type:'line',
                                    data:chartdata,
                                    options:options
                                });
                           },
                        Error:function(data) {
                            
                        }
                        });
                    }
                    else {

                    }
                });
            });
        </script>
    </body>
</html>

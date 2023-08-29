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
        <title>Set New Password!</title>
        <link rel="icon" href="Resources/img/medical-report.png" type="image/x-icon">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <style>
        body {
            padding: 0;
            margin: 0;
            background-color: #e1e2e3;
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
            height: 370px;
            margin-top: 150px;
            margin-left: 450px;
            box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.26);
            font-weight: 300;
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
        p {
            font-size: 28px;
        }
        #asterisk,#msg {
            color: red;
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
                <p>Set the new Password...</p>
                <span id="msg" style="display:none">Fields with * marks are Mandatory</span>
                <input type="text" id="checkpass" value="<?php echo $row['password'];?>" style="display:none">
                 <form action="update.php" method="post" onsubmit=" return passmatch()">
                    <table cellpadding="10px" style="border-collapse:collapse;">
                        <tr>
                            <td>
                                <label for="curpass">Current Password : <span id="asterisk">*</span></label>
                            </td>
                            <td>
                                <input type="password" name="curpass" id="curpass">
                                <button type="button" id="btn1" onclick="view(0)"><i class="ion-eye"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="newpass">New Password : <span id="asterisk">*</span></label>
                            </td>
                            <td>
                                <input type="password" name="newpass" id="newpass">
                                <button type="button" id="btn2" onclick="view(1)"><i class="ion-eye"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="conpass">Confirm Password : <span id="asterisk">*</span></label>
                            </td>
                            <td>
                                <input type="password" name="conpass" id="conpass" onkeyup="match();">
                                <button type="button" id="btn3" onclick="view(2)"><i class="ion-eye"></i></button>
                            </td>
                        </tr>
                        <tr align="center" >
                            <td colspan="2" valign="top">
                                <span id="info">&nbsp;</span>
                            </td>
                        </tr>
                    </table>
                     <input type="submit" name="setpass" value="Save">
                </form>
            </center>
        </div>
        <script type="text/javascript">
            function passmatch() {
                var val1=document.getElementById('curpass').value;
                var val2=document.getElementById('newpass').value;
                var val3=document.getElementById('conpass').value;
                if(val1=="" || val2=="" || val3=="")
                    {
                        document.getElementById('msg').style.display="block";
                        return false;
                    }
                else
                {
                    if(document.getElementById('curpass').value!=document.getElementById('checkpass').value)
                    {
                        alert('Invalid Current Password!');
                        return false;
                    }
                    else
                    {
                    return true;
                    }
                }
            }
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
            var z=0;
            function view(n){
                if(n==0)
                    {
                        if(x==0)
                            {
                                var val=document.getElementById('curpass').value;
                                document.getElementById('curpass').type="text";
                                document.getElementById('curpass').value=val;
                                document.getElementById('btn1').innerHTML="<i class='ion-eye-disabled'></i>"
                                x=1;
                            }
                        else
                            {
                                var val=document.getElementById('curpass').value;
                                document.getElementById('curpass').type="password";
                                document.getElementById('curpass').value=val;
                                document.getElementById('btn1').innerHTML="<i class='ion-eye'></i>"
                                x=0;
                            }
                    }
                else if(n==1)
                    {
                        if(y==0)
                            {
                                var val=document.getElementById('newpass').value;
                                document.getElementById('newpass').type="text";
                                document.getElementById('newpass').value=val;
                                document.getElementById('btn2').innerHTML="<i class='ion-eye-disabled'></i>"
                                y=1;
                            }
                        else
                            {
                                var val=document.getElementById('newpass').value;
                                document.getElementById('newpass').type="password";
                                document.getElementById('newpass').value=val;
                                document.getElementById('btn2').innerHTML="<i class='ion-eye'></i>"
                                y=0;
                            }
                    }
                else
                {
                    if(z==0)
                            {
                                var val=document.getElementById('conpass').value;
                                document.getElementById('conpass').type="text";
                                document.getElementById('conpass').value=val;
                                document.getElementById('btn3').innerHTML="<i class='ion-eye-disabled'></i>"
                                z=1;
                            }
                        else
                            {
                                var val=document.getElementById('conpass').value;
                                document.getElementById('conpass').type="password";
                                document.getElementById('conpass').value=val;
                                document.getElementById('btn3').innerHTML="<i class='ion-eye'></i>"
                                z=0;
                            }
                }
            }
        </script>
    </body>
</html>
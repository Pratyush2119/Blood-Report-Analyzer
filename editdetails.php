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
        <title>My Account |  Edit Details</title>
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
                transition:0.2s;
            }
            .active {
                background-color: #45f7dd;
                color:blue;
            }
            .details {
                width:72.5%;
                margin-top:10px;
                background-color: white;
                margin-left:310px;
                padding:50px;
                font-size:18px;
                box-shadow: 0 1px 2px 0 rgba(0,0,0,0.26);
                font-weight: 300;
                height:500px;
            }
            a {
                text-decoration: none;
            }
            .details tr {
                border-bottom: 1px solid #caccca;
            }
            .sidebar {
                height:100%;
                width:300px;
                position:fixed;
                z-index:1;
                left:0;
                background-color:#f5f5f5;
                overflow-x: hidden;
                padding-top: 40px;
            }
            #btn1,#btn2 {
                width:100%;
                padding: 6px 8px 6px 16px;
                font-size: 20px;
                margin-bottom: 30px;
                display:block;
                background-color: transparent;
                outline: none;
                border:none;
            }
            #btn1:hover,#btn2:hover {
                background-color: #cfcccc;
                cursor: pointer;
            }
            .sidebar i {
                vertical-align: middle;
                margin-right: 10px;
            }
            span {
                vertical-align: middle;
            }
            input[type=text],input[type=tel],input[type=date] {
                height:25px;
                width:300px;
                padding: 5px;
                font-size: 18px;
            }
            input[type=submit] {
                width:80px;
                height:38px;
                font-size:20px;
                border:1px solid;
                outline:none;
                border-radius:5px;
                box-shadow: 0 1px 2px 0 rgba(0,0,0,0.26);
                background-color: #36f56f;
            }
            input[type=submit]:hover {
                cursor: pointer;
                box-shadow: 0 4px 12px 0 rgba(0,0,0,0.26);
                transition: 0.4s;
                background-color: #2deb36;
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
                    <td align="center" class="tab active" onclick="location.href='#'"><i class="ion-android-person"></i> Account</td>
                    <td align="center" class="tab" onclick="location.href='repohistory.php'"><i class="ion-clipboard"></i> History</td>
                    <td align="center" class="tab" onclick="location.href='graph.php'"><i class="ion-arrow-graph-up-right"></i> Trend</td>
                    <td align="center" class="tab" onclick="javascript:alert('Save the details before logging out!');">Logout</td>
                </tr>
            </table>
        </div>
        <div class="sidebar">
            <button class="menu-item" id="btn1">
                <i class="ion-android-contact"></i>
                <span>Personal Info</span>
            </button>
            <button class="menu-item" id="btn2">
                <i class="ion-android-lock"></i>
                <span>Security</span>
            </button>
        </div>
        <div class="details" id="personal-info">
            <fieldset style="border:1px solid #bbbdbb">
                <legend>Personal Details:</legend>
                <form action="update.php" method="post">
                    <table cellpadding="20px" style="border-collapse:collapse;width:100%;">
                        <tr align="center">
                            <td>Name :</td>
                            <td><input type="text" name="name" value="<?php echo $row['name'];?>"></td>
                        </tr>
                        <tr align="center">
                            <td>Registered Email :</td>
                            <td><input type="text" name="email" value="<?php echo $row['email'];?>"></td>
                        </tr>
                        <tr align="center">
                            <td>Gender :</td>
                            <td>
                                <input type="radio" name="gender" value="Male" <?php echo ($row['gender']=='Male')? 'checked':'';?>>Male
                                <input type="radio" name="gender" value="Female" <?php echo ($row['gender']=='Female')? 'checked':'';?>>Female
                                <input type="radio" name="gender" value="Others" <?php echo ($row['gender']=='Others')? 'checked':'';?>>Others
                            </td>
                        </tr>
                        <tr align="center">
                            <td>Date of Birth :</td>
                            <td><input type="date" name="dob" value="<?php echo $row['dob'];?>"></td>
                        </tr>
                        <tr align="center">
                            <td>Phone :</td>
                            <td><input type="tel" name="phone" maxlength="10" value="<?php echo $row['phone'];?>"></td>
                        </tr>
                    </table>
                    <br>
                    <center><input type="submit" name="submit" value="Save"></center>
                </form>
            </fieldset>
        </div>
        <script type="text/javascript">
            document.getElementById('btn1').style.backgroundColor="#cfcccc";
            document.getElementById('btn2').style.backgroundColor="transparent";
        </script>
    </body>
</html>
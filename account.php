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
        <title>HealthStack | My Account</title>
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
                background-color: #35fca3;
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
                height:585px;
            }
            .edit-btn {
                width:65px;
                height:35px;
                font-size:16px;
                border:1px solid;
                outline:none;
                border-radius:5px;
                box-shadow: 0 1px 2px 0 rgba(0,0,0,0.26);
                margin-left: 230px;
            }
            .edit-btn:hover {
                cursor: pointer;
                background-color: #f5c447;
                box-shadow: 0 4px 12px 0 rgba(0,0,0,0.26);
                transition: 0.4s;
            }
            a {
                text-decoration: none;
            }
            .details tr {
                border-bottom: 1px solid #e6e8e7;
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
            .sidebar button {
                width:100%;
                padding: 6px 8px 6px 16px;
                font-size: 20px;
                margin-bottom: 30px;
                display:block;
                background-color: transparent;
                outline: none;
                border:none;
            }
            .sidebar button:hover {
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
            .btn {
                background-color: transparent;
                color:#a505f7;
                border:none;
                font-size:16px;
                font-weight: 300;
                margin-bottom: 5px;
            }
            .btn:hover {
                cursor:pointer;
            }
            select {
                width: 100%;
                height:30px;
                font-family:'Lato','Arial',sans-serif;
                letter-spacing: 1px;
            }
            input[type=text] {
                width:75%;
                height: 25px;
                font-family:'Lato','Arial',sans-serif;
                letter-spacing: 1px;
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
                    <td align="center" class="tab active" onclick="location.href='aacount.php'"><i class="ion-android-person"></i> Account</td>
                    <td align="center" class="tab" onclick="location.href='repohistory.php'"><i class="ion-clipboard"></i> History</td>
                    <td align="center" class="tab" onclick="location.href='graph.php'"><i class="ion-arrow-graph-up-right"></i> Trend</td>
                    <td align="center" class="tab" onclick="location.href='logout.php'">Logout</td>
                </tr>
            </table>
        </div>
        <div class="sidebar">
            <button class="menu-item" id="btn1" onclick="opentab(0)">
                <i class="ion-android-contact"></i>
                <span>Personal Info</span>
            </button>
            <button class="menu-item" id="btn2" onclick="opentab(1)">
                <i class="ion-android-lock"></i>
                <span>Security</span>
            </button>
        </div>
        <div class="details" id="personal-info">
            <fieldset style="border:1px solid #bbbdbb;border-radius:2px;">
                <legend>Personal Details:</legend>
                <table cellpadding="20px" style="border-collapse:collapse;width:100%;">
                <tr>
                    <td>Name :</td>
                    <td><?php echo $row['name'];?></td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td><?php echo $row['username'];?></td>
                </tr>
                <tr>
                    <td>Registered Email :</td>
                    <td><?php echo $row['email'];?></td>
                </tr>
                <tr>
                    <td>Gender :</td>
                    <td><?php echo $row['gender'];?></td>
                </tr>
                <tr>
                    <td>Date of Birth :</td>
                    <td><?php echo $row['dob'];?></td>
                </tr>
                <tr>
                    <td>Phone :</td>
                    <td><?php echo $row['phone'];?></td>
                </tr>
            </table><br><br><br><br><br>
            <button class="edit-btn" onclick="location.href='editdetails.php'">Edit</button><br><br>
            </fieldset>
        </div>
        <div class="details" id="security" style="display:none">
            <fieldset style="border:1px solid #bbbdbb;border-radius:2px;">
                <legend>Security:</legend>
                <table cellpadding="20px" style="border-collapse:collapse;width:100%;">
                    <tr>
                        <td>Last Login :</td>
                        <td><?php echo $row['last_login']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Password :</td>
                        <td><a href="newpass.php" style="color:#a505f7">Change Password</a></td>
                    </tr>
                    <tr>
                        <td valign="top">Security Question :</td>
<?php
if($row['question']=='')
{
?>
                        <td>
                            <div class="init"><button class="btn" id="btn" onclick="openadd()">Add</button></div>
                            <div class="add-question" id="add-question" style="display:none;">
                                <form action="update.php" method="post">
                                    <table cellpadding="5px" style="border-collapse:collapse;width:100%">
                                        <tr>
                                            <td width="25%">
                                                <label for="question">Choose Question: </label>
                                            </td>
                                            <td>
                                                <select name="question">
                                                    <option selected>Select a question</option>
                                                    <option>What's your mother's maiden name?</option>
                                                    <option>What is the name of your first pet?</option>
                                                    <option>What was your first car?</option>
                                                    <option>Where was your best family vacation as a kid?</option>
                                                    <option>What elementary school did you attend?</option>
                                                    <option>What is the name of the town where you were born?</option>
                                                </select>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="answer">Answer: </label>
                                            </td>
                                            <td>
                                                <input type="text" name="answer">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="submit" name="add" value="Save" style="margin-left:100px;">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </td>
<?php
}
else
{
?>   
                   <td>
                            <div class="question" id="question">
                                <span style="font-size:14px">Security Question already set.</span>     
                            </div>
                        </td>
<?php
}
?>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="passmethod.php" style="color:#a505f7">Recover Password!</a>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </div>
        <script type="text/javascript">
            document.getElementById('btn1').style.backgroundColor="#cfcccc";
            function opentab(n) {
                if(n==0) {
                    document.getElementById('personal-info').style.display="block";
                    document.getElementById('security').style.display="none";
                    document.getElementById('btn1').style.backgroundColor="#cfcccc";
                    document.getElementById('btn2').style.backgroundColor="transparent";
                    document.getElementById('add-question').style.display="none";
                    document.getElementById('btn').style.display="block";
                }
                if(n==1) {
                    document.getElementById('personal-info').style.display="none";
                    document.getElementById('security').style.display="block";
                    document.getElementById('btn2').style.backgroundColor="#cfcccc";
                    document.getElementById('btn1').style.backgroundColor="#f5f2f2";
                }
            }
            function openadd() {
                document.getElementById('add-question').style.display="block";
                document.getElementById('btn').style.display="none";
            }
        </script>
    </body>
</html>
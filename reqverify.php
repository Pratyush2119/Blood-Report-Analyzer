<?php
$type=$_GET['type'];
?>
<!DOCTYPE HTML>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <style>
            body {
                font-size: 30px;
                font-family:'Lato','Arial',sans-serif;
                font-weight:300;
            }
            .black-content {
                display:block;
                position:absolute;
                top:0%;
                left:0%;
                width:100%;
                height:750px;
                background-color:black;
                opacity:0.7;
                z-index:1;
            }
            .white-content {
                position:absolute;
                background-color: white;
                width:500px;
                height:240px;
                margin-top:230px;
                margin-left:500px;
                border-radius: 10px;
                display :block;
                z-index:1000;
            }
            button {
                width:100px;
                height: 35px;
                background-color: #59cf69;
                border:1px solid black;
                border-radius: 25px;
                outline: none;
            }
            button:hover {
                background-color: #1fd138;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="black-content" id="back"></div>
<?php
if($type=='login')
{
?>
        <div class="white-content">
            <center>
                <p>Your registered email id has not been verified. Please verify your email id to continue further !!</p>
                <button onclick="location.href='login.php'">OK</button>
            </center>
        </div>
<?php
}
if($type=='recover')
{
?>
        <div class="white-content">
            <center>
                <p>An email has been sent to your registered email id for password recovery.</p>
                <button onclick="location.href='account.php'">OK</button>
            </center>
        </div>
<?php
}
?>
    </body>
</html>
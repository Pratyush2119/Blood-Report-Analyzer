<?php
$type=$_GET['type'];
?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: azure;
                font-family:'Lato','Arial',sans-serif;
                font-weight:300;
            }
            .box {
                background-color: white;
                border-radius: 5px;
                padding:20px;
                width:600px;
                height: 200px;
                margin-top: 200px;
                margin-left: 450px;
                box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.26);
            }
            p {
                font-size: 28px;
            }
            input[type=email] {
                width:400px;
                margin-bottom: 25px;
                height: 30px;
                padding:5px;
                font-size: 18px;
                border:1px solid #cdcdcd;
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
        </style>
    </head>
    <body>
        <div class="box">
            <center>
                <p>Enter your Registered Email ID...</p>
                <form action="enterotp.php?type=<?php echo $type;?>" method="post">
                    <input type="email" name="email" placeholder="Enter your email"><br>
                    <input type="submit" name="submit" value="Next">
                </form>
            </center>
        </div>
    </body>
</html>


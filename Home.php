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
        <title>HealthStack | Home</title>
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
        .content2,.images {
            height: 671px;
            width:1510px;
        }
        .blank {
            height:670px;
            width:1500px;
            z-index: -10;
            margin: 20px auto 0 13px;
            background-color: black;
            opacity:0.5;
            position:absolute;
            border-radius: 3px;
        }
        .content {
            z-index: 10;
            background-color:transparent;
            position:absolute;
            margin: 20px auto 0 12px;
            border-radius: 3px;
            height:668px;
            width:1508px;
        }
        .content2 {
            z-index: 1;
            background-color:transparent;
            position:absolute;
            margin: 20px auto 0 12px;
            border-radius: 3px;
        }
        .images { 
            margin: 20px auto 0 auto;
            z-index: -20;
        }
        .images img {
            width:1510px;
            height: 670px;
            border-radius: 3px;
        }
        .ghostbtn {
            height:45px;
            width:150px;
            font-size: 18px;
            border-radius: 40px;
            border:2px solid #ff9500;
            color:white;
            background-color: transparent;
            margin-left:50px;
        }
        .ghostbtn:hover {
            cursor:pointer;
            color:black;
            background-color: #ff9500;
        }
        h1 {
            font-weight:300;
            text-transform:uppercase;
            letter-spacing:1px;
            color:#fff;
            margin-top:0;
            margin-bottom:20px;
            font-size:240%;
            word-spacing:4px;
        }
        .text {
            width:80%;
            margin: 200px auto auto auto;
        }
        form {
            margin: 200px 600px auto 600px;;
        }
        #search {
            height:30px;
            width:400px;
            padding: 5px;
            font-size: 18px;
            margin:200px 0 0 250px;
            border:1px solid #ade7f7;
            outline-color: #8edff5;
        }
        .add-btn {
            height:42px;
            width:70px;
            padding: 5px;
            margin-top:200px;
            margin-left: -2px;
            position: absolute;
            font-size: 18px;
            background-color: #64d9fa;
            outline:none;
            border:1px solid black;
            border-radius: 2px;
        }
        .add-btn:hover {
            cursor: pointer;
            background-color: #3dd4ff;
        }
        .test-list {
            height:30px;
            width:410px;
            font-size: 18px;
            margin: 0 0 auto 250px;
            z-index:30;
        }
        .test-list-item:hover {
            background-color: #f2f1f0;
            cursor:pointer;
        }
        tr.added td,tr.test-list-item td {
            border-bottom: 1px solid #e3e3e3;
        }
        .ion-ios-close-outline:hover {
            cursor: pointer;
        }
        .info {
            height:40px;
            width:400px;
            border:1px solid red;
            z-index: 25;
            position: absolute;
            text-align:center;
            background-color:#faacb5;
            right: 0;
        }
        input[type=submit] {
            margin-top:30px;
            margin-left:1005px;
            height:40px;
            width:100px;
            font-size:18px;
            border:1px solid black;
            background-color: #42cef5;
            border-radius: 2px;
        }
        input[type=submit]:hover {
            cursor: pointer;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.26);
            background-color: #57d7fa;
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
                    <td align="center" class="tab" onclick="location.href='repohistory.php'"><i class="ion-clipboard"></i> History</td>
                    <td align="center" class="tab" onclick="location.href='graph.php'"><i class="ion-arrow-graph-up-right"></i> Trend</td>
                    <td align="center" class="tab" onclick="location.href='logout.php'">Logout</td>
                </tr>
            </table>
        </div>
        <div class="blank" style=""></div>
        <div class="content" style="">
            <div class="text">
                <h1>Let's Get Started!<br> Analyse Some reports. See the status of your health.</h1>
                <br>
                <button class="ghostbtn">Add Report!</button>
            </div>
        </div>
        <div class="content2" style="display:none;">
            <input type="text" id="search" placeholder="Search Tests...">
            <button class="add-btn">Add</button>
            <div class="test-list" id="test-list">
                <table cellpadding="10px" id="t_list" width="100%" style="box-shadow: 5px 10px 8px #888888;background-color:white;">
                        
                </table>
            </div>
            <div class="sel-list" id="sel_list" style="border:1px solid black;width:410px;margin:-75px 0 0 850px;height:202px;overflow:auto;background-color:aliceblue">
                <table cellpadding="10px" id="s_list" width="100%">
                    <tr id="default" style="height:198px">
                        <td align="center">No Tests added yet!</td>
                    </tr>
                </table>
            </div>
            <input type="submit" name="submit" form="list-form" value="Next">
            <br><br><br><br><br><br><br>
            <form action="home2.php" method="post" id="list-form">
                <input type="text" name="list" id="list" style="display:none;">
            </form>
        </div>
        <div class="info" style="overflow:hidden;display:none;"><p class="msg" style="margin-top:8px;"></p></div>
        <div class="images" style="">
            <div class="myslides">
                <img src="Resources/img/download%20(1).jfif">
            </div> 
            <div class="myslides">
                <img src="Resources/img/download%20(2).jfif">
            </div>
            <div class="myslides">
                <img src="Resources/img/download%20(3).jfif">
            </div>
            <div class="myslides">
                <img src="Resources/img/download%20(4).jfif">
            </div>
        </div>
        <script>
            var slideIndex=0;
            showSlides();
            function showSlides() {
                var i;
                
                var slides=document.getElementsByClassName("myslides");
                for(i=0;i<slides.length;i++) {
                    slides[i].style.display="none";
                }
                slideIndex++;
                if(slideIndex>slides.length) {
                    slideIndex=1;
                }
                slides[slideIndex-1].style.display="block";
                setTimeout(showSlides,5000);
            }
            $(document).ready(function(){
                $(".ghostbtn").click(function(){
                    $(".content").animate({
                        height: 'toggle'
                    },"slow");
                    $(".content2").slideDown(1000);
                });
            });
            $(document).ready(function(){
               $("#search").keyup(function(){
                   var searchText = $(this).val();
                   if(searchText!='') {
                       $.ajax({
                           url:'action.php?type=search',
                           method:'post',
                           data:{query:searchText},
                           success:function(response){
                               $("#t_list").html(response);
                           }
                       });
                   }
                   else {
                       $("#t_list").html('');
                   }
               });
                $(document).on('click','.test-list-item',function(){
                   $("#search").val($(this).text());
                    $("#t_list").html('');
                });
            });
            $(document).ready(function(){
               $(".add-btn").click(function(){
                   var searchText=$("#search").val();
                   if(searchText!='') {
                       if($("#list").val().indexOf(searchText)==-1) {
                           $("#default").hide();
                           $("#sel_list").css('background-color','aliceblue');
                           markup="<tr class='added'><td class='col1' width='80%'>"+searchText+"</td><td><button style='background-color:transparent;outline:none;border:none;font-size:24px;'><i class='ion-ios-close-outline rmv-btn'></i></button></td></tr>";
                           tableBody=$("#s_list");
                           tableBody.append(markup);
                           $("#list").val($("#list").val()+searchText+';');
                       }
                       else {
                           $(".msg").html(searchText+' already added!');
                           $(".info").fadeIn();
                           $(".info").delay(3000).fadeOut();
                       }
                   }
               });
            });
            $("#s_list").on('click','.rmv-btn',function(){
                let rval = $(this).closest('tr').find(".col1").text()+';';
                $(this).closest('tr').remove();
                let lval=$("#list").val();
                let uval=lval.replace(rval,'');
                $("#list").val(uval);
                if($("#list").val()=='') {
                    $("#default").show();
                }
            });
        </script>
    </body>
</html>

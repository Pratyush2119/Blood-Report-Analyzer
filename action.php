<?php
include("db_connection.php");
session_start();
$userprofile = $_SESSION['username'];
if($_GET['type']=='search') {
    if(isset($_POST['query'])) {
        $inpText=$_POST['query'];
        $sql="SELECT testname FROM tests WHERE testname LIKE '$inpText%'";
        $result = $connect -> query($sql);
        $count=mysqli_num_rows($result);
        if($count>0) {
            while($row=$result -> fetch_assoc()) {
                echo "<tr class='test-list-item'><td>".$row['testname']."</td></tr>";
            }
        }
        else {
            echo "<tr class='test-list-item'><td>No Search results...</td></tr>";
        }
    }
}
if($_GET['type']=='graphdata') {
    if(isset($_POST['query'])) {
        header('content-Type:application/json');
        $test=$_POST['query'];
        $name=strtolower(str_replace(' ',"",$test));
        $sql=sprintf("SELECT value,date FROM $name WHERE userid='$userprofile' ORDER BY date ASC");
        $result = $connect -> query($sql);
        $data=array();
        foreach($result as $row) {
            $data[]=$row;
        }
        print json_encode($data);
    }
}
?>
<?php
include("../includes/server.php");

if(isset($_POST['rrr'])){
    // get the inputed RRR
    $rrr = $_POST['rrr'];
    $res = "";

// Verify the RRR from the database
    $sql = "SELECT * FROM student WHERE rrr='$rrr'";
    $result = mysqli_query($conn, $sql);

    if($result){
        $row = mysqli_fetch_assoc($result);
        if($row['rrr']==$rrr){
            $res = 'Payment Made Successfully';
        }else{
            $res = 'Payment Not Made or Invalid RRR';
        }
    }else{
        $res = 'Payment Not Made or Invalid RRR';
    }
}

echo $res;
?>

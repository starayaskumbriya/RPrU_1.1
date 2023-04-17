<?php

$logPass = json_decode($_POST['logPassJSON']);

$answer = [];
$flagArr = [];
session_start();
$logAndPassToForm = $logPass[0]."_".$logPass[1];

$_SESSION['session'] = $logAndPassToForm;


$conn = mysqli_connect("localhost", "root", "", "RPrU");

$sql228 = "SELECT * FROM allTests";
if($result = mysqli_query($conn, $sql228)){
    while($row = mysqli_fetch_array($result)){
        if($row["logAndPass"] == $logAndPassToForm) array_push($flagArr, $row["logAndPass"]);
    }
}

if(count($flagArr) == 0) array_push($answer, 0);
else array_push($answer, 1);


echo json_encode($answer);
?>
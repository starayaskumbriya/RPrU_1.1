<?php

$feedback = json_decode($_POST['feedbackJSON']);


session_start();
$logAndPass = $_SESSION['session'];

$conn = mysqli_connect("localhost", "root", "", "RPrU");
if($feedback[2] == "questionsAndSuggestions") {
    $sql = "INSERT INTO feedbackTable (logAndPass, testName, questionsAndSuggestions) VALUES ('$logAndPass', '$feedback[0]', '$feedback[1]')";
}
if($feedback[2] == "bugReport") {
    $sql = "INSERT INTO feedbackTable (logAndPass, testName, bugReport) VALUES ('$logAndPass', '$feedback[0]', '$feedback[1]')";
}
mysqli_query($conn, $sql);
mysqli_close($conn);

// echo json_encode([$logAndPass, $feedback[1], $feedback[0], $feedback[2]]);
echo json_encode([":)"]);

?>
<?php
$fromTo = "NoReply@pearson.com";
$sendTo = $_POST["mailId"];
$nameTo = $_POST["uname"];
$message = $_POST["msg"];

$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers = $headers . "Content-type: text/html; charset=iso-8859-1" . "\r\n"; 
$headers = $headers . "From: <" . $fromTo .">";

// mail send to user
mail( $sendTo, "Your Simulation Results", $message, $headers );

echo "done=true";  

?> 


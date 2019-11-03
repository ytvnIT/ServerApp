<?php 

$to = "huutho321@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: demo@it4u.top" . "\r\n";

echo mail($to,$subject,$txt,$headers);    

?>





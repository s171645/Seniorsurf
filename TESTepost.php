<?php
$to = "myemail@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "admin@mydomain.com";
$headers = "From: $from";
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?> 
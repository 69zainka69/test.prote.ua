<?php
$to      = 'info@prote.ua';
$subject = 'TEST message';
$message = 'TEST тестовый';
$headers = 'From: test@test.ua' . "\r\n" .
    'Reply-To: test@test.ua' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

phpinfo();

?>
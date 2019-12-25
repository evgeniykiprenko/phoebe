<?php

namespace mail;

class Mail
{
    public static function sendWelcomeEmail($email, $firstName, $lastName)
    {
        $to = "<$email>";
        $subject = 'Welcome to Phoebe!';
        $message = "We are very welcome you, $firstName $lastName!";
        $headers  = "Content-type: text/html; charset=windows-1251 \r\n";
        $headers .= "From: <evgexaxv@gmail.com>\r\n";
        $headers .= "Reply-To: evgexaxv@gmail.com\r\n";
        mail($to, $subject, $message, $headers);
    }
}

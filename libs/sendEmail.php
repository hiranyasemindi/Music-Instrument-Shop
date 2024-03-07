<?php
require "../libs/SMTP.php";
require "../libs/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    static function sendEmail($email, $body)
    {

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hiranyagunawardhane@gmail.com';
        $mail->Password = 'dchmdrjebuiykvqh';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('hiranyagunawardhane@gmail.com', 'Reset Password');
        $mail->addReplyTo('hiranyagunawardhane@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Sonority Forgot Password Verification Code';
        $bodyContent = $body;
        $mail->Body    = $bodyContent;


        if (!$mail->send()) {
            return 'Verification code sending failed';
        } else {
            return "Success";
        }
    }
}

<?php
require "../libs/SMTP.php";
require "../libs/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    static function sendEmail($email, $otp)
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
        $bodyContent = ' <body style="background-color: #f0ebeb;" width="100%">
    <div style="margin-left:30%; width: 40%; background-color: white; text-align: center;">
        <div style="background-color: #AD1212; height: 30px;"></div>
        <div>
            <img width="200px" src="https://media.istockphoto.com/id/1338629648/vector/mail-approved-vector-flat-conceptual-icon-style-illustration-eps-10-file.jpg?s=612x612&w=0&k=20&c=o6AcZk3hB6ShxOzmssuOcsfh0QYEQVJ0nCuEZZj1_nQ=" alt="email_icon" style="margin-top: 30px;">
            <p style="font-size: 22px; font-weight: bold;">Verify Your Email Address</p>
            <p style="padding-left: 80px; font-size:15px; padding-right: 80px; line-height: 25px;">Before reset your password you should verify your email first. Please use this verification code for the verification of your email.</p>
        </div>
        <div style="width: 40%; margin-left: 30%; margin-top: 35px;  margin-bottom: 35px;">
            <div style="background-color: #AD1212;padding-bottom: 10px; padding-top: 10px; border-radius: 5px; color: white; font-weight: 500; font-size: xx-large; letter-spacing: 15px; text-align: center;">
                ' . $otp . '
            </div>
        </div>
        <div style="margin-bottom: 25px;">
            <p>Thank You.</p>
        </div>
        <div style="background-color: #AD1212; padding: 20px; margin-top: 45px;">
            <p style="color: white; line-height: 25px;">&copy; Sonotity Music Instruments.<br> All Rights Reserved.</p>
        </div>
    </div>

</body>
';
        $mail->Body    = $bodyContent;

        return $mail->send() ? "Success" : null;
    }
}

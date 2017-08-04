<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'PHPMailer/PHPMailerAutoload.php';

class MailSend
{

    public $mail;

    public function loadMailerSettings()
    {
        $this->mail = new PHPMailer;
        //$this->mail->SMTPDebug = 1;
        $this->mail->IsSMTP();
        $this->mail->CharSet = "UTF-8";
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'support@lm-style.com';
        $this->mail->Password = 'sleeder1';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
    }

    public function sendTo($toEmail, $recipientName, $subject, $msg)
    {
        $this->mail->setFrom('support@lm-style.com', 'pmInvoice');
        $this->mail->addAddress($toEmail, $recipientName);
        $this->mail->ClearReplyTos();
        $this->mail->addReplyTo('kiro2424@gmail.com', 'EXAMPLE');
        //$this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $msg;
        if (!$this->mail->Send()) {
            echo "Mailer Error: " . $this->mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }

}

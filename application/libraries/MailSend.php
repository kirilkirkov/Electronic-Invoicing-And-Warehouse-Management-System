<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'PHPMailer/PHPMailerAutoload.php';

/*
 * This class is used to send invoices from users
 */
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
        $this->mail->Username = '';
        $this->mail->Password = '';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
    }

    public function sendTo($toEmail, $recipientName, $subject, $msg)
    {
        $this->mail->setFrom('you@mail.com', 'pmInvoice');
        $this->mail->addAddress($toEmail, $recipientName);
        $this->mail->ClearReplyTos();
        $this->mail->addReplyTo('you1@mail.com', 'EXAMPLE');
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

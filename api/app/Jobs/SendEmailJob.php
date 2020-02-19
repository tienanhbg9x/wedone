<?php

namespace App\Jobs;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SendEmailJob extends Job
{
    protected $token = null;
    public $user;


    public function __construct($token,$user)
    {
        $this->user = $user;
        $this->token = $token;
    }
    public function handle()
    {
        $mail = new PHPMailer();
        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = env('MAIL_SECURE');
            $mail->Port = env('MAIL_PORT');
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->CharSet="utf-8";

            $mail->setFrom(env('MAIL_USERNAME'), 'mr.A');
            $mail->addAddress($this->user['email']);
            $mail->addReplyTo(env('MAIL_USERNAME'), 'mr.A');

            $mail->isHTML(true);
            $mail->Subject = 'Xác thực thông tin người dùng sosanhnha.com';
            $url = url('http://localhost:8000/api/v1/user/verify?token='.$this->token);
            $mail->Body = '<h1>Chào mừng'.' '.$this->user['name'].' '.' đã đến với sosanhnha.com</h1><br><p>Email bạn đã đăng ký là: <b>'.$this->user['email'].'</b>.Vui lòng nhấn vào vào link bên dưới để tiến hành xác thực tài khoản.</p><br><a href="' . $url . '"><h2>Verify email address</h2></a>';
            $mail->send();
            echo "Message has been sent";
        } catch (\Exception $e) {
            print_r($e->getMessage() . ',line:' . $e->getLine() . ',FIle:' . $e->getFile());
            echo "Message could not be sent";
        }
    }
}

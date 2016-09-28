<?php


class Mail {

    private $error;

    public function send($userEmail, $fromEmail, $fromName, $subject, $body) {
        $mail = new PHPMailer;

        if (Config::get('EMAIL_USE_SMTP')) {
            $mail->isSMTP();

            $mail->SMTPDebug = 0;

            $mail->SMTPAuth = Config::get('EMAIL_SMTP_AUTH');

            if (Config::get('EMAIL_SMTP_ENCRYPTION')) {
                $mail->SMTPSecure = Config::get('EMAIL_SMTP_ENCRYPTION');
            }

            $mail->Host = Config::get('EMAIL_SMTP_HOST');
            $mail->Username = Config::get('EMAIL_SMTP_USERNAME');
            $mail->Password = Config::get('EMAIL_SMTP_PASSWORD');
            $mail->Port = Config::get('EMAIL_SMTP_PORT');
        } else {
            $mail->isMail();
        }

        $mail->From = $fromEmail;
        $mail->FromName = $fromName;
        $mail->addAddress($userEmail);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $sentSuccessfully = $mail->send();

        if ($sentSuccessfully) {
            return true;
        } else {
            $this->error = $mail->ErrorInfo;
            return false;
        }
    }

    public function getError() {
        return $this->error;
    }
}
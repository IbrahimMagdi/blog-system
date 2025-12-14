<?php
if(!function_exists('send_mail')){
    /**
     * send mail used to send email addess to users
     * @param array <string> $mails
     * @param string $subject
     * @param string $message
     * @return boolean
     */
    function send_mail(array $mails, string $subject, $message): bool{
        if(config('mail.protocol') == 'smtp'){
            ini_set('SMTP', config('mail.smtp_domain'));
            ini_set('smtp_port', config('mail.smtp_port'));
        }
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: ".config('mail.FROM_ADDRESS'). "\r\n";
        return mail($mails[0], $subject, $message, $headers);
    }
}




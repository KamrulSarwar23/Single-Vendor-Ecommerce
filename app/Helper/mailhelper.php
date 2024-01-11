<?php

namespace App\Helper;

use App\Models\EmailConfig;

class MailHelper
{
    public static function setMailConfig()
    {
        $emailConfig = EmailConfig::first();

        $config = [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => $emailConfig->mail_host,
            'port' => $emailConfig->mail_port,
            'encryption' => $emailConfig->mail_encryption,
            'username' => $emailConfig->smtp_username,
            'password' => $emailConfig->smtp_password,
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ];

        config(['mail.mailers.smtp' => $config]);
        config(['mail.from.address' => $emailConfig->email]);
    }
}

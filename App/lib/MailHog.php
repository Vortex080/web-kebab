<?php

class MailHog
{
    public static function sendMail($to, $subject, $body)
    {
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: kebabamigo@mykebab.com',
            'Reply-To: admin@mailhog.com',
            'Return-Path: admin@mailhog.com',
        );

        $message = '<html><body>';
        $message .= '<h1>' . $subject . '</h1>';
        $message .= $body;
        $message .= '</body></html>';

        return mail($to, $subject, $message, implode("\r\n", $headers));
    }
}

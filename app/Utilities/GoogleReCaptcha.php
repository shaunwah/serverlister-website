<?php

namespace App\Utilities;

class GoogleReCaptcha
{
    public static function validateResponse()
    {
        $url = "https://www.recaptcha.net/recaptcha/api/siteverify";

        $data = [
            'secret' => config('services.google_recaptcha.secret'),
            'response' => request('g-recaptcha-response'),
            'remoteip' => request()->ip(),
        ];

        $options = [
            'http' => [
                'header' => ('Content-type: application/x-www-form-urlencoded' . "\r\n"),
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        return $resultJson->success;
    }
}

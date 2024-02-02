<?php

namespace App\services;

class rechapcaService
{
    public function rechapcaVerification(String $response): bool
    {
        $secretKey = env('RECAPTCHA_SECRET_KEY');
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($data);

        return $result->success === true;
    }
}

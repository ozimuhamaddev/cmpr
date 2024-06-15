<?php

namespace App\Helpers;

class HelperService
{
    public static function myCurl($url, $data = array())
    {
        $fullUrl = env('API_URL') . $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fullUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!empty($data)) {
            $jsonData = json_encode($data, JSON_PRETTY_PRINT);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($jsonData)
                )
            );
        }

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}

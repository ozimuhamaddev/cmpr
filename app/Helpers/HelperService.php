<?php

namespace App\Helpers;

use Log; // Tambahkan baris ini

class HelperService
{
    public static function myCurl($url, $data = array())
    {
        // Get the base URL from environment variables
        $baseUrl = env('API_URL');

        // Check if the base URL is set
        if (!$baseUrl) {
            \Log::error('API_URL is not set in the environment.');
            return null;
        }

        // Construct the full URL
        $fullUrl = $baseUrl . $url;

        // Initialize cURL session
        $ch = curl_init();

        // Set the URL for the cURL request
        curl_setopt($ch, CURLOPT_URL, $fullUrl);

        // Return the response as a string instead of outputting it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // If data is provided, set POST fields and headers
        if (!empty($data)) {
            $jsonData = json_encode($data, JSON_PRETTY_PRINT);

            // Set the POST fields
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

            // Set the HTTP headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData),
            ]);
        }

        // Execute the cURL request
        $result = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            \Log::error('cURL error: ' . $error);
            echo json_encode($error);
            exit;
            curl_close($ch);
            return null;
        }

        // Close the cURL session
        curl_close($ch);

        // Return the result of the cURL request
        return $result;
    }


    public static function myCurlToken($url, $data = array())
    {
        // Get the base URL from environment variables
        $baseUrl = env('API_URL');

        // Check if the base URL is set
        if (!$baseUrl) {
            \Log::error('API_URL is not set in the environment.');
            return null;
        }

        // Construct the full URL
        $fullUrl = $baseUrl . $url;

        // Initialize cURL session
        $ch = curl_init();

        // Set the URL for the cURL request
        curl_setopt($ch, CURLOPT_URL, $fullUrl);

        // Return the response as a string instead of outputting it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // If data is provided, set POST fields and headers
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        // Set the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        // Set the HTTP headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
            'Authorization: Bearer ' . session('token')
        ]);

        // Execute the cURL request
        $result = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return $error;
        }

        // Close the cURL session
        curl_close($ch);

        // Return the result of the cURL request
        return $result;
    }


    public static function sanitizeInput($request, $excludeKeys = [])
    {
        $allInputs = $request->all();
        $inputsToSanitize = [];
        $inputsToExclude = [];

        foreach ($allInputs as $key => $value) {
            if (in_array($key, $excludeKeys)) {
                $inputsToExclude[$key] = Self::cleanScriptTag($value);
            } else {
                $inputsToSanitize[$key] = $value;
            }
        }

        $sanitizedValues = Self::sanitize($inputsToSanitize);
        return array_merge($sanitizedValues, $inputsToExclude);
    }

    public static function sanitize($input)
    {
        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = Self::sanitize($value);
            } else {
                $value = strip_tags($value);
            }
        }

        return $input;
    }

    protected static function cleanScriptTag($input)
    {
        $pattern = "/<script\b[^>]*>(.*?)<\/script>/is";
        $input = preg_replace($pattern, "", $input);
        $input = str_replace(['<script>', '</script>'], '', $input);
        $input = preg_replace('/<([a-z]+[a-z0-9]*)[^>]*?onclick=["\']?alert\(.*?\)["\']?[^>]*?>/i', '<$1>', $input);

        return $input;
    }
}

<?php

namespace app\utils;
use app\services\providers\EnvService;

class EmailUtil
{
    private static function extractApiKey(){
        $envService = new EnvService();
        return $envService->get("ABSTRACT_API_KEY");
    }

    public static function validate($email)
    {
        // Extract API key
        $apiKey = self::extractApiKey();

        // Initialize cURL.
        $ch = curl_init();

        // Set the URL with the actual API key and email.
        curl_setopt($ch, CURLOPT_URL, "https://emailvalidation.abstractapi.com/v1/?api_key=$apiKey&email=$email");

        // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Execute the request.
        $data = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        // Close the cURL handle.
        curl_close($ch);

        // Decode the JSON response
        $response = json_decode($data, true);

        // Check if response is valid
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('JSON decode error: ' . json_last_error_msg());
        }

        // Check required fields in the response
        if (!isset($response['deliverability'], $response['is_valid_format']['value'], $response['is_disposable_email']['value'])) {
            throw new \Exception('Invalid response structure');
        }

        // Extract relevant values
        $wasAutocorrect = $response['autocorrect'];
        $isDeliverable = $response['deliverability'];
        $isValidFormat = $response['is_valid_format']['value'];
        $isDisposable = $response['is_disposable_email']['value'];

        // Return validation result
        return empty($wasAutocorrect) && $isDeliverable === 'DELIVERABLE' && $isValidFormat && !$isDisposable;
    }
}

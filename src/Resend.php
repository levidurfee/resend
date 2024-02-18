<?php

namespace Levi\Resend;

class Resend
{
    private $key;
    private $endpoint = "https://api.resend.com/emails";

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function send($payload)
    {
        $ch = curl_init($this->endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers());
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

    private function headers()
    {
        return [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->key
        ];
    }
}

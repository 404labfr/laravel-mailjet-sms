<?php

return [
    /*
     * MAILJETSMS_ENDPOINT
     */
    'endpoint' => env('MAILJETSMS_ENDPOINT', 'https://api.mailjet.com/v4/sms-send'),

    /*
     * MAILJETSMS_TOKEN
     */
    'token' => env('MAILJETSMS_TOKEN'),

    /*
     * MAILJETSMS_FROM
     */
    'from' => env('MAILJETSMS_FROM'),
];

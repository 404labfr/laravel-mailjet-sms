<?php

namespace Lab404\LaravelMailjetSms;

use Illuminate\Notifications\Notification;

class MailjetSmsChannel
{
    /** @var MailjetSms $client */
    protected $client;

    public function __construct(MailjetSms $client)
    {
        $this->client = $client;
    }

    public function send($notifiable, Notification $notification): bool
    {
        $message = $notification->toMailjetSms($notifiable);

        try {
            $response = $this->client->send($message->message, $message->to, $message->from);

            if ($response->getBody()->getContents()['Status']['Code'] == 2) {
                return true;
            }
        } catch (\Exception $e) {
            unset($e);
        }

        return false;
    }
}

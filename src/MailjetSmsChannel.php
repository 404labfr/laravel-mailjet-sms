<?php

namespace Lab404\LaravelMailjetSms;

use Illuminate\Notifications\Notification;

class MailjetSmsChannel
{
    /** @var MailjetSms $client */
    protected $client;

    /**
     * MailjetSmsChannel constructor.
     * @param MailjetSms $client
     */
    public function __construct(MailjetSms $client)
    {
        $this->client = $client;
    }

    /**
     * @param mixed        $notifiable
     * @param Notification $notification
     * @return bool
     */
    public function send($notifiable, Notification $notification)
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

<?php

namespace Lab404\LaravelMailjetSms;

use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Psr\Http\Message\ResponseInterface;

class MailjetSms
{
    /** @var Application $app */
    protected $app;
    /** @var array $config */
    protected $config = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->loadDefaultOptions();
    }

    protected function loadDefaultOptions(): MailjetSms
    {
        $this->config = $this->app['config']->get('mailjetsms');
        return $this;
    }

    protected function buildHttpClient(): Client
    {
        return new Client([
            'allow_redirects' => false,
            'connect_timeout' => 3,
            'verify' => false,
            'headers' => [
                'User-Agent' => 'LaravelMailjetSms/1.0',
                'Accept' => 'application/json',
                'Content-Type' => 'appliction/json',
                'Authorization' => sprintf('Bearer %s', $this->config['token']),
            ],
            'timeout' => 5,
        ]);
    }

    public function send(string $message, string $to, $from = null): ResponseInterface
    {
        $from = $from ?? $this->config['from'];
        $client = $this->buildHttpClient();

        $response = $client->post($this->config['endpoint'], [
            'json' => [
                'Text' => $message,
                'From' => $from,
                'To' => $to,
            ]
        ]);

        return $response;
    }
}
<?php

namespace Lab404\LaravelMailjetSms;

use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;

class MailjetSms
{
    /** @var Application $app */
    protected $app;
    /** @var array */
    protected $config = [];

    /**
     * MailjetSms constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->loadDefaultOptions();
    }

    /**
     * @return $this
     */
    protected function loadDefaultOptions()
    {
        $this->config = $this->app['config']->get('mailjetsms');
        return $this;
    }

    /**
     * @return Client
     */
    protected function buildHttpClient()
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

    /**
     * @param string $message
     * @param string $to
     * @param string|null $from
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($message, $to, $from = null)
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
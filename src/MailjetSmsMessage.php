<?php

namespace Lab404\LaravelMailjetSms;

class MailjetSmsMessage
{
    /** @var string $message */
    public $message;
    /** @var string $from */
    public $from;
    /** @var string $to */
    public $to;

    /**
     * MailjetSmsMessage constructor.
     * @param string $message
     */
    public function __construct($message = '', $to = '')
    {
        $this->message = $message;
        $this->to = $to;
        $this->from = config('mailjetsms.from');
    }

    /**
     * @param string $message
     * @return self
     */
    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $from
     * @return self
     */
    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @param string $to
     * @return self
     */
    public function to($to)
    {
        $this->to = $to;
        return $this;
    }
}

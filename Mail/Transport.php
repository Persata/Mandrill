<?php

namespace Persata\Mandrill\Mail;

use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Phrase;
use Persata\Mandrill\Model\Api;

class Transport
{
    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * @var Api
     */
    protected $api;

    /**
     * @param MessageInterface $message
     * @param Api $api
     */
    public function __construct(
        MessageInterface $message,
        Api $api
    )
    {
        // Check Type
        if (!$message instanceof Message) {
            throw new \InvalidArgumentException('The message should be an instance of \Persata\Mandrill\Mail');
        }

        $this->message = $message;
        $this->api = $api;
    }

    /**
     * Send Mail via Mandrill
     * @throws MailException
     */
    public function sendMessage()
    {
        try {
            return $this->api->messages->send($this->message->getMessageParams());
        } catch (\Exception $e) {
            throw new MailException(new Phrase($e->getMessage()), $e);
        }
    }
}
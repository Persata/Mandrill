<?php

namespace Persata\Mandrill\Mail;

use Magento\Framework\Mail\MessageInterface;

class Message implements MessageInterface
{

    /**
     * Type for standard 'to'
     */
    const TO_TYPE_TO = 'to';

    /**
     * Type for 'cc'
     */
    const TO_TYPE_CC = 'cc';

    /**
     * Type for 'bcc'
     */
    const TO_TYPE_BCC = 'bcc';

    /**
     * Message type
     *
     * @var string
     */
    protected $messageType = self::TYPE_TEXT;

    /**
     * Message Parameters
     * @var array
     */
    protected $messageParams = array(
        'text'       => null,
        'html'       => null,
        'subject'    => null,
        'from_email' => null,
        'from_name'  => null,
        'to'         => array(),
        'headers'    => array(),
    );

    /**
     * Add Recipient
     * @param $email string
     * @param $name string | null
     * @param $type string
     * @return $this
     */
    protected function _addRecipient($email, $name, $type)
    {
        // Name Given? It's Optional
        if ($name) {
            $recipient = array(
                'email' => $email,
                'name'  => $name,
                'type'  => $type
            );
        } else {
            $recipient = array(
                'email' => $email,
                'type'  => $type
            );
        }
        $this->messageParams['to'][] = $recipient;
        return $this;
    }

    /**
     * Set message subject
     *
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->messageParams['subject'] = $subject;
        return $this;
    }

    /**
     * Get message subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->messageParams['subject'];
    }

    /**
     * Set message body
     *
     * @param mixed $body
     * @return $this
     */
    public function setBody($body)
    {
        if ($this->messageType == self::TYPE_HTML) {
            $this->messageParams['html'] = $body;
        } else {
            $this->messageParams['text'] = $body;
        }
        return $this;
    }

    /**
     * Get message body
     *
     * @return mixed
     */
    public function getBody()
    {
        if ($this->messageType === self::TYPE_HTML) {
            return $this->messageParams['html'];
        } else {
            return $this->messageParams['text'];
        }
    }

    /**
     * Set from address
     *
     * @param string|array $fromAddress
     * @param string|null $fromName
     * @return $this
     */
    public function setFrom($fromAddress, $fromName = null)
    {
        $this->messageParams['from_email'] = $fromAddress;
        $this->messageParams['from_name'] = $fromName;
        return $this;
    }

    /**
     * Add to address
     *
     * @param string|array $toAddress
     * @param string $toName
     * @return $this
     */
    public function addTo($toAddress, $toName = '')
    {
        return $this->_addRecipient($toAddress, $toName, self::TO_TYPE_TO);
    }

    /**
     * Add cc address
     *
     * @param string|array $ccAddress
     * @param string $ccName
     * @return $this
     */
    public function addCc($ccAddress, $ccName = '')
    {
        return $this->_addRecipient($ccAddress, $ccName, self::TO_TYPE_CC);
    }

    /**
     * Add bcc address
     *
     * @param string|array $bccAddress
     * @return $this
     */
    public function addBcc($bccAddress)
    {
        return $this->_addRecipient($bccAddress, null, self::TO_TYPE_BCC);
    }

    /**
     * Set reply-to address
     *
     * @param string|array $replyToAddress
     * @return $this
     */
    public function setReplyTo($replyToAddress)
    {
        $this->messageParams['headers'] = array(
            'Reply-To' => $replyToAddress
        );
        return $this;
    }

    /**
     * Set message type
     *
     * @param string $type
     * @return $this
     */
    public function setMessageType($type)
    {
        $this->messageType = $type;
        return $this;
    }

    /**
     * Get Message Params
     * @return array
     */
    public function getMessageParams()
    {
        return $this->messageParams;
    }
}
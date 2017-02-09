<?php

namespace Astrotomic\Notifynder\Senders;

use Twilio\Rest\Client;
use Fenos\Notifynder\Traits\SenderCallback;
use Fenos\Notifynder\Contracts\SenderContract;
use Fenos\Notifynder\Contracts\SenderManagerContract;
use Astrotomic\Notifynder\Senders\Messages\SmsMessage;

class TwilioSender implements SenderContract
{
    use SenderCallback;

    /**
     * @var array
     */
    protected $notifications;

    /**
     * @var array
     */
    protected $config;

    /**
     * TwilioSender constructor.
     *
     * @param array $notifications
     */
    public function __construct(array $notifications)
    {
        $this->notifications = $notifications;
        $this->config = notifynder_config('senders.twilio');
    }

    public function send(SenderManagerContract $sender)
    {
        $sid = $this->config['sid'];
        $token = $this->config['token'];
        $store = $this->config['store'];
        $callback = $this->getCallback();
        $client = new Client($sid, $token);
        foreach ($this->notifications as $notification) {
            $sms = call_user_func($callback, new SmsMessage(), $notification);
            $client->messages->create(
                $sms->getRecipient(),
                [
                    'from' => $sms->getOriginator(),
                    'body' => $sms->getBody(),
                ]
            );
        }

        if ($store) {
            return $sender->send($this->notifications);
        }

        return true;
    }
}

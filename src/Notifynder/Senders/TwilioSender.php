<?php

namespace Astrotomic\Notifynder\Senders;

use Astrotomic\Notifynder\Senders\Messages\SmsMessage;
use Fenos\Notifynder\Contracts\SenderContract;
use Fenos\Notifynder\Contracts\SenderManagerContract;
use Twilio\Rest\Client;

class TwilioSender implements SenderContract
{
    /**
     * @var array
     */
    protected $notifications;

    /**
     * TwilioSender constructor.
     *
     * @param array $notifications
     */
    public function __construct(array $notifications)
    {
        $this->notifications = $notifications;
    }

    public function send(SenderManagerContract $sender)
    {
        $sid = config('notifynder.senders.twilio.sid');
        $token = config('notifynder.senders.twilio.token');
        $store = config('notifynder.senders.twilio.store', false);
        $callback = config('notifynder.senders.twilio.callback');
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

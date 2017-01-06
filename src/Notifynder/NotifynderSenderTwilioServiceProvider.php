<?php

namespace Astrotomic\Notifynder;

use Astrotomic\Notifynder\Senders\MessageBirdSmsSender;
use Astrotomic\Notifynder\Senders\MessageBirdVoiceSender;
use Astrotomic\Notifynder\Senders\TwilioSender;
use Illuminate\Support\ServiceProvider;

class NotifynderSenderMessageBirdServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        app('notifynder')->extend('sendTwilio', function (array $notifications) {
            return new TwilioSender($notifications);
        });
    }
}

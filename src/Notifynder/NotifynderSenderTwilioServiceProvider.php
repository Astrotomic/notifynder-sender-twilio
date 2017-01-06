<?php

namespace Astrotomic\Notifynder;

use Illuminate\Support\ServiceProvider;
use Astrotomic\Notifynder\Senders\TwilioSender;

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

# Notifynder 4 Twilio Sender - Laravel 5

[![GitHub release](https://img.shields.io/github/release/astrotomic/notifynder-sender-twilio.svg?style=flat-square)](https://github.com/astrotomic/notifynder-sender-twilio/releases)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/astrotomic/notifynder-sender-twilio/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/astrotomic/notifynder-sender-twilio.svg?style=flat-square)](https://github.com/astrotomic/notifynder-sender-twilio/issues)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/notifynder-sender-twilio.svg?style=flat-square)](https://packagist.org/packages/astrotomic/notifynder-sender-twilio)

[![StyleCI](https://styleci.io/repos/78197904/shield)](https://styleci.io/repos/78197904)

[![Code Climate](https://img.shields.io/codeclimate/github/Astrotomic/notifynder-sender-twilio.svg?style=flat-square)](https://codeclimate.com/github/Astrotomic/notifynder-sender-twilio)

[![Slack Team](https://img.shields.io/badge/slack-astrotomic-orange.svg?style=flat-square)](https://astrotomic.slack.com)
[![Slack join](https://img.shields.io/badge/slack-join-green.svg?style=social)](https://notifynder.signup.team)


Documentation: **[Notifynder Docu](http://notifynder.info)**

-----

## Installation

### Step 1

```
composer require astrotomic/notifynder-sender-twilio
```

### Step 2

Add the following string to `config/app.php`

**Providers array:**

```
Astrotomic\Notifynder\NotifynderSenderTwilioServiceProvider::class,
```

### Step 3

Add the following array to `config/notifynder.php`

```php
'senders' => [
    'twilio' => [
        'sid' => '',
        'token' => '',
        'callback' => function(\Astrotomic\Notifynder\Senders\Messages\SmsMessage $message, \Fenos\Notifynder\Models\Notification $notification) {
            return $message
                ->from(...)
                ->to(...)
                ->body($notification->getText());
        }
        'store' => false, // wether you want to also store the notifications in database
    ],
],
```
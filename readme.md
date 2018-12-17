# Laravel Mailjet SMS

Ce plugin vous permet d'envoyer des SMS et des notifications SMS via [Mailjet](https://www.mailjet.com/sms/) depuis votre application Laravel. 
Attention, Mailjet autorise uniquement les SMS transactionnels.

## Sommaire

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Notifications](#notifications)
- [Support](#support)
- [Auteur](#auteur)
- [Licence](#licence)

## Requirements

- PHP >= 7
- Laravel 5.3 à Laravel 5.7
- Un compte Mailjet avec un token SMS

## Installation

- Installation via composer :  
```bash
composer require lab404/laravel-mailjet-sms
```

- (Facultatif) Ajoutez le ServiceProvider dans **config/app.php** :  
```php
Lab404\LaravelMailjetSms\ServiceProvider::class,
```

- (Facultatif) Publiez le fichier de config **mailjetsms** :  
```bash
php artisan vendor:publish --provider="Lab404\LaravelMailjetSms\ServiceProvider"
```

- Configurez le plugin dans votre `.env` (ou le fichier de config)
```
MAILJETSMS_TOKEN="Votre token Mailjet"
MAILJETSMS_FROM="Numéro de tel au format E.164"
```

## Usage

Envoyer un SMS :
```php
// Globalement
app('mailjetsms')->send("Elle est où la poulette ?", "+33610203040");

// DI
public function myMethod(\Lab404\LaravelMailjetSms\MailjetSms $mailjet) {
    $mailjet->send("C'est pas faux", "+33610203040");  
}
```

## Notifications

Ce plugin est compatible avec les [notifications Laravel](https://laravel.com/docs/5.7/notifications).

```php
namespace App\Notifications;

use Lab404\LaravelMailjetSms\FreeMobileChannel;
use Lab404\LaravelMailjetSms\FreeMobileMessage;
use Illuminate\Notifications\Notification;

class ExampleNotification extends Notification
{
    public function via($notifiable)
    {
        return [FreeMobileChannel::class];
    }
    
    public function toMailjetSms($notifiable)
    {
    	return new MailjetSmsMessage(
    	    "C'est ça que vous appelez une fondue ?", 
    	    $notifiable->phonenumber
        );
    }
}
```

## Support

N'hésitez pas à utiliser le gestion d'issus pour vos retours.

## Auteur

[Marceau Casals](https://www.404lab.fr)

## Licence

MIT
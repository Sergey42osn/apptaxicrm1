<?php

namespace App\Notifications\Drivers;

use App\User;
use App\Driver;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class UserResetPwdDriverEmail extends Notification
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //dd($notifiable);

       // dd($notifiable->user()->id_driver);

        $id_driver = $notifiable->id_driver;

        $driver = Driver::findOrFail($id_driver);

        $pin = $driver->resetPwd();

       // $pwd = $driver->

        return (new MailMessage)
            ->subject(Lang::get('email.subjectreset'))
            ->view(
            'emails.drivers.pwdreset', [
                'login' => $id_driver,
                'pwd'   => $pin,
                ]
            );

        return (new MailMessage)
        ->subject(Lang::get('email.subjectreset'))
        ->line(Lang::get('email.login').': '. $id_driver)
        ->line('If you did not request a password reset, no further action is required.');
    }

     protected function verificationUrl($notifiable)
    {
         // collect and sort url params
        $params = [
            'expires' => Carbon::now()
                ->addMinutes(Config::get('auth.verification.expire', 60))
                ->getTimestamp(),
            'id' => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ];
        ksort($params);

        // then create API url for verification. my API have `/api` prefix,
        // so i don't want to show that url to users 
        $url = url('api/v1/email/verify/' . $params['id'] . '/'. $params['hash'] . '?expires=' .$params['expires']);

        // get APP_KEY from config and create signature
        $key = config('app.key');
        $signature = hash_hmac('sha256', $url, $key);

        return url($url)  . '&signature='.$signature;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

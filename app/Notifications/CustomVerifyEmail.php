<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
                    ->subject(Lang::get('email.subjectconfirm'))
                    ->line('The introduction to the notification.')
                    ->action(Lang::get('email.confirmtextbutton'), url($verificationUrl))
                    ->line('Thank you for using our application!');
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

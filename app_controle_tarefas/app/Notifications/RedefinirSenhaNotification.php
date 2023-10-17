<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
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
        $url = 'http://localhost:8000/password/reset/'. 
            $this->token. 
            '?email=' .$this->email. 
            '?name='. $this->name;
        $minutos = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        $saudacao = 'Olá ' . $this->name;
        return (new MailMessage)
            ->subject('Atualização de Senha')
            ->greeting($saudacao)
            ->line('Você recebeu esse email, pois recebemos uma solitação de atualização para sua conta.')
            ->action('Atualizar a Senha', $url)
            ->line('O link dessa solicitção expira em '.$minutos.' minutos.')
            ->line('Se você não solicitou a atualização, nenhuma ação é necessária.')
            ->salutation('Até breve!');
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

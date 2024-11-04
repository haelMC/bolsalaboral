<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsuarioAprobado extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Tu cuenta ha sido aprobada')
                    ->greeting('¡Hola ' . $notifiable->name . '!')
                    ->line('Nos complace informarte que tu cuenta ha sido aprobada.')
                    ->line('Ahora puedes acceder a nuestra plataforma y disfrutar de todos los beneficios.')
                    ->action('Iniciar sesión', url('/login'))
                    ->line('Gracias por unirte a nuestra plataforma.');
    }
}

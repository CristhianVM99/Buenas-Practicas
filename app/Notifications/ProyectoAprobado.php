<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\IdeaProyecto;

class ProyectoAprobado extends Notification
{
    use Queueable;

    public $tipo;
    public $id = 0;
    public $titulo = "";
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $proyecto)
    {
        $this->tipo     = $proyecto['tipo']? $proyecto['tipo'] :"Buena Practica";
        $this->id       = $proyecto['id'];
        $this->titulo   = $proyecto['titulo'];
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
        return (new MailMessage)
                    ->subject($this->tipo.' Aprobada!')
                    ->greeting($this->tipo.' Aprobada!')
                    ->line('Tu '.$this->tipo.' fue aprobada y ya se encuentra publicada en el sitio web.')
                    ->line('Riega tu '.$this->tipo.' compartiendola')
                    // ->action($this->titulo, route('post', ['proyecto' =>$this->id]))
                    ->action('Compartir en Facebook', "https://www.facebook.com/sharer/sharer.php?u=".route('post', ['proyecto' =>$this->id]))
                    ->salutation('Saludos');
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

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordParticipants extends Mailable
{
    use Queueable, SerializesModels;

    public $fromAddress;
    public $data; // Ajoutez ce champs pour passer des données supplémentaires si besoin

    /*
     * Create a new message instance.
     */
    public function __construct($fromAddress, $data = [])
    {
        $this->fromAddress = $fromAddress;
        $this->data = $data; // Initialisez avec un tableau vide si vous n'avez pas de données
    }

    /*
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromAddress)
            ->subject('Information d\'admision')
            ->markdown('emails.markdown-password', ['data' => $this->data]);
    }
}

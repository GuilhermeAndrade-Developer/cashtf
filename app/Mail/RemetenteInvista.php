<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemetenteInvista extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('business@cashtf.com','CashTF')
                    ->subject("Invista CashTF")
                    ->markdown('email.remetente_invista')
                    ->with([
                        'name' => 'New Mailtrap User',
                        'link' => 'https://mailtrap.io/inboxes'
                    ]);
    }
}


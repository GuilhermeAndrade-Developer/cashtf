<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class NovoUsuario extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('business@cashtf.com', 'CashTF')
            ->subject('Novo Cliente')
            ->markdown('email.novo_cliente')
            ->with([
                'name' => 'New Mailtrap User',
                'link' => 'https://mailtrap.io/inboxes'
            ]);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Oferta;

class OfertNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $oferta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Oferta $oferta)
    {
        $this->oferta = $oferta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@cifopop.com')->subject('Nueva oferta')->view('emails.ofertNotification');
    }
}

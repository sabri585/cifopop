<?php

namespace App\Listener;

use App\Events\OfertCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfertNotification;

class SendCreatedOfertaEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OfertCreated  $event
     * @return void
     */
    public function handle(OfertCreated $event)
    {
        //enviar email al usuario propietario del anuncio
        //avisando que tiene una nueva oferta
        Mail::to($event->user->email)->send(new OfertNotification($event->oferta));
    }
}

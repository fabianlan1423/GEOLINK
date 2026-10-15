<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje;
    public $codigo;

    public function __construct($mensaje, $codigo)
    {
        $this->mensaje = $mensaje;
        $this->codigo = $codigo;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Código de recuperación GEOLINK',
        );
    }

    public function build()
    {
        return $this->text('emails.texto')
            ->with([
                'mensaje' => $this->mensaje,
                'codigo' => $this->codigo,
            ]);
    }
}
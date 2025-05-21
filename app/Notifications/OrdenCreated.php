<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url('/orders/' . $this->order->id);

        return (new MailMessage)
            ->subject('Pizza Hat - Confirmación de Pedido #' . $this->order->order_number)
            ->greeting('¡Gracias por tu pedido!')
            ->line('Hemos recibido tu pedido correctamente y lo estamos procesando.')
            ->line('Número de pedido: ' . $this->order->order_number)
            ->line('Total: $' . number_format($this->order->total, 2))
            ->action('Ver detalles del pedido', $url)
            ->line('¡Gracias por elegir Pizza Hat!');
    }
}
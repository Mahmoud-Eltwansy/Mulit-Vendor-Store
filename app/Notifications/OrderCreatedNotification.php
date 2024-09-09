<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    protected $order, $addr;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->addr = $this->order->billingAddress;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
        //return ['mail', 'database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
            ->subject("New Order #{$this->order->number}")
            //->from('twansy@gmail.com','Mahmoud Store') , If you want to change from address which is placed in the .env file , If you didn't write it , it will use the default from .env
            ->greeting("Hi {$notifiable->name},")
            ->line("A new order (#{$this->order->number}) created by {$this->addr->name} from {$this->addr->country_name}.")
            ->action('View Order', url('/dashboard'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'body' => "A new order (#{$this->order->number}) created by {$this->addr->name} from {$this->addr->country_name}.",
            'icon'=>'fa-shopping-cart',
            'url' => url('/dashboard'),
            'order_id' => $this->order->id
        ];
    }

    public function toBroadcast(object $notifiable){
        return new BroadcastMessage([
            'body' => "A new order (#{$this->order->number}) created by {$this->addr->name} from {$this->addr->country_name}.",
            'icon'=>'fa-shopping-cart',
            'url' => url('/dashboard'),
            'order_id' => $this->order->id
        ]);
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Listeners;

use App\Repositories\Cart\CartRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Product;

class DeductProductQuantity
{
    public $cartRepository;
    /**
     * Create the event listener.
     */
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        try {
            $order = $event->order;
            foreach ($order->products as $item) {
                $item->decrement('quantity', $item->pivot->quantity);
            }
        } catch (\Exception $e) {
        }
    }
}

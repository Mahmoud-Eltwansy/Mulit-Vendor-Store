<?php

namespace App\Listeners;

use App\Repositories\Cart\CartRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmptyCart
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
        $this->cartRepository->empty();
    }
}

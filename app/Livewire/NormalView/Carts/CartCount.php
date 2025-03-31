<?php

namespace App\Livewire\NormalView\Carts;

use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{
    #[On('addTocartRefresh')]
    public function cartCounts() {

        $cartCounts = Cart::where('user_id', auth()?->id())->count();

        return compact('cartCounts');
    }
    public function render()
    {
        return view('livewire.normal-view.carts.cart-count', $this->cartCounts());
    }
}

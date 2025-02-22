<?php

namespace App\Livewire\NormalView\Pages;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Title("Home")]

    public $productView;
    public $morning;
    public $afternoon;
    public $evening;

    public function essentialItems()
    {
        $topDeals = Product::orderBy('product_sold', 'desc')
            ->whereNotIn('product_sold', [0])
            ->take(10)
            ->get();
        $popularityDeals = Product::orderBy('product_votes', 'desc')
            ->whereNotIn('product_votes', [0])
            ->take(10)
            ->get();
        $latestProducts = Product::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $allLocations = User::all();

        return compact('topDeals', 'popularityDeals', 'latestProducts', 'allLocations');
    }

    public function mount()
    {
        $time = now()->format('H');

        $this->morning = $time >= 0 && $time < 12;
        $this->afternoon = $time >= 12 && $time < 18;
        $this->evening = $time >= 18 && $time <= 23;
    }


    public function view($id)
    {
        $this->productView = Product::find($id);
    }

    #[On('closedModal')]
    public function closedModal()
    {
        $this->productView = null;
    }

    public function addToFavorite($id)
    {
        $productFav = Product::findOrFail($id);

        $added = Favorite::where(['user_id' => auth()->user()->id, 'product_id' => $productFav->id, 'status' => true])->first();

        if ($added) {
            $added->delete();
            $this->dispatch('toastr', data: [
                'type'      =>      'success',
                'message'   =>      'Removed from favorites'
            ]);
            return;
        } else {
            Favorite::create([
                'user_id'           =>      auth()->user()->id,
                'product_id'        =>      $productFav->id,
                'status'            =>      true
            ]);

            $this->dispatch('toastr', data: [
                'type'      =>      'success',
                'message'   =>      'Added to favorites'
            ]);
            return;
        }
    }

    public function render()
    {
        return view('livewire.normal-view.pages.home', $this->essentialItems());
    }
}

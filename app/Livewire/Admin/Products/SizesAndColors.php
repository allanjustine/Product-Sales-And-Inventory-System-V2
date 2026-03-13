<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class SizesAndColors extends Component
{
    #[Title("Size & Color Management")]

    public $product;
    public $size_stock = 0;
    public $size_name = "";
    public $color_stock = 0;
    public $color_name = "";
    public $is_edit_color = false;
    public $is_edit_size = false;
    public $size = null;
    public $color = null;

    public function mount(Product $product)
    {
        $this->product = $product->load(['productSizes', 'productColors']);
    }

    public function submitSize()
    {
        $this->validate([
            'size_name'  => ['required', 'string', 'min:1', 'max:50', Rule::unique('product_sizes', 'name')->where('product_id', $this->product->id)],
            'size_stock' => ['required', 'numeric', 'min:1', 'max:999999'],
        ]);

        $this->product->productSizes()->create([
            'name'  => Str::lower($this->size_name),
            'stock' => $this->size_stock
        ]);

        $this->reset(['size_name', 'size_stock']);

        $this->dispatch('alert', alerts: [
            'title'   => "Size Added",
            'type'    => "success",
            'message' => "New size added successfully"
        ]);
    }

    public function submitColor()
    {
        $this->validate([
            'color_name'  => ['required', 'string', 'min:1', 'max:50', Rule::unique('product_colors', 'name')->where('product_id', $this->product->id)],
            'color_stock' => ['required', 'numeric', 'min:1', 'max:999999'],
        ]);

        $this->product->productColors()->create([
            'name'  => Str::lower($this->color_name),
            'stock' => $this->color_stock
        ]);

        $this->reset(['color_name', 'color_stock']);

        $this->dispatch('alert', alerts: [
            'title'   => "Color Added",
            'type'    => "success",
            'message' => "New color added successfully"
        ]);
    }

    public function removeSize(ProductSize $size)
    {
        $size->delete();

        $this->dispatch('alert', alerts: [
            'title'   => "Size Removed",
            'type'    => "success",
            'message' => "{$size->name} removed successfully"
        ]);
    }

    public function removeColor(ProductColor $color)
    {
        $color->delete();

        $this->dispatch('alert', alerts: [
            'title'   => "Color Removed",
            'type'    => "success",
            'message' => "{$color->name} removed successfully"
        ]);
    }

    public function editSize(ProductSize $size)
    {
        $this->is_edit_size = true;
        $this->size_name = $size->name;
        $this->size_stock = $size->stock;
        $this->size = $size;
    }

    public function editColor(ProductColor $color)
    {
        $this->is_edit_color = true;
        $this->color_name = $color->name;
        $this->color_stock = $color->stock;
        $this->color = $color;
    }

    public function updateSize()
    {
        $this->validate([
            'size_name'  => ['required', 'string', 'min:1', 'max:50', Rule::unique('product_sizes', 'name')->ignore($this->size->id)],
            'size_stock' => ['required', 'numeric', 'min:1', 'max:999999'],
        ]);

        $this->size->update([
            'name'  => Str::lower($this->size_name),
            'stock' => $this->size_stock
        ]);

        $this->is_edit_size = false;

        $this->reset(['size_name', 'size_stock']);

        $this->dispatch('alert', alerts: [
            'title'   => "Size Updated",
            'type'    => "success",
            'message' => "Size updated successfully"
        ]);
    }

    public function updateColor()
    {
        $this->validate([
            'color_name'  => ['required', 'string', 'min:1', 'max:50', Rule::unique('product_colors', 'name')->ignore($this->color->id)],
            'color_stock' => ['required', 'numeric', 'min:1', 'max:999999'],
        ]);

        $this->color->update([
            'name'  => Str::lower($this->color_name),
            'stock' => $this->color_stock
        ]);

        $this->is_edit_color = false;

        $this->reset(['color_name', 'color_stock']);

        $this->dispatch('alert', alerts: [
            'title'   => "Color Added",
            'type'    => "success",
            'message' => "Color updated successfully"
        ]);
    }

    public function cancelSizeEdit()
    {
        $this->is_edit_size = false;
        $this->reset(['size_name', 'size_stock']);
    }

    public function cancelColorEdit()
    {
        $this->is_edit_color = false;
        $this->reset(['color_name', 'color_stock']);
    }

    public function render()
    {
        return view('livewire.admin.products.sizes-and-colors');
    }
}

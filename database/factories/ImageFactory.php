<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $product_images = [
            'https://images.unsplash.com/photo-1582900125020-4d314f8a5de8?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fFJlc3RhdXJhbnQlMjBwcm9kdWN0fGVufDB8fDB8fHww',
            'https://images.unsplash.com/photo-1653286015629-8374ed4c9783?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fFJlc3RhdXJhbnQlMjBwcm9kdWN0fGVufDB8fDB8fHww',
            'https://images.unsplash.com/photo-1655115287944-6e23b2a36d08?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fFJlc3RhdXJhbnQlMjBwcm9kdWN0fGVufDB8fDB8fHww',
            'https://plus.unsplash.com/premium_photo-1661479328777-e1692d224ae6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8UmVzdGF1cmFudCUyMHByb2R1Y3R8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1653286017713-f911067e94d1?q=80&w=1527&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?q=80&w=715&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1581655353564-df123a1eb820?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8amFja2V0c3xlbnwwfHwwfHx8MA%3D%3D',
            'https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8amFja2V0c3xlbnwwfHwwfHx8MA%3D%3D',
            'https://images.unsplash.com/photo-1706765779494-2705542ebe74?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fGphY2tldHN8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvcnRzfGVufDB8fDB8fHww',
            'https://media.istockphoto.com/id/156874059/photo/beige-cargo-shorts-with-belt.webp?a=1&b=1&s=612x612&w=0&k=20&c=xpmL-HUhWZnPjGWapk-blEKT6Yc2RypLFpZ5kuTZapI=',
            'https://media.istockphoto.com/id/695708092/photo/one-short-blue-jeans-isolated-on-white.webp?a=1&b=1&s=612x612&w=0&k=20&c=FduTyaKpSD6tK90V0jCH9-9KFGb3Csy26U9pJjL7HEw=',
            'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8UGFudHN8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8UGFudHN8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1718252540617-6ecda2b56b57?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8UGFudHN8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8U2hvZXN8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1543508282-6319a3e2621f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8U2hvZXN8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1539185441755-769473a23570?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fFNob2VzfGVufDB8fDB8fHww',
            'https://media.istockphoto.com/id/2154756656/photo/template-blank-flat-black-hoodie-top-view-isolated-on-white-background.webp?a=1&b=1&s=612x612&w=0&k=20&c=2s6pHWh-8ilz-4VAldiX7WghksVMcO93CBbb_Kui9QQ=',
            'https://media.istockphoto.com/id/154960461/photo/red-sweat-shirt-on-white-background.webp?a=1&b=1&s=612x612&w=0&k=20&c=Dt1h6jsUfwyJolpalOYanvF5kG6VTWhjDI1zVcbdYJY=',
        ];

        return [
            'path' => $this->faker->randomElement($product_images),
            'imageable_type' => Product::class,
            'imageable_id' => $this->faker->numberBetween(1, 500),
        ];
    }
}

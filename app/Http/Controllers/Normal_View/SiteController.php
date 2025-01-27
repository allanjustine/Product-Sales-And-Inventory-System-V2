<?php

namespace App\Http\Controllers\Normal_View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function contact()
    {
        return view('pages.normal-view.pages.contact');
    }
    public function about()
    {
        return view('pages.normal-view.pages.about');
    }
    public function profile()
    {
        return view('pages.normal-view.pages.profile');
    }
    public function home()
    {
        return view('pages.normal-view.pages.home');
    }
    // public function myCart()
    // {
    //     return view('pages.normal-view.carts.index');
    // }
    public function viewProducts()
    {
        if (auth()->check()) {
            alert()->warning('Opsss', 'You are already login.');

            return back();
        }
        return view('pages.normal-view.products.view-only');
    }
    public function product()
    {
        return view('pages.normal-view.products.index');
    }
    public function order()
    {
        return view('pages.normal-view.orders.index');
    }
    public function recentOrder()
    {
        return view('pages.normal-view.orders.recent-orders');
    }
    /**
     * Display a listing of the resource.
     */
    public function favorite()
    {
        return view('pages.normal-view.favorites.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

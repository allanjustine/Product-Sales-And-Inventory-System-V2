<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function dashboard()
    {
        return view('pages.admin.pages.dashboard');
    }
    public function user()
    {
        return view('pages.admin.users.user');
    }
    public function profile()
    {
        return view('pages.admin.pages.profile');
    }
    public function about()
    {
        return view('pages.admin.pages.about');
    }
    public function contact()
    {
        return view('pages.admin.pages.contact');
    }
    public function product()
    {
        return view('pages.admin.products.index');
    }
    public function category()
    {
        return view('pages.admin.product-categories.index');
    }
    public function order()
    {
        return view('pages.admin.orders.index');
    }
    public function productSales()
    {
        return view('pages.admin.orders.product-sales');
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

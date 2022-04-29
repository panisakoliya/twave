<?php

namespace App\Http\Controllers;

use App\DataTables\UserDatatable;
use App\Models\Category;
use App\Models\Hero;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $users = User::role('user')->get();
        $categories = Category::all();
        $products = Product::all();
        $heros = Hero::all();

        return view('dashboard', compact('users', 'categories', 'products', 'heros'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        return view('admin.roles.index');
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            if (Str::contains($route->getName(), 'admin') && count(explode('.', $route->getName())) > 2 && !in_array(explode('.', $route->getName())[2], ['create', 'edit'])) {
                $listRouteName[] = $route->getname();
            }
        }
        // dd($listRouteName);
        $groupedRoutes =  collect($listRouteName)->groupBy(function ($route) {
            return explode('.', $route)[1];
        });
        dd($groupedRoutes);
    }
    public function test2(Request $request)
    {
        dd($request->all());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $user = User::find(3);
        // return $user->roles()->attach([1]);
        // return view('admin.roles.index');
        // $routes = Route::getRoutes();
        // foreach ($routes as $route) {
        //     if (Str::contains($route->getName(), 'admin') && count(explode('.', $route->getName())) > 2 && !in_array(explode('.', $route->getName())[2], ['create', 'edit'])) {
        //         $listRouteName[] = $route->getname();
        //     }
        // }
        // dd($listRouteName);
        // $listPermissions = Permission::pluck('name')->toArray();
        // Permission::destroy($listPermissions);
        // dd($listPermissions);
        // foreach($listRouteName as $route){
        //     if(!in_array($route,$listPermissions)) Permission::create(['name'=>$route]);
        // }
        // return 'đã thêm các quyền thành công';
        // dd($listRouteName);
        // $groupedRoutes =  collect($listRouteName)->groupBy(function ($route) {
        //     return explode('.', $route)[1];
        // });
        // dd($groupedRoutes);
    }
    public function test2(Request $request)
    {
        dd($request->all());
    }
}

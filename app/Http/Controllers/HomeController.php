<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
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
        
        // //destroy permission demo
        // $listPermissionId = Permission::pluck('id')->toArray();
        // Permission::destroy($listPermissionId);

        // //query Permissions
        // $routes = Route::getRoutes();
        // foreach ($routes as $route) {
        //     if (Str::contains($route->getName(), 'admin') && count(explode('.', $route->getName())) > 2 && !in_array(explode('.', $route->getName())[2], ['create', 'edit'])) {
        //         $listRouteName[] = $route->getname();
        //     }
        // }
        // $listPermissions = Permission::pluck('name')->toArray();
        // foreach($listRouteName as $route){
        //     if(!in_array($route,$listPermissions)) Permission::create(['name'=>$route]);
        // }
        
        // create role Super Admin
        // $roleSuperAdmin = Role::create(['name'=>'Super Admin']);
        // $allPermissionId = Permission::pluck('id')->toArray();
        
        // $user = User::find();
        
        
    }

    public function test2(Request $request)
    {
        dd($request->all());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;


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
        return view('admin.dashboard');
    }

    public function reset(Request $request)
    {
        
        //Lấy user sẽ được cấp quyền super admin
        // $user = User::find($request->id);
         
        // if(!$user) return 'Cần Có Một admin được tạo trước để chỉ định là superAdmin';

        // //destroy all permission 
        // $listPermissionId = Permission::pluck('id')->toArray();
        // Permission::destroy($listPermissionId);

        // //create  all Permissions

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

        // $user = User::find(3);
        // dd($user->checkPermission('admin'));

        // return $user->checkPermission('admin');

        // //destroy all Role
        // $listRole = Role::pluck('id')->toArray();
        // Role::destroy($listRole);
        // Role::find(1) -> permissions()->sync(Permission::pluck('id')->toArray());
        // // create role Super Admin
        // $roleSuperAdmin = Role::create(['name'=>'Super Admin']);
        // $allPermissionId = Permission::pluck('id')->toArray();
            // dd(Role::find(1)->permissions()->attach);
            // Role::find(1)->permissions()->sync(Permission::pluck('id')->toArray());
        // $user = $user->roles()->attach([$roleSuperAdmin->id]);
    }

    public function test2(Request $request)
    {
        if (! Gate::allows('admin.abc.index')) {
            abort(403);
        }
        return 'okokko';
    }
}

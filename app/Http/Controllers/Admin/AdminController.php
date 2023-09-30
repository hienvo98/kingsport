<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function authorizeUser(Request $request)
    {
        if (!Gate::allows('Super Admin')) {
            abort(403);
        }
        $request->validate(
            [
                'user' => 'required',
                'role' => 'required'
            ],
            [
                'user.required' => 'Vui lòng chọn admin cần cấp quyền',
                'role.required' => 'Vui lòng chọn quyền cần cấp'
            ]
        );
        dd($request->all());
        $user = User::find($request->user);
        if (in_array($request->role, $user->roles->pluck('id')->toArray())) return redirect()->back()->with('error', 'admin đã được cấp quyền này');

        $user->roles()->attach($request->role);
        return redirect()->back()->with('status', 'đã cấp quyền cho admin thành công');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('Super Admin')) {
            abort(403);
        }
        $roles = Role::where('name', '<>', 'Super Admin')->get();
        return view('admin.members.createAdmin', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('Super Admin')) {
            abort(403);
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // return $request->role;
        $user = User::create($request->all());
        if (!empty($request->role)) $user->roles()->attach($request->role);
        return redirect()->back()->with('status', 'đã tạo admin thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        if (!Gate::allows('Super Admin')) {
            abort(403);
        }

        $usersWithoutRoles = User::whereDoesntHave('roles')->where('is_admin', '=', '1')->withTrashed()->get();
        $usersWithoutSuperAdmin = User::withTrashed()
            ->with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', '<>', 'super admin');
            })
            ->where('is_admin', '=', '1')->get();
        
        $users = $usersWithoutRoles->merge($usersWithoutSuperAdmin);;
        return view('admin.members.index', compact('users'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    public function editRole(string $id)
    {
        if (!Gate::allows('Super Admin')) {
            abort(403);
        }
        $user = User::find($id);
        $roles = Role::whereNotIn('name', ['Super Admin'])->get();
        return view('admin.members.editRole', compact('user', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('Super Admin')) {
            abort(403);
        }
    }

    public function updateRole(Request $request)
    {
        if (!Gate::allows('Super Admin')) {
            abort(403);
        }
        User::find($request->user)->roles()->sync($request->role);
        return redirect()->back()->with('status','đã cập nhật thành công');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Gate::allows('Super Admin')) {
            abort(403);
        }
        User::find($id)->delete();
        return response()->json([
            'code' => 200,
            'data' => 'ok'
        ]);
    }
    public function restore($id)
    {
        if (!Gate::allows('Super Admin')) {
            abort(403);
        }
        User::onlyTrashed()->find($id)->restore();
        return response()->json([
            'code' => 200,
            'data' => 'ok'
        ]);
    }
    public function search($id)
    {
        // $roles = User::find($id)->roles->map(function($role){
        //     return  "<option selected value='$role->id'>$role->name</option>";
        // });
        $roles = User::find($id)->roles->pluck('id');
        return response()->json([
            'code'=>200,
            'data'=>$roles
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}

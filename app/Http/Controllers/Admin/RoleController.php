<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('Super Admin')) {
            abort(403);
        }

        $roles = Role::where('name', '<>', 'Super Admin')->get();
        $users = User::where('id', '<>', Auth::id())->get();
        return view('admin.roles.index',compact('roles','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('Super Admin')) {
            abort(403);
        }
        $permissions = Permission::all()->groupBy(function ($per) {
            return explode('.', $per->name)[1];
        });
        // return $permissions;
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('Super Admin')) {
            abort(403);
        }
        $request->validate(
            [
                'name' => 'required|unique:roles,name',
                'permission' => 'required'
            ],
            [
                'name.required' => 'Tên Quyền không được để trống',
                'name.unique' => 'Tên quyền đã tồn tại',
                'permission.required' => 'Vui lòng chọn ít nhất 1 quyền',
            ]
        );
        $role = Role::create(['name' => $request->name]);
        $role->permissions()->attach($request->permission);
        return redirect()->back()->with('status', 'Đã tạo quyền thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (! Gate::allows('Super Admin')) {
            abort(403);
        }
        $roles = Role::where('name','<>','Super Admin')->get();
        return view('admin.roles.show',compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (! Gate::allows('Super Admin')) {
            abort(403);
        }
        $role = Role::find($id);
        if(!$role) return view('auth.404');
        $permissions = Permission::all()->groupBy(function($per){
            return explode('.',$per)[1];
        });
        $listPerRole = $role->permissions->pluck('id')->toArray();
        
        return view('admin.roles.edit',compact('role','permissions','listPerRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if (! Gate::allows('Super Admin')) {
            abort(403);
        }
        $role = Role::find($request->role);
        $role->update(['name'=>$request->name]);
        $role->permissions()->sync($request->permission);
        return redirect() -> back() -> with('status','Đã Cập Nhật Quyền Thành Công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (! Gate::allows('Super Admin')) {
            abort(403);
        }
        $role = Role::find($id)->delete();
        return response()->json([
            'code'=>200,
            'data'=>'ok'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($per) {
            return explode('.', $per->name)[1];
        });
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    public function show(string $id)
    {
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

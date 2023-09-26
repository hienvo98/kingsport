<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = User::find($request->user);
        if (in_array($request->role, $user->roles->pluck('id')->toArray())) return redirect()->back()->with('error', 'admin đã được cấp quyền này');
        $user->roles()->attach([$request->role]);
        return redirect()->back()->with('status', 'đã cấp quyền cho admin thành công');
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
    }

    public function search()
    {
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}

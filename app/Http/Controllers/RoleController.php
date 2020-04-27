<?php

namespace App\Http\Controllers;

use App\Actions\Roles\StoreRoleAction;
use App\Http\Requests\RoleRequest;
use App\Role;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Gate::authorize('view', Role::class);

        $permissions = Auth::user()->role->allPermissions();
        $users = User::with('role')->get();
        $user = User::with('role')->find(Auth::user()->id);
        $roles = Role::with('permissions')->get();
        return response()->view('role.index', compact('user', 'users', 'permissions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @param Role $role
     * @param StoreRoleAction $action
     * @return RedirectResponse|Response
     */
    public function store(RoleRequest $request, Role $role, StoreRoleAction $action)
    {
        $action->execute($role, $request);

        return redirect()->route('roles.index')->withSuccess(__('The role was successfully created'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return Response
     */
    public function update(Request $request, Role $role)
    {

    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate(['role' => 'required']);
        $user->update(['role_id' => $request->input('role')]);

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect(route('roles.index'));
    }
}

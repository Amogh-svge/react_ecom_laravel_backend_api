<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected Role $roleModel;

    public function __construct(Role $roleModel)
    {
        $this->roleModel = $roleModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $roles = $this->roleModel->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = $this->roleModel->create($request->validated());

        $notification = $this->notification($role, 'Role Successfully Created', 'Failed To Create Role');
        return redirect(route('roles.index'))->with('notification', $notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role_updated = $role->update($request->validated());

        $notification = $this->notification($role_updated, 'Role Updated Successfully', 'Failed To Update Role');
        return redirect(route('roles.index'))->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role_deleted = $role->delete();

        $notification = $this->notification($role_deleted, 'Role Deleted Successfully', 'Failed To Delete Role');
        return back()->with('notification', $notification);
    }
}

<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected Permission $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $permission_created = $this->model->create($validated);

        $notification = $this->notification($permission_created, 'Permission Successfully Created', 'Failed To Create Permission');
        return redirect(route('permission.index'))->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission): View
    {
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validated();
        $permission_updated = $permission->update($validated);

        $notification = $this->notification($permission_updated, 'Permission Updated Successfully', 'Failed To Update Permission');
        return redirect(route('permission.index'))->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission_deleted = $permission->delete();

        $notification = $this->notification($permission_deleted, 'Permission Deleted Successfully', 'Failed To Deleted Permission');
        return back()->with('notification', $notification);
    }
}

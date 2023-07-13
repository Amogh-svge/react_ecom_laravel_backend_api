<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label> Customer Order</label>
        <nav class="nav flex-column">
            <a href="{{ route('pending.list') }}" class="nav-link">Pending Order</a>
            <a href="{{ route('processing.list') }}" class="nav-link">Processing Order</a>
            <a href="{{ route('purchased.list') }}" class="nav-link">Complete Order</a>
        </nav>

        <label>Roles And Permission</label>
        <nav class="nav flex-column">
            <a href="{{ route('permission.index') }}" class="nav-link">List Permissions</a>
            <a href="{{ route('roles.index') }}" class="nav-link">List Roles</a>
            <a href="{{ route('roles.list_roles_permission') }}" class="nav-link">List Roles Permission</a>
        </nav>
    </div>
</div>

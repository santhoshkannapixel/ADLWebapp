<div class="d-flex align-items-center text-secondary">
    <span class="text-secondary">
        <i class="fa fa-home"></i>
        <i class="bi bi-chevron-right"></i>    
    </span>   
    <div class="fw-bold">
        {{ Route::is('admin.dashboard') ? "Dashboard" : '' }}
        {{ Route::is('admin.settings') ? "Settings" : '' }}
        {{ Route::is('user.create') ? "New User" : "" }}
        {{ Route::is('user.index') ? "Users List" : "" }}
        {{ Route::is('user.edit') ? "Edit User" : "" }}

        {{ Route::is('role.create') ? "New Role" : "" }}
        {{ Route::is('role.index') ? "Roles List" : "" }}
        {{ Route::is('role.edit') ? "Edit Role" : "" }}

        {{ Route::is('master.index') ? "Branch List" : '' }}
        {{ Route::is('branch.show') ? "Branch View" : '' }} 
        {{ Route::is('city.index') ? "City List" : '' }}

        {{ Route::is('test.index') ? "Test List" : '' }}
        {{ Route::is('test.show') ? "Test View" : '' }}

        {{ Route::is('banner.index') ? "Banner List" : '' }}
        {{ Route::is('banner.create') ? "Create Banner" : '' }}
        {{ Route::is('banner.edit') ? "Edit Banner" : '' }}

        {{ Route::is('api_config.index') ? "API Configuration" : '' }}
        {{ Route::is('api_config.create') ? "Create API Configuration" : '' }}
        {{ Route::is('api_config.edit') ? "Edit API Configuration" : '' }}

        {{ Route::is('payment_config.index') ? "Payment Configuration" : '' }}
        {{ Route::is('payment_config.create') ? "Create Payment Configuration" : '' }}
        {{ Route::is('payment_config.edit') ? "Edit Payment Configuration" : '' }}
    </div>
</div>
<div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ Route::is('admin.dashboard') ? " Home" : '' }}
                {{ Route::is('admin.settings') ? "Settings / Settings" : '' }}
                {{ Route::is('user.create') ? "Settings / New User" : "" }}
                {{ Route::is('user.index') ? "Settings / Users List" : "" }}
                {{ Route::is('user.edit') ? "Settings / Edit User" : "" }}
    
                {{ Route::is('role.create') ? "Settings / New Role" : "" }}
                {{ Route::is('role.index') ? "Settings / Roles List" : "" }}
                {{ Route::is('role.edit') ? "Settings / Edit Role" : "" }}

                {{ Route::is('master.index') ? "Masters / Branch List" : '' }}
                {{ Route::is('branch.show') ? "Masters / Branch view" : '' }}
                {{ Route::is('city.index') ? "Masters / City List" : '' }}

                {{ Route::is('test.index') ? "Test List" : '' }}
                {{ Route::is('test.show') ? "Masters / Test View" : '' }}

                {{ Route::is('banner.index') ? "Masters / Banner List" : '' }}
                {{ Route::is('banner.create') ? "Masters / Create Banner" : '' }}
                {{ Route::is('banner.edit') ? "Masters / Edit Banner" : '' }} 

                {{ Route::is('api_config.index') ? "Settings /  API Configuration" : '' }}
                {{ Route::is('api_config.create') ? "Settings /  Create API Configuration" : '' }}
                {{ Route::is('api_config.edit') ? "Settings /  Edit API Configuration" : '' }}

                {{ Route::is('payment_config.index') ? "Settings /  Payment Configuration" : '' }}
                {{ Route::is('payment_config.create') ? "Settings /  Create Payment Configuration" : '' }}
                {{ Route::is('payment_config.edit') ? "Settings /  Edit Payment Configuration" : '' }}
            </li>
        </ol>
    </nav>
    <div class="dropdown ms-3 me-3 border-start ps-3">
        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="http://www.staroceans.org/w3c/img_avatar.png" alt="" width="32" height="32" class="rounded-5 me-2">
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-my-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
            <li><a class="dropdown-item" href="#"><b>{{ Sentinel::getUser()->name }}</b> <small class="ms-2 badge bg-success text-white">{{ Sentinel::getUser()->roles[0]->name }}</small></a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onclick="return document.getElementById('logout_form').submit()">Sign out</a></li>
        </ul>
    </div>
</div>
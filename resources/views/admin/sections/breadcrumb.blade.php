<div class="d-flex align-items-center text-secondary">
    <span class="text-secondary">
        <i class="fa fa-home"></i>
        <i class="bi bi-chevron-right"></i>
    </span>
    <div class="fw-bold">
        {{ Route::is('dashboard.index') ? "Dashboard" : '' }}
        {{ Route::is('settings.index') ? "Settings" : '' }}
        {{ Route::is('user.create') ? "New User" : "" }}
        {{ Route::is('user.index') ? "Users List" : "" }}
        {{ Route::is('user.edit') ? "Edit User" : "" }}

        {{ Route::is('role.create') ? "New Role" : "" }}
        {{ Route::is('role.index') ? "Roles List" : "" }}
        {{ Route::is('role.edit') ? "Edit Role" : "" }}


        {{ Route::is('home-collection.index') ? "Home Collection List" : "" }}
        {{ Route::is('home-collection.show') ? "Show Home Collection" : "" }}

        {{ Route::is('patients-consumers.index') ? "Patients Consumers List" : "" }}
        {{ Route::is('patients-consumers.show') ? "Show Patients Consumers" : "" }}

        {{ Route::is('feedback.index') ? "FeedBack List" : "" }}
        {{ Route::is('feedback.show') ? "Show FeedBack" : "" }}

        {{ Route::is('faq.index') ? "Frequently Asked Questions List" : "" }}
        {{ Route::is('faq.show') ? "Show Frequently Asked Questions" : "" }}

        {{ Route::is('hospital-lab-management.index') ? "Hospital Lab Management" : "" }}
        {{ Route::is('hospital-lab-management.show') ? "Hospital Lab Management" : "" }}

        {{ Route::is('clinical-lab-management.index') ? "Clinician Lab Management" : "" }}
        {{ Route::is('clinical-lab-management.show') ? "Clinician Lab Management" : "" }}

        {{ Route::is('franchising-opportunities.index') ? "Franchising Opportunities" : "" }}
        {{ Route::is('franchising-opportunities.show') ? "Franchising Opportunities" : "" }}

        {{ Route::is('research.index') ? "Research" : "" }}
        {{ Route::is('research.show') ? "Research" : "" }}

        {{ Route::is('book-an-appointment.index') ? "Book an Appointment" : "" }}
        {{ Route::is('book-an-appointment.show') ? "Book an Appointment" : "" }}

        {{ Route::is('healthcheckup-for-employee.index') ? "Healthcheckup for employees" : "" }}
        {{ Route::is('healthcheckup-for-employee.show') ? "Healthcheckup for employees" : "" }}

        {{ Route::is('anandlab-franchise.index') ? "Anand Franchise" : "" }}
        {{ Route::is('anandlab-franchise.show') ? "Show Anand Franchise" : "" }}

        {{ Route::is('covidtesting-employees.index') ? "COVID Testing For Employees" : "" }}
        {{ Route::is('covidtesting-employees.show') ? "Show COVID Testing For Employees" : "" }}


        {{ Route::is('branch.index') ? "Branch List" : '' }}
        {{ Route::is('branch.show') ? "Branch View" : '' }}
        {{ Route::is('city.index') ? "City List" : '' }}

        {{ Route::is('test.index') ? "Test List" : '' }}
        {{ Route::is('test.show') ? "Test View" : '' }}
        {{ Route::is('test.edit') ? "Edit Test"  : '' }}


        {{ Route::is('banner.index') ? "Banner List" : '' }}
        {{ Route::is('banner.create') ? "Create Banner" : '' }}
        {{ Route::is('banner.edit') ? "Edit Banner" : '' }}

        {{ Route::is('department.index') ? "Department List" : '' }}
        {{ Route::is('department.create') ? "Create Department" : '' }}
        {{ Route::is('department.edit') ? "Edit Department" : '' }}

        {{ Route::is('job-post.index') ? "Job Post List" : '' }}
        {{ Route::is('job-post.create') ? "Create Job Post" : '' }}
        {{ Route::is('job-post.edit') ? "Edit Job Post" : '' }}

        {{ Route::is('careers.index') ? "Career List" : '' }}
        {{ Route::is('careers.view') ? "view Career" : '' }}

        {{ Route::is('contact-us.index') ? "Contact us List" : '' }}
        {{ Route::is('contact-us.view') ? "view Contact us" : '' }}
    
        {{ Route::is('news-letter.index') ? "News Letter List" : '' }}
        {{ Route::is('news-letter.show') ? "News Letter Show" : '' }}


        {{ Route::is('api_config.index') ? "API Configuration" : '' }}
        {{ Route::is('api_config.create') ? "Create API Configuration" : '' }}
        {{ Route::is('api_config.edit') ? "Edit API Configuration" : '' }}

        {{ Route::is('payment_config.index') ? "Payment Configuration" : '' }}
        {{ Route::is('payment_config.create') ? "Create Payment Configuration" : '' }}
        {{ Route::is('payment_config.edit') ? "Edit Payment Configuration" : '' }}
        {{ Route::is('admin.profile') ? "Profile" : '' }}
    </div>
</div>
<div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ breadcrumbTitle() }}
            </li>
        </ol>
    </nav>
    <div class="dropdown ms-3 me-3 border-start ps-3">
        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('public/images/avatar.png') }}" alt="" width="32" height="32" class="rounded-5 me-2">
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-my-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
            <li><a class="dropdown-item" href="#"><b>{{ Sentinel::getUser()->name }}</b> <small class="ms-2 badge bg-success text-white">{{ Sentinel::getUser()->roles[0]->name }}</small></a></li>
            @if (permission_check('ROLE_INDEX') || permission_check('USER_INDEX') || permission_check('API_CONFIG_INDEX') || permission_check('PAYMENT_CONFIG_INDEX')  )
            <li><a class="dropdown-item" href="{{ route('settings.index') }}">Settings</a></li>
            @endif
            @if (permission_check('ADMIN_PROFILE'))
            <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
            @endif
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onclick="return document.getElementById('logout_form').submit()">Sign out</a></li>
        </ul>
    </div>
</div>

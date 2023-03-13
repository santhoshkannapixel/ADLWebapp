<div class="d-flex align-items-center text-secondary">
    <span class="text-secondary">
        <i class="fa fa-home"></i>
        <i class="bi bi-chevron-right"></i>
    </span>
    <div class="fw-bold">
        {{ Route::is('dashboard.index') ? "Dashboard" : '' }}
        {{ Route::is('settings.index') ? "Settings" : '' }}
        {{ Route::is('user.create') ? "Users / New User" : "" }}
        {{ Route::is('user.index') ? "Users" : "" }}
        {{ Route::is('user.edit') ? "Users / Edit User" : "" }}

        {{ Route::is('role.create') ? "Roles / New Role" : "" }}
        {{ Route::is('role.index') ? "Roles" : "" }}
        {{ Route::is('role.edit') ? "Roles / Edit Role" : "" }}


        {{ Route::is('home-collection.index') ? "Home Collection" : "" }}
        {{ Route::is('home-collection.show') ? "Home Collection / Home Collection Details" : "" }}

        {{ Route::is('patients-consumers.index') ? "Patients Consumers" : "" }}
        {{ Route::is('patients-consumers.show') ? "Patients Consumers / Patients Consumers Details" : "" }}

        {{ Route::is('feedback.index') ? "Feed back" : "" }}
        {{ Route::is('feedback.show') ? "Feed back / Feed back Details" : "" }}

        {{ Route::is('faq.index') ? "Frequently Asked Questions" : "" }}
        {{ Route::is('faq.show') ? "Frequently Asked Questions / Frequently Asked Questions Details" : "" }}

        {{ Route::is('hospital-lab-management.index') ? "Hospital Lab Management" : "" }}
        {{ Route::is('hospital-lab-management.show') ? "Hospital Lab Management / Hospital Lab Management Details" : "" }}

        {{ Route::is('clinical-lab-management.index') ? "Clinician Lab Management" : "" }}
        {{ Route::is('clinical-lab-management.show') ? "Clinician Lab Management / Clinician Lab Management Details" : "" }}

        {{ Route::is('franchising-opportunities.index') ? "Franchising Opportunities" : "" }}
        {{ Route::is('franchising-opportunities.show') ? "Franchising Opportunities / Franchising Opportunities Details" : "" }}

        {{ Route::is('research.index') ? "Research" : "" }}
        {{ Route::is('research.show') ? "Research / Research Details" : "" }}

        {{ Route::is('book-an-appointment.index') ? "Book an Appointment" : "" }}
        {{ Route::is('book-an-appointment.show') ? "Book an Appointment / Book an Appointment Details" : "" }}

        {{ Route::is('healthcheckup-for-employee.index') ? "Healthcheckup for employees" : "" }}
        {{ Route::is('healthcheckup-for-employee.show') ? "Healthcheckup for employees / Healthcheckup for employees Details" : "" }}

        {{ Route::is('anandlab-franchise.index') ? "Anand Franchise" : "" }}
        {{ Route::is('anandlab-franchise.show') ? "Show Anand Franchise" : "" }}

        {{ Route::is('covidtesting-employees.index') ? "COVID Testing For Employees" : "" }}
        {{ Route::is('covidtesting-employees.show') ? "Show COVID Testing For Employees" : "" }}


        {{ Route::is('branch.index') ? "Branch" : '' }}
        {{ Route::is('branch.show') ? " Branch / Branch Details" : '' }}
        {{ Route::is('city.index') ? "City" : '' }}

        {{ Route::is('test.index') ? "Test" : '' }}
        {{ Route::is('test.show') ? "Test / Test Details" : '' }}
        {{ Route::is('test.edit') ? " Test / Test Edit"  : '' }}


        {{ Route::is('banner.index') ? "Banner" : '' }}
        {{ Route::is('banner.create') ? "Banner / Create Banner" : '' }}
        {{ Route::is('banner.edit') ? "Banner / Edit Banner" : '' }}

        {{ Route::is('department.index') ? "Department" : '' }}
        {{ Route::is('department.create') ? "Department / Create Department" : '' }}
        {{ Route::is('department.edit') ? "Department / Edit Department" : '' }}

        {{ Route::is('job-post.index') ? "Job Post" : '' }}
        {{ Route::is('job-post.create') ? "Job Post / Create Job Post" : '' }}
        {{ Route::is('job-post.edit') ? "Job Post / Edit Job Post" : '' }}

        {{ Route::is('careers.index') ? "Careers" : '' }}
        {{ Route::is('careers.view') ? "Careers / Career Details" : '' }}

        {{ Route::is('contact-us.index') ? "Contact us" : '' }}
        {{ Route::is('contact-us.view') ? "Contact us / Contact us Details" : '' }}
    
        {{ Route::is('news-letter.index') ? "News Letter" : '' }}
        {{ Route::is('news-letter.show') ? "News Letter / News Letter Details" : '' }}


        {{ Route::is('api_config.index') ? "API Configuration" : '' }}
        {{ Route::is('api_config.create') ? "API Configuration / Create API Configuration" : '' }}
        {{ Route::is('api_config.edit') ? "API Configuration / Edit API Configuration" : '' }}

        {{ Route::is('orders.index') ? "Orders" : '' }}
        {{ Route::is('orders.show') ? "Orders / Orders Details" : '' }}

        {{ Route::is('customers.index') ? "Customers" : '' }}
        {{ Route::is('customers.show') ? "Customers / Customers Details" : '' }}

        {{ Route::is('news-and-events.index') ? "News And Events" : '' }}
        {{ Route::is('news-and-events.edit') ? "News And Events / News And Events Edit" : '' }}

        {{ Route::is('organ.index') ? "Organs" : '' }}
        {{ Route::is('organ.edit') ? "Organs / Edit Organs " : '' }}

        {{ Route::is('condition.index') ? "Condition" : '' }}
        {{ Route::is('condition.edit') ? "Condition / Edit Condition " : '' }}
        
        
        {{ Route::is('payment_config.index') ? "Payment Configuration" : '' }}
        {{ Route::is('payment_config.create') ? "Payment Configuration / Create Payment Configuration" : '' }}
        {{ Route::is('payment_config.edit') ? "Payment Configuration / Edit Payment Configuration" : '' }}
        {{ Route::is('admin.profile') ? "Profile" : '' }}
    </div>
</div>
<div class="d-flex align-items-center">
        {{-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ breadcrumbTitle() }}
                </li>
            </ol>
        </nav> --}}
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

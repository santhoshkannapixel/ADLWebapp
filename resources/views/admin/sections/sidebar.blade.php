<div class="d-flex flex-column flex-shrink-0 text-white   side_bar" style="width: 280px;">
    <a href="{{ route('dashboard.index') }}" class="d-flex shadow p-3 border-light align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="border-bottom: 1px solid #ffffff24 !important">
        <img src="{{ asset('public/images/logo/logo-dark.png') }}" alt="logo" width="90%" class="mx-auto">
    </a>
    <ul class="nav nav-pills flex-column mb-auto mt-3 pt-0 p-3 side-navbar">
        <li>
            <a href="{{ route('dashboard.index') }}" class="nav-link text-white {{ Route::is('dashboard.index') ? "active" : "" }}" aria-current="page">
                <i class="fa fa-home"></i>Dashboard</a>
            </a>
        </li>
        <li>
            <a href="{{ route('orders.index') }}" class="nav-link text-white {{ Route::is('orders.index','orders.show') ? "active" : "" }}">
            <i class="fa fa-shopping-cart"></i>Orders
            </a>
        </li>
        <li>
            <a href="{{ route('customers.index') }}" class="nav-link text-white {{ Route::is('customers.index','customers.show') ? "active" : "" }}" >
                <i class="fa fa-users"></i>Customers
            </a>
        </li>
        <li>
            <a href="{{ route('patients.index') }}" class="nav-link text-white {{ Route::is([
                    'patients.index',
                    'home-collection.index',
                    'home-collection.show',
                    'patients-consumers.index',
                    'patients-consumers.show',
                    'feedback.index',
                    'feedback.show',
                    'faq.index',
                    'faq.show',
                ]) ? "active" : "" }}">
                <i class="fa fa-address-card"></i>Patients
            </a>
        </li>
        <li>
            <a href="{{ route('doctors.index') }}" class="nav-link text-white {{ Route::is([
                    'doctors.index',
                    'hospital-lab-management.index',
                    'hospital-lab-management.show',
                    'clinical-lab-management.index',
                    'clinical-lab-management.show',
                    'franchising-opportunities.index',
                    'franchising-opportunities.show',
                    'research.index',
                    'research.show',
                ]) ? "active" : "" }}">
                <i class="fa fa-user-md"></i>Doctors
            </a>
        </li>
        <li>
            <a href="{{ route('health-checkup.index') }}" class="nav-link text-white {{ Route::is([
                    'health-checkup.index',
                    'book-an-appointment.index',
                    'book-an-appointment.show',
                ]) ? "active" : "" }}">
                <i class="fa fa-medkit"></i>Health Checkup
            </a>
        </li>
        
        <li>
            <a href="{{ route('reach-us.index') }}" class="nav-link text-white {{ Route::is([
                    'reach-us.index',
                    'healthcheckup-for-employee.index',
                    'healthcheckup-for-employee.show',
                    'anandlab-franchise.index',
                    'anandlab-franchise.show',
                    'covidtesting-employees.index',
                    'covidtesting-employees.show'
                ]) ? "active" : "" }}">
                <i class="fa fa-calendar-check-o"></i>Reach Us
            </a>
        </li>
        <li>
            <a href="{{ route('news-and-events.index') }}" class="nav-link text-white {{ Route::is(['news-and-events.index']) ? "active" : "" }}">
                <i class="fa fa-book"></i>News & Events
            </a>
        </li>
        <li>
            <a href="{{ route('news-letter.index') }}" class="nav-link text-white {{ Route::is(['news-letter.index','news-letter.show']) ? "active" : "" }}">
                <i class="fa fa-newspaper-o"></i>News Letter
            </a>
        </li>
        <li>
            <a href="{{ route('branch.index') }}" class="nav-link text-white {{ Route::is(['branch.index','branch.show','city.index', 'banner.edit', 'test.index','test.show','test.edit' , 'banner.create', 'banner.index','organ.index','organ.update','organ.edit','organ.create','condition.index','condition.update','condition.edit','condition.create']) ? "active" : "" }}">
                <i class="fa fa-cog"></i>Master
            </a>
        </li>
        <li>
            <a href="{{ route('department.index') }}" class="nav-link text-white {{ Route::is(['department.index', 'department.edit', 'department.create','job-post.index','job-post.create','job-post.edit','careers.index','careers.view']) ? "active" : "" }}">
                <i class="fa fa-cog"></i>Manage Careers
            </a>
        </li>
        <li>
            <a href="{{ route('contact-us.index') }}" class="nav-link text-white {{ Route::is(['contact-us.index' , 'contact-us.view']) ? "active" : "" }}">
                <i class="fa fa-cog"></i>Manage Contact
            </a>
        </li>
        <li>
            <a href="{{ route('settings.index') }}" class="nav-link text-white {{ Route::is([
                    'settings.index',
                    'user.index',
                    'user.create',
                    'user.edit',
                    'role.index',
                    'role.create',
                    'role.edit',               
                    'api_config.index',
                    'api_config.edit',
                    'api_config.create',
                    'payment_config.index',
                    'payment_config.edit',
                    'payment_config.create',
                ]) ? "active" : "" }}">
                <i class="fa fa-cogs"></i>Settings
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown p-3 pt-0">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="http://www.staroceans.org/w3c/img_avatar.png" alt="" width="32" height="32" class="rounded-5 me-2">
            <b>{{ Sentinel::getUser()->name }}</b>
            <small class="ms-2 badge bg-success text-white">
                {{ Sentinel::getUser()->roles[0]->name }}
            </small>
        </a>
        <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1" style="">
            <li><a class="dropdown-item" href="{{ route('settings.index') }}">Settings</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onclick="return document.getElementById('logout_form').submit()">Sign out</a></li>
        </ul>
    </div>
</div>

<form action="{{ route('logout') }}" method="POST" id="logout_form">@csrf</form>

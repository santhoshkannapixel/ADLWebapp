<div class="d-flex align-items-center text-secondary">
    <span class="text-secondary">
        <i class="fa fa-home"></i>
        <i class="bi bi-chevron-right"></i>
    </span>
    <div class="fw-bold">
        {{ Route::is('dashboard.index') ? "Dashboard" : '' }}
        {{ Route::is('admin.settings') ? "Settings" : '' }}
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

        {{ Route::is('head-office.index') ? "Head Office" : "" }}
        {{ Route::is('head-office.show') ? "Head Office" : "" }}

        {{ Route::is('anandlab-franchise.index') ? "Anand Franchise" : "" }}
        {{ Route::is('anandlab-franchise.show') ? "Show Anand Franchise" : "" }}

        {{ Route::is('covidtesting-employees.index') ? "COVID Testing For Employees" : "" }}
        {{ Route::is('covidtesting-employees.show') ? "Show COVID Testing For Employees" : "" }}


        {{ Route::is('master.index') ? "Branch List" : '' }}
        {{ Route::is('branch.show') ? "Branch View" : '' }}
        {{ Route::is('city.index') ? "City List" : '' }}

        {{ Route::is('test.index') ? "Test List" : '' }}
        {{ Route::is('test.show') ? "Test View" : '' }}
        {{ Route::is('test.edit') ? "Edit Test"  : '' }}


        {{ Route::is('banner.index') ? "Banner List" : '' }}
        {{ Route::is('banner.create') ? "Create Banner" : '' }}
        {{ Route::is('banner.edit') ? "Edit Banner" : '' }}

        {{ Route::is('news-letter.index') ? "News Letter List" : '' }}
        {{ Route::is('news-letter.show') ? "News Letter Show" : '' }}


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
                {{ Route::is('dashboard.index') ? " Home" : '' }}
                {{ Route::is('admin.settings') ? "Settings / Settings" : '' }}
                {{ Route::is('user.create') ? "Settings / New User" : "" }}
                {{ Route::is('user.index') ? "Settings / Users List" : "" }}
                {{ Route::is('user.edit') ? "Settings / Edit User" : "" }}

                {{ Route::is('role.create') ? "Settings / New Role" : "" }}
                {{ Route::is('role.index') ? "Settings / Roles List" : "" }}
                {{ Route::is('role.edit') ? "Settings / Edit Role" : "" }}


                {{ Route::is('home-collection.index') ? "Enquiries / Home Collection List" : "" }}
                {{ Route::is('home-collection.show') ? "Enquiries / Show Home Collection" : "" }}

                {{ Route::is('patients-consumers.index') ? "Enquiries / Patients Consumers List" : "" }}
                {{ Route::is('patients-consumers.show') ? "Enquiries / Show Patients Consumers" : "" }}

                {{ Route::is('feedback.index') ? "Enquiries / FeedBack List" : "" }}
                {{ Route::is('feedback.show') ? "Enquiries / Show FeedBack" : "" }}

                {{ Route::is('faq.index') ? "Enquiries /  Frequently Asked Questions List" : "" }}
                {{ Route::is('faq.show') ? "Enquiries /  Show Frequently Asked Questions" : "" }}

                {{ Route::is('hospital-lab-management.index') ? "Doctors /  Hospital  Lab Management" : "" }}
                {{ Route::is('hospital-lab-management.show') ? "Doctors / Show Hospital Lab Management" : "" }}

                {{ Route::is('clinical-lab-management.index') ? "Doctors /  Clinician  Lab Management" : "" }}
                {{ Route::is('clinical-lab-management.show') ? "Doctors / Show Clinician Lab Management" : "" }}

                {{ Route::is('franchising-opportunities.index') ? "Doctors /  Franchising Opportunities" : "" }}
                {{ Route::is('franchising-opportunities.show') ? "Doctors / Show Franchising Opportunities" : "" }}

                {{ Route::is('research.index') ? "Doctors / Research" : "" }}
                {{ Route::is('research.show') ? "Doctors / Show Research" : "" }}

                {{ Route::is('book-an-appointment.index') ? "Doctors / Book an Appointment" : "" }}
                {{ Route::is('book-an-appointment.show') ? "Doctors / Show Book an Appointment" : "" }}

                {{ Route::is('head-office.index') ? "Reach Us / Head Office" : "" }}
                {{ Route::is('head-office.show') ? "Reach Us / Show Head Office" : "" }}

                {{ Route::is('anandlab-franchise.index') ? "Reach Us / Anand Franchise" : "" }}
                {{ Route::is('anandlab-franchise.show') ? "Reach Us / Show Anand Franchise" : "" }}

                {{ Route::is('covidtesting-employees.index') ? "Reach Us / COVID Testing For Employees" : "" }}
                {{ Route::is('covidtesting-employees.show') ? "Reach Us / Show COVID Testing For Employees" : "" }}


                {{ Route::is('master.index') ? "Masters / Branch List" : '' }}
                {{ Route::is('branch.show') ? "Masters / Branch view" : '' }}
                {{ Route::is('city.index') ? "Masters / City List" : '' }}

                {{ Route::is('test.index') ? "Test List" : '' }}
                {{ Route::is('test.show') ? "Masters / Test View" : '' }}
                {{ Route::is('test.edit') ? "Masters /  Edit Test Details" : '' }}


                {{ Route::is('banner.index') ? "Masters / Banner List" : '' }}
                {{ Route::is('banner.create') ? "Masters / Create Banner" : '' }}
                {{ Route::is('banner.edit') ? "Masters / Edit Banner" : '' }}

                {{ Route::is('news-letter.show') ?  "Masters / News Letter View": '' }}

                {{ Route::is('api_config.index') ? "Settings /  API Configuration" : '' }}
                {{ Route::is('api_config.create') ? "Settings /  Create API Configuration" : '' }}
                {{ Route::is('api_config.edit') ? "Settings /  Edit API Configuration" : '' }}

                {{ Route::is('test.index') ? "Settings /  Payment Configuration" : '' }}
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

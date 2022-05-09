<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('admin_title')</title>
    <link rel="shortcut icon" href="{{ asset('public/images/logo/favicon.png') }}">
    @include('styles.admin')
</head>
<body class="root_admin"> 
    <main>
        {{-- === Sidebar  ===--}}
            @include('admin.sections.sidebar')
        {{-- === Sidebar  ===--}}

        <div class="main-content">
            <div class="sticky-top top-nav shadow-sm w-100 p-2 px-3">
                @include('admin.sections.breadcrumb')
            </div>
            <div class="p-3">
                @yield('admin_content')
            </div>
        </div>
    </main>
    @include('scripts.admin')
</body>
</html>
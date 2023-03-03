@extends('layouts.auth')

@section("auth_title") Login  @endsection

@section("auth_content")
    <div class="card">
        <div class="card-body p-4">
            <form class="text-center m-0" action="{{ route("login") }}" method="POST">
                @csrf
                <img class="mb-4 mx-auto" src="{{ asset('public/images/logo/logo.png') }}"  width="80%">
                {{-- <h3 class="mb-3"><b>Sign In </b></h3>
                <i class="fa fa-user-circle text-primary fa-3x mb-3"></i> --}}
                <div class="form-floating">
                    <input type="email" name="email" value="" class="rounded form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <br>
                <div class="form-floating">
                    <input type="password" value="" name="password" class="rounded form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="checkbox mb-3 text-start mt-3">
                    <label>
                    <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>

                <button class="w-100 btn btn-lg btn-gradient" type="submit"> <i class="fa fa-unlock-alt me-2"></i>Sign in</button>

                <p class="my-2 mb-0 mt-3 text-muted">&copy; 2022-2023</p>
            </form>
        </div>
    </div>
@endsection

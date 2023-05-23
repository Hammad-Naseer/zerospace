@extends('layouts.app')

@section('content')

<div class="container bg-login">

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col mx-auto">
            <div class="my-4 text-center">
                <img src="{{ asset(MyApp::ASSET_IMG.'logo-img.png') }}" width="180" alt="" />
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">
                            <h3 class="">Sign Up</h3>
                            <p>Already have an account? <a href="{{URL::to('/login')}}">Sign in here</a>
                            </p>
                        </div>

                        <div class="login-separater text-center mb-4"> <span>SIGN UP WITH EMAIL</span>
                            <hr />
                        </div>
                        <div class="form-body">
                            <form class="row g-3" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="col-sm-6">
                                    <label for="inputLastName" class="form-label"> {{ __('Name') }}</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        id="inputLastName" placeholder="Enter your name" required autocomplete="name"
                                        autofocus>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputFirstName" class="form-label">{{ __('Email Address') }}</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        id="inputFirstName" placeholder="Enter your Email" required
                                        autocomplete="email">
                                </div>

                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">{{ __('Password') }}</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0"
                                            id="inputChoosePassword" value="12345678" placeholder="Enter Password"
                                            name="password" required autocomplete="new-password"> <a href="javascript:;"
                                            class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword"
                                        class="form-label">{{ __('Confirm Password') }}</label>
                                    <div class="input-group" id="show_hide_password1">
                                        <input type="password" class="form-control border-end-0"
                                            id="inputChoosePassword" value="" placeholder="Enter Password"
                                            name="password_confirmation" required autocomplete="new-password"> <a
                                            href="javascript:;" class="input-group-text bg-transparent"><i
                                                class='bx bx-hide'></i></a>
                                    </div>
                                </div>





                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<!--Password show & hide js -->
<script>
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });

    $("#show_hide_password1 a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password1 input').attr("type") == "text") {
            $('#show_hide_password1 input').attr('type', 'password');
            $('#show_hide_password1 i').addClass("bx-hide");
            $('#show_hide_password1 i').removeClass("bx-show");
        } else if ($('#show_hide_password1 input').attr("type") == "password") {
            $('#show_hide_password1 input').attr('type', 'text');
            $('#show_hide_password1 i').removeClass("bx-hide");
            $('#show_hide_password1 i').addClass("bx-show");
        }
    });


});
</script>

@endsection
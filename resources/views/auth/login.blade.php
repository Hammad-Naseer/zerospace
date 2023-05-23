@extends('layouts.app')

@section('content')
<style>
.page-wrapper {
    margin-left: 0px !important;
}
</style>
<div class="container">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                    <img src="{{ asset(MyApp::ASSET_IMG.'inv.png') }}" width="180" alt="" /> 
                        
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">

                                <div class="login-separater text-center mb-4"> <span>SIGN IN WITH EMAIL</span>
                                    <hr />
                                </div>

                                @if($errors ->any() > 0)
                                @foreach($errors ->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{$error}}
                                </div>
                                @endforeach
                                @endif
                                <div class="form-body">
                                    <form class="row g-3" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputEmailAddress"
                                                class="form-label">{{ __('Email Address') }}</label>
                                            <input type="email" class="form-control" name="email" id="inputEmailAddress"
                                                placeholder="Email Address" value="{{ old('email') }}" required
                                                autocomplete="email" autofocus>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">{{ __('Password') }}
                                            </label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0"
                                                    id="inputChoosePassword" value="12345678"
                                                    placeholder="Enter Password" name="password" required
                                                    autocomplete="current-password"> <a href="javascript:;"
                                                    class="input-group-text bg-transparent"><i
                                                        class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckChecked" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-8 text-end"> <a href="authentication-forgot-password.html">
                                                {{ __('Forgot Your Password?') }}</a>
                                        </div> -->
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bx bxs-lock-open"></i> {{ __('Login') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
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

});
</script>
@endsection
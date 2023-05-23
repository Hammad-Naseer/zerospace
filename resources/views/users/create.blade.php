@extends('layouts.app')

@section('content')

<!--sidebar wrapper -->
@include('partials.sidebar')
<!--end sidebar wrapper -->

<!--start header -->
@include('partials.topbar')
<!--end header -->


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Users</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-5">
                    {!! Form::open(array('route' => 'users.store','method'=>'POST' , 'class'=> 'row g-3')) !!}
                    <div class="col-md-6">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', '', array('class' => 'form-control','placeholder' => 'Enter User Name')) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', '', array('class' => 'form-control','placeholder' => 'Enter Email')) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('password', 'Password') }}<br>
                        {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password')) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('password', 'Confirm Password') }}<br>
                        {{ Form::password('password_confirmation', array('class' => 'form-control','placeholder' => 'Enter Confirm Password')) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('acc_id', 'Select Account') }}<br>
                        <select name="acc_id" class="form-control">
                        {!! account_dropdown() !!}
                        </select>
                    </div>
                    <h5><b>Give Role</b></h5>
                    <div class="col-12">
                        @foreach ($roles as $role)
                        {{ Form::checkbox('roles[]',  $role->id ) }}
                        {{ Form::label($role->name, ucfirst($role->name)) }}
                        <br>
                        @endforeach
                    </div>
                    <div class="col-12">
                        {{ Form::submit('Save', array('class' => 'btn btn-primary float-end')) }}
                    </div>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>

<!--start page footer -->
@include('partials.footer')
<!--start page footer -->

<!--start switcher-->
@include('partials.theme_customizer')
<!--end switcher-->
@endsection
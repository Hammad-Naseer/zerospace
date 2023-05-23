@extends('layouts.app')

@section('content')

<!--sidebar wrapper -->
@include('partials.sidebar')
<!--end sidebar wrapper -->

<!--start header -->
@include('partials.topbar')
<!--end header -->
<div class="page-content">
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Roles</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Roles</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'POST')) }}
                        <div class="form-group row">
                            <div class="col-sm-6 col-lg-4">
                                {{ Form::label('name', 'Role Name') }}
                                {{ Form::text('name', null, array('class' => 'form-control')) }}
                                @error('name')
                                {{ Form::label('', $message, array('class'=>'error')) }}
                                @enderror()
                            </div>
                            <div class="col-sm-12">
                                <h5><strong>Assign Permissions</strong></h5>
                                @error('permissions')
                                {{ Form::label('', $message, array('class'=>'error')) }}
                                @enderror()
                            </div>

                            @foreach ($permissions as $permission)
                            <div class="col-sm-4 col-md-6 col-lg-4">
                                <div class="checkbox-custom checkbox-primary">
                                    {{ Form::checkbox('permissions[]',  $permission->id, $role->permissions, array('id'=>$permission->name)) }}
                                    {{ Form::label($permission->name, ucfirst($permission->name)) }}
                                </div>
                            </div>
                            @endforeach
                            <div class="col-sm-12">
                                <div class="clearfix">&nbsp;</div>
                                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                            </div>
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
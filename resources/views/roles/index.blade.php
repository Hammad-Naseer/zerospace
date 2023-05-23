@extends('layouts.app')

@section('content')

<!--sidebar wrapper -->
@include('partials.sidebar')
<!--end sidebar wrapper -->

<!--start header -->
@include('partials.topbar')
<!--end header -->
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Roles</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Roles</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('users.create')}}" class="btn btn-primary px-5 radius-30"><i
                    class="bx bx-plus mr-1"></i>Add Role</a>
        </div>
    </div>




    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="example2" class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <!-- <td>{{ str_replace(array('[',']','"'),'',$role->permissions()->pluck('name')) }}</td> -->
                            <td>{{ implode(', ', $role->permissions()->pluck('name')->toArray()) }}</td>
                            {{-- Retrieve array of permissions associated to a role and convert to string --}}
                            <td>
                            @can('EditRole')
                                <a href="{{route('roles.edit',$role->id)}}"><i
                                        class="fadeIn animated bx bx-pencil bx-sm"></i></a>
                            @endcan 
                            @can('DeleteRole')
                                <a href="#" class="fadeIn animated bx bx-trash bx-sm"
                                    onclick="confirm_modal('{{route("roles.destroy", ["id" => $role->id])}}');">
                                    @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
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
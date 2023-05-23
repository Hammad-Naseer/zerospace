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
        <div class="ms-auto">
            <a href="{{route('users.create')}}" class="btn btn-primary px-5 radius-30">
                <i class="bx bx-plus mr-1">
                </i>Add
                User
            </a>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="example2" class="table table-striped table-bordered ">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date/Time Added</th>
                            <th>User Roles</th>
                            <th>Linked Account</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr>

                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                            <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>
                            <td>
                                @if($user->acc_id != 0)
                                {{ get_account_details($user->acc_id)->acc_title }}
                                @endif
                                
                            </td>
                            {{-- Retrieve array of roles associated to a user and convert to string --}}
                            <td>
                            @can('EditUser')
                                <a href="{{route('users.edit',$user->id)}}"><i
                                        class="fadeIn animated bx bx-pencil bx-sm"></i></a>
                                        @endcan
                                        @can('DeleteUser')
                                <a href="#" class="fadeIn animated bx bx-trash bx-sm"
                                    onclick="confirm_modal('{{route("users.destroy", ["id" => $user->id])}}');">
                                </a>
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
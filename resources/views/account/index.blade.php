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
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Amazon Accounts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Amazon Accounts</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="#" class="btn btn-primary px-5 radius-30"
                onclick="showAjaxModal('{{route("open_popup", ["page_name" => "account.create"])}}');">
                <i class="bx bx-plus mr-1">
                </i>Add Amazon
                Account
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Amazon Accounts</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Account Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $account)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $account->acc_title }}</td>
                            <td>{!! status($account->acc_status) !!}</td>
                            <td>
                                <!-- <a href="{{route('account.edit',$account->acc_id)}}"><i
                                        class="fadeIn animated bx bx-pencil bx-sm"></i></a> -->
                                <!-- <a href="{{route('account.delete',$account->acc_id)}}"><i
                                        class="fadeIn animated bx bx-trash bx-sm"></i></a> -->
                                        @can('EditAccount')
                                <a href="#" class="fadeIn animated bx bx-pencil bx-sm"
                                    onclick="showAjaxModal('{{route("account.edit", ["id" => $account->acc_id])}}');">
                                </a>
                                @endcan
                                @can('DeleteAccount')
                                <a href="#" class="fadeIn animated bx bx-trash bx-sm"
                                    onclick="confirm_modal('{{route("account.delete", ["id" => $account->acc_id])}}');">
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
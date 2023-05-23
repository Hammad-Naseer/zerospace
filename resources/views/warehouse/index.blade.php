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
        <div class="breadcrumb-title pe-3">Warehouse</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Warehouse</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

            <a href="#" class="btn btn-primary px-5 radius-30"
                onclick="showAjaxModal('{{route("open_popup", ["page_name" => "warehouse.create"])}}');">
                <i class="bx bx-plus mr-1">
                </i>Add
                Warehouse
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Warehouses</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>WH Title</th>
                            <th>WH Contact Person</th>
                            <th>WH Contact#</th>
                            <th>WH Location</th>
                            <th>WH Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warehouses as $warehouse)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $warehouse->wh_title }}</td>
                            <td>{{ $warehouse->wh_contactperson }} </td>
                            <td>{{ $warehouse->wh_contactnumber }}</td>
                            <td>{{ $warehouse->wh_location }}</td>
                            <td>{!! status($warehouse->wh_status) !!}</td>
                            <td>
                            @can('EditWarehouse')
                                <a href="#" class="fadeIn animated bx bx-pencil bx-sm"
                                    onclick="showAjaxModal('{{route("warehouse.edit", ["id" => $warehouse->wh_id])}}');">
                                </a>
                                @endcan
                                @can('DeleteWarehouse')
                                <a href="#" class="fadeIn animated bx bx-trash bx-sm"
                                    onclick="confirm_modal('{{route("warehouse.delete", ["id" => $warehouse->wh_id])}}');">
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
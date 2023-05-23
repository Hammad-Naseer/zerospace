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
        <div class="breadcrumb-title pe-3">Suppliers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Suppliers</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="#" class="btn btn-primary px-5 radius-30"
                onclick="showAjaxModal('{{route("open_popup", ["page_name" => "vendor.create"])}}');">
                <i class="bx bx-plus mr-1">
                </i>Add
                Supplier
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Supplier</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Title</th>
                            <th>City</th>
                            <th>Mobile</th>
                            <th>Profile</th>
                            <th>Status</th>
                            <th>Product</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $vendor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $vendor->vend_name }}</td>
                            <td>{{ $vendor->vend_city }} </td>
                            <td>{{ $vendor->vend_mobile }}</td>
                            <td>
                                @if($vendor->vend_profile != "")
                                <a href="{{$vendor->vend_profile}}" target="_blank" >Goto Profile</a></td>
                                @endif
                                
                            <td>{!! status($vendor->vend_status) !!}</td>
                            <td>
                                @if($vendor->p_id != "")
                                {{ get_product_details($vendor->p_id)->p_name }}
                                @endif
                                
                            </td>
                            <td>
                                <!-- <a href="{{route('vendor.edit',$vendor->vend_id)}}"><i
                                        class="fadeIn animated bx bx-pencil bx-sm"></i></a>
                                <a href="{{route('vendor.delete',$vendor->vend_id)}}"><i
                                        class="fadeIn animated bx bx-trash bx-sm"></i></a> -->
                                @can('EditSupplier')
                                <a href="#" class="fadeIn animated bx bx-pencil bx-sm"
                                    onclick="showAjaxModal('{{route("vendor.edit", ["id" => $vendor->vend_id])}}');">
                                </a>
                                @endcan
                                @can('DeleteSupplier')
                                <a href="#" class="fadeIn animated bx bx-trash bx-sm"
                                    onclick="confirm_modal('{{route("vendor.delete", ["id" => $vendor->vend_id])}}');">
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
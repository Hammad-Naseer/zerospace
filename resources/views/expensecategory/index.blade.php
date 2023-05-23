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
        <div class="breadcrumb-title pe-3">Expense Categories</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Expense Categories</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="#" class="btn btn-primary px-5 radius-30"
                onclick="showAjaxModal('{{route("open_popup", ["page_name" => "expensecategory.create"])}}');">
                <i class="bx bx-plus mr-1">
                </i>Add
                Expense Category
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Expense Categories</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Category Title</th>
                            <th>Category Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expensecategories as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->exp_cat_title }}</td>
                            <td>{{ $row->exp_cat_code }}</td>
                            <td>
                            @can('EditExpenseCategory')
                                <a href="#" class="fadeIn animated bx bx-pencil bx-sm"
                                    onclick="showAjaxModal('{{route("expensecategories.edit", ["id" => $row->exp_cat_id  ])}}');">
                                </a>
                                @endcan
                                @can('DeleteExpenseCategory')
                                <a href="#" class="fadeIn animated bx bx-trash bx-sm"
                                    onclick="confirm_modal('{{route("expensecategories.delete", ["id" => $row->exp_cat_id  ])}}');">
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
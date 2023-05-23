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
        <div class="breadcrumb-title pe-3">Sales</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Sales</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

            <a href="{{route("sale.create")}}" target="_blank" class="btn btn-primary px-5 radius-30">
                <i class="bx bx-plus mr-1">
                </i>Add
                Sale
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Sales</h6>
    <hr />

    <form action="" method="GET">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-3">
                <label for="wh_id" class="form-label">Select Warehouse</label>
                <select name="wh_id" id="wh_id" class="single-select mb-3 form-control"
                    aria-label="Default select example">
                    {!! warehouse_dropdown($wh_id) !!}
                </select>
            </div>

            <div class="col-md-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value={{$start_date}} />
            </div>

            <div class="col-md-3">
                <label for="end_date" class="form-label">Start Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value={{$end_date}} />
            </div>

            <div class="col-md-6 mt-4">
                <button class="btn btn-primary btn-sm">Filter</button>
                @if($filter == 1)
                <a href="{{URL::to('view_sales')}}" class="btn btn-danger btn-sm">Remove Filter</a>
                @endif
            </div>
        </div>
    </form>

    <br>

    <div class="card">
        <div class="card-body">
            <div style="text-align:center;">
                Toggle column:
                <a class="toggle-vis btn btn-sm btn-primary" data-column="0">Sr.</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Invoice#</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Sale Date</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="3">Warehouse</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="4">Profit</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="5">Total Amount</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="6">Remarks</a>
            </div>
            <div class="table-responsive">

                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Invoice#</th>
                            <th>Sale Date</th>
                            <th>Warehouse</th>
                            <th>Profit</th>
                            <th>Total Amount</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->sales_invoice_no }}</td>
                            <td>{{ date_view($row->sales_date) }}</td>
                            <td>{{ get_warehouse_details($row->wh_id)->wh_title }}</td>
                            <td>{{ $row->total_profit }}</td>
                            <td>{{ $row->total_sales_amount }}</td>
                            <td>{{ $row->remarks }}</td>
                            <td>
                            @can('SaleShow')
                                <a href="{{route('sale.show', ['id' => $row->sales_id])}}"
                                    class="fadeIn animated lni lni-eye" target="_blank">
                                </a>
                                @endcan
                                <!-- <a href="{{-- route('sale.print', ['id' => $row->sales_id]) --}}"
                                    class="fadeIn animated lni lni-printer" target="_blank">
                                </a> -->
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

<script>
$(document).ready(function() {
    var table = $('#example').DataTable({
        lengthChange: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        dom: 'lBfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $('a.toggle-vis').on('click', function(e) {
        $(this).toggleClass("btn-primary");
        e.preventDefault();
        var column = table.column($(this).attr('data-column'));
        column.visible(!column.visible());
    });
});
</script>
@endsection
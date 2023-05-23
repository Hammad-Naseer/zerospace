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
        <div class="breadcrumb-title pe-3">Transfer Vouchers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Transfer Vouchers</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Transfer Vouchers</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div style="text-align:center;">
                    Toggle column:
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="0">Sr.</a>
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Stock Refrence Number</a>
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Stock Entry Date</a>
                </div>
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Stock Refrence Number</th>
                            <th>Warehouse From</th>
                            <th>Warehouse To</th>
                            <th>Stock Entry Date</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stock as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->stock_refrence_no }} </td>
                            <td>
                                @if( $row->wh_id_from != "")
                                {{ get_warehouse_details($row->wh_id_from)->wh_title }}
                                @else
                                Initially Added
                                @endif
                            </td>
                            <td>
                                @if( $row->wh_id_to != "")
                                {{ get_warehouse_details($row->wh_id_to)->wh_title }}
                                @endif
                            </td>
                            <td>{{ date_view($row->stock_entry_date) }}</td>
                            <td>
                            @can('InvoiceTransferStock')
                                <a href="{{route('stocktransferinvoice.show',$row->stock_id)}}" target="_blank"><i
                                        class="fadeIn animated lni lni-eye" style="font-size: x-large;"></i></a>
                            @endcan
                            @can('PrintTransferStock')
                                <a href="{{route('stocktransfer.print',$row->stock_id)}}" target="_blank"><i
                                        class="fadeIn animated lni lni-printer" style="font-size: x-large;"></i></a>
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
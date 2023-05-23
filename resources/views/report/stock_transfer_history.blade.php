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
        <div class="breadcrumb-title pe-3">Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Stocks Transfer History</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">Stock Transfer History</h6>
    <hr />
    <form action="" method="GET">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-3">
                <label for="wh_id" class="form-label">Warehouse</label>
                <select name="wh_id" id="wh_id" class="single-select  form-control" aria-label="Default select example">
                    @php
                    $wh_id="" ;
                    if(isset($_GET['wh_id']) && $_GET['wh_id'] != ""){
                    $wh_id = $_GET['wh_id'];
                    }
                    @endphp
                    {!! warehouse_dropdown($wh_id) !!}

                </select>
                @if ($errors->has('wh_id'))
                <span class="text-danger">{{ $errors->first('wh_id') }}</span>
                @endif
            </div>
            <div class="col-md-3 mt-4">
                <button class="btn btn-primary btn-sm">Filter</button>
                @if($filter == 1)
                <a href="{{URL::to('stock_transfer_history')}}" class="btn btn-danger btn-sm">Remove Filter</a>
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
                <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Item Details</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Barcode</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="3">WareHouse From</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="4">WareHouse To</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="5">Stock Transfer Qty</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="6">Stock Transfer Type</a>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Item detail</th>
                            <th>Barcode</th>
                            <th>WareHouse From</th>
                            <th>WareHouse To</th>
                            <th>Stock Transfer QTY</th>
                            <th>Stock Transfer Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stock_history as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-img">
                                        <img src="{{ asset('public/' .$row->item_img)}}" class="card-img-top" alt="...">
                                    </div>
                                    <div class="ms-2">
                                        <p class="mb-0">{{ get_item_details($row->item_id)->p_name }}</p>
                                        <p class="mb-0">{{$row->var_color}}</p>
                                        <p class="mb-0"> {{$row->var_size}}</p>
                                        <p class="mb-0">{{$row->var_material}}</p>
                                        <p class="mb-0">{{$row->var_weight}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <img src="{{ asset('public/' .$row->item_barcode_img)}}" class="card-img-top" alt="..." style="width:220px;">
                            </td>
                            <td>@if($row->wh_id_from != null)
                                {{ get_warehouse_details($row->wh_id_from)->wh_title}}
                                @endif
                            </td>
                            <td>
                                @if($row->wh_id_to != null)
                                {{ get_warehouse_details($row->wh_id_to)->wh_title}}
                                @endif
                            </td>
                            <td>{{$row->stock_transfer_qty}}</td>
                            <td>
                                @if($row->type == 1)
                                Stock Added
                                @elseif($row->type == 2)
                                Stock Trasfered
                                @elseif($row->type == 3)
                                Stock Sale
                                @endif

                            </td>
                            <td>{{date('d-M-Y H:i:s' , strtotime($row->created_at))}}</td>

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
// $('#wh_id').change(function() {
//     var wh_id = $(this).val();
//     var _token = $("input[name='_token']").val();
//     if (wh_id != '') {
//         $.ajax({
//             type: "POST",
//             url: "{{ route('get_product_items') }}",
//             data: ({
//                 _token: _token,
//                 wh_id: wh_id,
//             }),
//             dataType: "html",
//             success: function(response) {
//                 $("#item_id").html(response);
//             }
//         });
//     }
// });
$('#p_id').change(function() {
    var p_id = $(this).val();
    var wh_id = $(this).val();
    var item_id = $(this).val();
    var _token = $("input[name='_token']").val();
    if (p_id != '') {
        $.ajax({
            type: "POST",
            url: "{{ route('get_product_items') }}",
            data: ({
                _token: _token,
                p_id: p_id,
                wh_id: wh_id,
                item_id: item_id
            }),
            dataType: "html",
            success: function(response) {
                $("#item_id").html(response);
            }
        });
    }
});

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
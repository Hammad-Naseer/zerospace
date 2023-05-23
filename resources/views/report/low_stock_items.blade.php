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
                    <li class="breadcrumb-item active" aria-current="page">All Low Stock</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">Low Stock</h6>
    <hr />
    <br>
    <div class="card">
        <div class="card-body">
            <div style="text-align:center;">
                Toggle column:
                <a class="toggle-vis btn btn-sm btn-primary" data-column="0">Sr.</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Item Sr</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Items</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="3">Alert QTY</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="4">Available Stock</a>
            </div>
            <div class="table-responsive">

                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Item Sr</th>
                            <th>Items</th>
                            <th>Alert QTY</th>
                            <th>Available Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($low_stock as $item_stats)

                        <tr class="active-row">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item_stats->item_serial_no}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-img">
                                        <img src="{{ asset('public/' .$item_stats->item_img)}}" alt="" />
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-1">{{ $item_stats->p_name}}</h6>
                                        @if($item_stats->var_color !="")
                                        {{$item_stats->var_color}}</br>
                                        @endif

                                        @if($item_stats->var_size !="")
                                        {{$item_stats->var_size}}</br>
                                        @endif

                                        @if($item_stats->var_material !="")
                                        {{$item_stats->var_material}}</br>
                                        @endif

                                        @if($item_stats->var_weight !="")
                                        {{$item_stats->var_weight}}</br>
                                        @endif

                                    </div>
                                </div>
                            </td>
                            <td>{{ $item_stats->p_alert_qty}}</td>
                            <td>{{ $item_stats->available_stock}}</td>

                           
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
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
                    <li class="breadcrumb-item active" aria-current="page">All Stocks Pricing Details</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">Pricing Detail</h6>
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
                <a href="{{URL::to('stock_price_detail')}}" class="btn btn-danger btn-sm">Remove Filter</a>
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
                <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Item</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="2">WareHouse</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="3">Total Investment</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="4">Total Purchase Price</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="5">Total Sale Price</a>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Items Details</th>
                            <th>Item img</th>
                            <th>WareHouse</th>
                            <th>Total Investment</th>
                            <th>Total Purchase</th>
                            <th>Total Expected Sale</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_investment = 0;
                        $total_purchase = 0;
                        $total_sale = 0;
                        @endphp
                        @foreach ($stock_price_detail as $row)
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
                                <img src="{{ asset('public/' .$row->item_barcode_img)}}" class="card-img-top" alt="..."
                                    style="width:220px;">
                            </td>

                            <td>
                                {{get_warehouse_details($row->wh_id)->wh_title}}
                            </td>
                            <td>
                                @php
                                $total_investment += $row->total_investment
                                @endphp
                                {{$row->total_investment}}
                            </td>
                            <td>
                                @php
                                $total_purchase += $row->total_purchase_price
                                @endphp
                                {{$row->total_purchase_price}}
                            </td>
                            <td>
                                @php
                                $total_sale += $row->total_sale_price
                                @endphp
                                {{$row->total_sale_price}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" > <strong>Total : </strong> </td>
                            <td><strong> {{$total_investment}} </strong></td>
                            <td><strong> {{$total_purchase}} </strong></td>
                            <td><strong> {{$total_sale}} </strong></td>
                        </tr>
                    </tfoot>
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
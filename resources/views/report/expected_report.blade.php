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
        <div class="breadcrumb-title pe-3">Expected Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Expected Report</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">Expected Report</h6>
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
            <div class="col-md-3">
                <label for="p_id" class="form-label">Select Product</label>
                <select name="p_id" id="p_id" class="single-select mb-3 form-control"
                    aria-label="Default select example">
                    {!! product_dropdown() !!}
                </select>
            </div>
            <div class="col-lg-3">
                <label for="item_id" class="form-label">Item</label>
                <select name="item_id" id="item_id" class="single-select  form-control"
                    aria-label="Default select example">
                    <!-- {!! items_dropdown() !!} -->
                </select>
            </div>
            <div class="col-md-3 mt-4">
                <button class="btn btn-primary btn-sm">Filter</button>
                @if($filter == 1)
                <a href="{{URL::to('expected_report')}}" class="btn btn-danger btn-sm">Remove Filter</a>
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
                <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Items</a>
                <!-- <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Barcode</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="3">Details</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="4">Shp Details</a> -->
                <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Qty</a>
                <!-- <a class="toggle-vis btn btn-sm btn-primary" data-column="6">Carton</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="7">Price/China</a> -->
                <a class="toggle-vis btn btn-sm btn-primary" data-column="3">Cost/Unit</a>
                <!-- <a class="toggle-vis btn btn-sm btn-primary" data-column="9">Amazon Fee</a> -->
                <a class="toggle-vis btn btn-sm btn-primary" data-column="4">Sale Price</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="5">Unit Profit</a>
                <!-- <a class="toggle-vis btn btn-sm btn-primary" data-column="12">Profit %</a> -->
                <a class="toggle-vis btn btn-sm btn-primary" data-column="6">Expected Sale</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="7">Monthly Profit Expected</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="8">Total Expected Profit</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="9">Total Expected Listing Value</a>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Items</th>
                            <!-- <th style="width:200px">Barcode</th> -->
                            <!-- <th style="width:200px">Details</th> -->
                            <!-- <th style="width:100px">Shp Details</th> -->
                            <th style="width:100px">Qty</th>
                            <!-- <th style="width:80px">Carton</th> -->
                            <!-- <th style="width:80px">Price/China</th> -->
                            <th style="width:80px">Cost/Unit</th>
                            <!-- <th style="width:80px">Amazon Fee</th> -->
                            <th style="width:80px">Sale Price</th>
                            <th style="width:80px">Unit Profit</th>
                            <!-- <th style="width:80px">Profit %</th> -->
                            <!-- <th style="width:100px">Total Cost</th> -->
                            <th style="width:100px">Expected Sale</th>
                            <th style="width:100px">Monthly Profit Expected</th>
                            <th style="width:80px">Total Expected Profit</th>
                            <th style="width:80px">Total Expected Listing Value</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_qty = 0;
                        $total_carton = 0;
                        $total_purchas_price = 0;
                        $total_cost_per_unit = 0;
                        $total_amazon_fee = 0;
                        $total_sale_price = 0;
                        $total_unit_profit = 0;
                        $total_profit_percentage = 0;
                        $total_cost = 0;
                        

                        $total_expected_sale = 0;
                        $total_monthly_expected_profit = 0;
                        $total_expected_profit = 0;
                        $total_expected_listing_value = 0;
                        @endphp

                        @foreach ($stock as $row)
                        @php
                        $item_stockchargesdetails = get_item_stockchargesdetails( $row->item_id);
                        @endphp
                        <tr>
                            <td>{{ $row->item_serial_no }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-img">
                                        <img src="{{ asset('public/' .$row->item_img)}}" class="card-img-top" alt="...">
                                    </div>
                                    <div class="ms-2">
                                        <p class="mb-0">{{ get_item_details($row->item_id)->p_name }}</p>
                                        @if($row->var_color !="")
                                        <p class="mb-0">{{$row->var_color}}</p>
                                        @endif

                                        @if($row->var_size !="")
                                        <p class="mb-0"> {{$row->var_size}}</p>
                                        @endif

                                        @if($row->var_material !="")
                                        <p class="mb-0">{{$row->var_material}}</p>
                                        @endif

                                        @if($row->var_weight !="")
                                        <p class="mb-0">{{$row->var_weight}}</p>
                                        @endif

                                    </div>
                                </div>
                            </td>
                            <!-- <td>
                                <img src="{{-- asset('public/' .$row->item_barcode_img) --}}" class="card-img-top" alt="..."
                                    style="width:150px;">
                            </td> -->
                            <!-- <td>
                                <strong>Warehouse : </strong> {{ get_warehouse_details($row->wh_id)->wh_title }} </br>
                                <strong>Ref # : </strong> {{ $row->stock_refrence_no }} </br>
                                <strong>Entry Date : </strong> {{ date_view($row->stock_entry_date) }}
                            </td> -->
                            <!-- <td>
                                <strong>CBM : </strong> {{ $item_stockchargesdetails->cbm  }} </br>
                                <strong>UAE Shp : </strong> {{ $item_stockchargesdetails->shiping_uae }} </br>
                            </td> -->
                            <td>
                                @php
                                $total_qty += $row->stock_qty
                                @endphp
                                {{ $row->stock_qty }}
                            </td>
                            <!-- <td>
                            </td> -->
                            <!-- <td>
                                @php
                                $total_purchas_price += $row->item_pur_price;
                                @endphp
                                {{ $row->item_pur_price }}
                            </td> -->
                            <td>
                                @php
                                $total_cost_per_unit += $row->cost_per_unit;
                                @endphp
                                {{ $row->cost_per_unit }}
                            </td>
                            <!-- <td>
                                @php
                                $amazon_fee = $item_stockchargesdetails->amazon_fee;
                                $total_amazon_fee += $amazon_fee
                                @endphp
                                {{ $amazon_fee }}
                            </td> -->
                            <td>
                                @php
                                $total_sale_price += $row->item_sale_price
                                @endphp
                                {{ $row->item_sale_price }}
                            </td>
                            <td>
                                @php
                                $unit_profit = $row->item_sale_price - ($row->cost_per_unit + $amazon_fee );
                                $total_unit_profit += $unit_profit;
                                @endphp
                                {{ $unit_profit }}
                            </td>
                            <!-- <td>
                                @php
                                $profit_percentage = round((($row->item_sale_price - ($row->cost_per_unit + $amazon_fee ) ) /   $row->item_sale_price ) * 100 , 2);
                                $total_profit_percentage += $profit_percentage
                                @endphp
                                {{$profit_percentage }}

                            </td> -->

                            <!-- <td>
                            @php

                            $cost = ($row->stock_qty * $row->cost_per_unit);
                            $total_cost += $cost;
                            @endphp
                            {{  $cost }}
                            </td> -->
                            <td>
                                @php
                                $expected_sale = ($row->stock_qty * $row->item_sale_price);
                                $total_expected_sale += $expected_sale;
                                @endphp
                                {{  $expected_sale }}
                            </td>

                            <td>
                                @php
                                $monthly_expected_profit = ($unit_profit * 45);
                                $total_monthly_expected_profit += $monthly_expected_profit;
                                @endphp
                                {{  $monthly_expected_profit }}
                            </td>
                            <td>
                                @php
                                $expected_profit = round(($row->item_sale_price - ($row->cost_per_unit + $amazon_fee ))
                                * $row->stock_qty , 2);
                                $total_expected_profit += $expected_profit;
                                @endphp
                                {{  $expected_profit }}
                            </td>

                            <td>
                                @php
                                $expected_listing_value = round(($row->item_sale_price - $amazon_fee )  * $row->stock_qty , 2);
                                $total_expected_listing_value += $expected_listing_value;
                                @endphp
                                {{ $expected_listing_value }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="6">Total : </td>
                            <td>{{$total_expected_sale}}</td>
                            <td>{{$total_monthly_expected_profit}}</td>
                            <td>{{$total_expected_profit}}</td>
                            <td>{{$total_expected_listing_value}}</td>
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
    // $('.wrapper').addClass('toggled');
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
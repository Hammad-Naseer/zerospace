@extends('layouts.app')

@section('content')

<!--sidebar wrapper -->
@include('partials.sidebar')
<!--end sidebar wrapper -->

<!--start header -->
@include('partials.topbar')
<!--end header -->

<style>
#main {
    font-family: Helvetica, Arial, sans-serif;
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid black;
    font-size: 14px;
    margin-top: 10px;
}

td,
th {
    transition: all 0.3s;
    padding-left: 3px;
    border: 1px solid black;
}

th {
    font-weight: bold;
}

@page {
    margin: 10px 10px 30px 10px
}

hr {
    margin: 0px;
    padding: 0px;
    display: block;
    height: 1px;
    background: transparent;
    width: 100%;
    border: none;
    border-top: solid 1px #000;
}

.card-body {
    border: 1px solid #aba3a3;
    border-radius: 10px;
    box-shadow: 10px 5px 15px #aba3a3;
}
</style>
<div class="page-content">
    <div class="card" style="padding: 10px 200px 10px 200px;;">
        <div class="card-body p-4">
            <h5 class="card-title" style="margin-left:350px;"><span
                    style="font-size: 24px; letter-spacing: 2px;"><strong>Stock Transfer Detail View</strong></span>
            </h5>
            <hr />
            <div class="form-body mt-4">
                <div style="width: 100%;margin-top: 0px; margin-left: 4px;">
                    <span style="font-size: 18px; letter-spacing: 2px;"><strong>ZERO SPACE</strong></span><br>
                    <span style="font-size: 14px;"> DUBAI , XYZ<br>
                        030053251487</span><br>
                </div>
                <!-- info row -->
                <fieldset style="border-radius: 5px;">
                    <legend>Warehouse Info:</legend>
                    <div style="width: 100%; height: 100px; margin-top: 10px; padding: 5px 5px -5px 5px; border-top: 1px solid black;
                border-bottom: 1px solid black;border-radius: 5px;">
                        @if($stock[0]->type == 1)
                        <div style="float: left;">

                            <address style="font-size: 14px;">
                                @php
                                $warehouse = get_warehouse_details($stock[0]->wh_id_to);
                                @endphp
                                <strong>
                                    {{ $warehouse->wh_title}}
                                </strong>
                                @if($warehouse->wh_contactperson !="")
                                <br>
                                <span>{{ $warehouse->wh_contactperson}} </span>
                                @endif
                                @if($warehouse->wh_contactnumber !="")
                                <br>
                                <span>{{ $warehouse->wh_contactnumber}} </span>
                                @endif
                                <br>
                                <span>{{ $warehouse->wh_location}} </span><br>
                            </address>
                        </div>
                        @else
                        <div style="float: left;">

                            <address style="font-size: 14px;">
                                @php
                                $warehouse_from = get_warehouse_details($stock[0]->wh_id_from);
                                @endphp
                                <strong>
                                    From:
                                </strong>
                                <strong>
                                    {{ $warehouse_from->wh_title}}
                                </strong>
                                @if($warehouse_from->wh_contactperson !="")
                                <br>
                                <span>{{ $warehouse_from->wh_contactperson}} </span>
                                @endif
                                @if($warehouse_from->wh_contactnumber !="")
                                <br>
                                <span>{{ $warehouse_from->wh_contactnumber}} </span>
                                @endif
                                <br>
                                <span>{{ $warehouse_from->wh_location}} </span><br>
                            </address>
                        </div>

                        <div style="float: left;margin-left: 60px;">

                            <address style="font-size: 14px;">
                                @php
                                $warehouse = get_warehouse_details($stock[0]->wh_id_to);
                                @endphp
                                <strong>
                                    To:
                                </strong>
                                <strong>
                                    {{ $warehouse->wh_title}}
                                </strong>
                                @if($warehouse->wh_contactperson !="")
                                <br>
                                <span>{{ $warehouse->wh_contactperson}} </span>
                                @endif
                                @if($warehouse->wh_contactnumber !="")
                                <br>
                                <span>{{ $warehouse->wh_contactnumber}} </span>
                                @endif
                                <br>
                                <span>{{ $warehouse->wh_location}} </span><br>
                            </address>
                        </div>
                        @endif

                        <!-- /.col -->
                        <div style="float: right;">
                            <span>Stock Transfer Ref #: {{ $stock[0]->stock_refrence_no }} </span><br>
                            <span style="font-size: 14px;">Date: {{ date_view($stock[0]->stock_entry_date) }}
                            </span><br>
                            <span style="font-size: 14px;">Type:
                                @if($stock[0]->type == 1)
                                Stock Added
                                @else
                                Stock Transfer
                                @endif
                            </span><br>

                        </div>
                    </div>
                </fieldset>
                <table border="1" id="main">
                    <thead>
                        <tr>
                            <td>Img</td>
                            <td>Barcode</td>
                            <td>Item</td>
                            <td>Quantity</td>
                            <td>Pieces/Carton</td>
                            <td>Carton</td>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_qty = 0;
                        $total_carton = 0;
                        @endphp
                        @foreach($stock as $row)
                        <tr>
                            <td><img src="{{ asset('public/' .$row->item_img) }}" class="card-img-top" alt="..."
                                    style="width: 80px; height: 80px"> </td>
                            <td><img src="{{ asset('public/' .$row->item_barcode_img) }}" class="card-img-top" alt="..."
                                    style="width: 250px; height: 100px"> </td>
                            <td>
                                Item: {!! get_item_details($row->item_id)->p_name !!}</br>
                                @if($row->var_color !="")
                                Color: {{$row->var_color}}</br>
                                @endif

                                @if($row->var_size !="")
                                Size: {{$row->var_size}}</br>
                                @endif

                                @if($row->var_material !="")
                                Material: {{$row->var_material}}</br>
                                @endif

                                @if($row->var_weight !="")
                                Weight: {{$row->var_weight}}</br>
                                @endif
                            </td>
                            <td>{{$row->stock_transfer_qty}} @php $total_qty +=$row->stock_transfer_qty @endphp</td>
                            <td>{{$row->p_units_in_carton}} </td>
                            <td>{{ round($row->stock_transfer_qty/$row->p_units_in_carton, 2)}} @php $total_carton +=
                                $row->stock_transfer_qty/$row->p_units_in_carton @endphp</td>

                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <td colspan="5"> </td>
                    </tr>
                    <tr>
                        <td colspan="3"> Total</td>
                        <td>{{ $total_qty }}</td>
                        <td></td>
                        <td>{{ round($total_carton, 2) }}</td>
                    </tr>
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
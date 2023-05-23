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
    <div class="card" style="min-height: 800px;">
        <div class="card-body p-4">
            <h5 class="card-title" style="margin-left:350px;"><span style="font-size: 24px; letter-spacing: 2px;"><strong>Sale Invoice Detail View</strong></span>
            </h5>
            <hr />
            <div class="form-body mt-4">

                <div style="margin-top: 0px; margin-left: 4px;">
                    <div style="float: left;">
                        <span style="font-size: 20px; letter-spacing: 2px; color:#9f1d1d;"><strong>StandOut FZE
                                LLC</strong></span><br>
                        <span style="font-size: 14px;">Business Center, Sharjah Publishing</span><br>
                        <span style="font-size: 14px;"> City Free Zone, Sharjah, UAE</span><br>
                        <span style="font-size: 14px;">Email: khurram1988@outlook.com</span><br>
                        <span style="font-size: 14px;">Mobile: +971 56 561 7640</span><br><br>
                    </div>

                    <div style="float: right; clear: both;">
                        <span style="font-size: 20px; letter-spacing: 2px; color:#9f1d1d; text-decoration: underline;"><strong>Sales
                                Invoice</strong></span><br>
                        <span style="font-size: 14px; float:right;">Sales Ref #:
                            {{ $sales[0]->sales_invoice_no }}</span><br>
                        <span style="font-size: 14px; float:right;">Date:
                            {{ date_view($sales[0]->sales_date) }}</span><br> <br>
                    </div>
                </div>
                <!-- info row -->

                <div style="margin-top: 0px; margin-left: 4px; clear: both;">
                    <div style="width: 100%;border: 1px solid #0a0a0a;margin-top: 15px;border-radius: 5px;">
                        <span style="font-size: 20px; letter-spacing: 2px; color:#9f1d1d; margin-left:15px;">
                            <strong>Warehouse</strong></span><br>
                        <span style="font-size: 14px;padding-left: 15px;">{{ get_warehouse_details($sales[0]->wh_id)->wh_title }}</span><br>
                        <span style="font-size: 14px;padding-left: 15px;">{{ get_warehouse_details($sales[0]->wh_id)->wh_contactperson }}
                        </span><br>
                        <span style="font-size: 14px;padding-left: 15px;">{{ get_warehouse_details($sales[0]->wh_id)->wh_contactnumber }}</span><br>
                    </div>
                </div>

                <table border="1" id="main">
                    <thead>
                        <tr>
                            <td>Img</td>
                            <td>Barcode</td>
                            <td>Item</td>
                            <td>Sale QTY</td>
                            <td>Pieces/Carton</td>
                            <td>Carton</td>
                            <td>Sale Price</td>
                            <td>Sale Item Profit</td>
                            <td>Sub Total</td>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_qty = 0;
                        $total_carton = 0;
                        @endphp
                        @foreach($sales as $row)
                        <tr>
                            <td><img src="{{ asset('public/' .$row->item_img) }}" class="card-img-top" alt="..." style="width: 80px; height: 80px"> </td>
                            <td><img src="{{ asset('public/' .$row->item_barcode_img) }}" class="card-img-top" alt="..." style="width: 250px; height: 100px"> </td>
                            <td>
                                Item: {!! get_item_details($row->item_id)->p_name !!}</br>
                                @if($row->var_color !="")
                                {{$row->var_color}}</br>
                                @endif

                                @if($row->var_size !="")
                                {{$row->var_size}}</br>
                                @endif

                                @if($row->var_material !="")
                                {{$row->var_material}}</br>
                                @endif

                                @if($row->var_weight !="")
                                {{$row->var_weight}}</br>
                                @endif


                            </td>
                            <td>{{$row->sale_qty}} @php $total_qty +=$row->sale_qty @endphp</td>
                            <td>{{$row->p_units_in_carton}} </td>
                            <td>{{ round($row->sale_qty/$row->p_units_in_carton, 2)}} @php $total_carton +=
                                $row->sale_qty/$row->p_units_in_carton @endphp</td>
                            <td>{{$row->sale_price}}</td>
                            <td>{{$row->sale_item_profit}}</td>
                            <td>{{$row->sub_total}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <td colspan="3"> Total</td>
                        <td>{{ $total_qty }}</td>
                        <td></td>
                        <td>{{ round($total_carton, 2) }}</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="9"></td>
                    </tr>
                    <tr>
                        <td colspan="9"></td>
                    </tr>
                    <tr>
                        <td colspan="5">Remarks</td>
                        <td colspan="4">{{$sales[0]->remarks}}</td>
                    </tr>

                    <tr>
                        <td colspan="5">Total Profit</td>
                        <td colspan="4">{{$sales[0]->total_profit}}</td>
                    </tr>
                    <tr>
                        <td colspan="5">Total Sales Amount</td>
                        <td colspan="4">{{$sales[0]->total_sales_amount}}</td>
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
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
        <div class="breadcrumb-title pe-3">Purchase Order</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Purchase Order</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Purchase Order</h5>
            <hr />

            <div class="form-body mt-4">
                <div style="width: 100%;margin-top: 0px; margin-left: 4px;">
                    <span style="font-size: 18px; letter-spacing: 2px;"><strong>ZERO SPACE</strong></span><br>
                    <span style="font-size: 12px;"> DUBAI , XYZ<br>
                        030053251487</span><br>
                </div>
                <!-- info row -->
                <fieldset style="border-radius: 5px;">
                    <legend>Supplier Info:</legend>
                    <div style="width: 100%; height: 100px; margin-top: 15px; padding: 5px 5px -5px 5px; border-top: 1px solid black;
                    border-bottom: 1px solid black;border-radius: 5px;padding: 5px 10px 5px 10px;">
                        <div style="float: left;">
                            <address style="font-size: 12px;">
                                <strong>
                                    Name : {{ get_vendor_details($purchase[0]->vend_id)->vend_name }}
                                </strong><br>
                                <span>City : {{ get_vendor_details($purchase[0]->vend_id)->vend_city }} </span><br>
                                <span>Contact # : {{ get_vendor_details($purchase[0]->vend_id)->vend_mobile }}
                                </span><br>
                                <span>Profile : <a href="{{ get_vendor_details($purchase[0]->vend_id)->vend_profile }}" target="_blank">Goto Profile</a> 
                                </span><br>

                            </address>
                        </div>
                        <!-- /.col -->
                        <div style="float: right;">
                            <span>Purchase Ref #: {{ $purchase[0]->pur_refrence_no }} </span><br>
                            <span style="font-size: 12px;">Date: {{ date_view($purchase[0]->pur_date) }} </span><br>
                            <span style="font-size: 12px;">Status: {!! purchase_status($purchase[0]->pur_status) !!}
                            </span><br>
                        </div>
                    </div>
                </fieldset>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Sr.</td>
                            <td>Img</td>
                            <td>Barcode</td>
                            <td><label>Item</label></td>
                            <td style="width: 150px;"><label>Pur Price</label></td>
                            <td style="width: 150px;"><label>Units/Carton</label></td>
                            <td style="width: 150px;"><label>Pur QTY</label></td>
                            <td style="width: 150px;"><label>Cartons QTY</label></td>
                            <td style="width: 150px;"><label>Sub Total</label></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchase_detail as $row)
                        <tr>
                            <td>{{ $row->item_serial_no}}</td>
                            <td><img src="{{ asset('public/' .$row->item_img) }}" class="card-img-top" alt="..."
                                    style="width: 80px; height: 80px"> </td>
                            <td><img src="{{ asset('public/' .$row->item_barcode_img) }}" class="card-img-top" alt="..."
                                    style="width: 250px; height: 100px"> </td>
                            <td>
                                @if($row->item_id !="")
                                Item: {!! get_item_details($row->item_id)->p_name !!}</br>
                                @endif

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
                            <td>
                                {{ $row->item_purchase_price }}
                            </td>
                            <td>
                                {{ $row->units_in_carton }}
                            </td>
                            <td>
                                {{ $row->pur_item_qty }}
                            </td>
                            <td>
                                {{ $row->carton_qty }}
                            </td>
                            <td>
                                {{ $row->sub_total_amount }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="padding-top: 10px;">

                    <div style="width: 40%;">
                        Remarks : {{ $purchase[0]->remarks }}
                    </div>


                    <div style="width: 40%; float: right;">
                        <table style="font-size: 14px;">

                            <tr>
                                <th>Purchase Total:</th>
                                <td>{{ $purchase[0]->pur_total_amount }}</td>
                            </tr>
                            <tr>
                                <th>Alibaba Charges :</th>
                                <td>{{ $purchase[0]->alibaba_charges }}</td>
                            </tr>
                            <tr>
                                <th>Shipping Charges:</th>
                                <td>{{ $purchase[0]->shipping_charges }}</td>
                            </tr>
                            <tr>
                                <th>Miscellaneous Charges:</th>
                                <td>{{ $purchase[0]->miscellaneous_charges }}</td>
                            </tr>
                            <tr>
                                <th>Total Amount:</th>
                                <td>{{ $purchase[0]->pur_total_amount  +  $purchase[0]->alibaba_charges + $purchase[0]->shipping_charges + $purchase[0]->miscellaneous_charges}}
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>


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
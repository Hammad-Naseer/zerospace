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
        <div class="breadcrumb-title pe-3">Purchase Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Purchase Orders</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

            <a href="{{URL::to('/create_purchase')}}" class="btn btn-primary px-5 radius-30">
                <i class="bx bx-plus mr-1">
                </i>Add
                Purchase Order
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Purchase Orders</h6>
    <hr />
    <div class="row">
        <div class="col-md-3">
            <label class="form-label">Supplier</label>
            <select class="form-control" name="supply_id" id="supply_id">
                {!! vendor_dropdown() !!}
            </select>
        </div>

        <!-- <div class="col-md-6 mt-3">
            <button class="btn btn-primary">Filter</button>
        </div> -->

    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Refrence #</th>
                            <th>Supplier</th>
                            <th>Date</th>
                            <th>Document</th>
                            <th>Status</th>
                            <th>Purchase Amount</th>
                            <th>Other Charges</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody1">
                        @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $purchase->pur_refrence_no }}</td>
                            <td>{{ get_vendor_details($purchase->vend_id)->vend_name }} </td>
                            <td>{{ date_view($purchase->pur_date) }}</td>
                            <td>
                                @php
                                $purchase_documents = get_purchase_documents($purchase->pur_id);
                                @endphp
                                @if($purchase_documents != "")
                                @foreach($purchase_documents as $doc => $d)
                                <a target="_blank" href="{{ url($d->pur_document) }}"> <i class="lni lni-download">
                                    </i></a>
                                @endforeach
                                @endif
                            </td>
                            <td>{!! purchase_status($purchase->pur_status) !!}
                            <br>
                            <b>Transit Date:</b>@if($purchase->transit_date != "")
                            {{$purchase->transit_date}}
                            @endif
                            <br>
                            <b>Received Date:</b>   @if($purchase->received_date != "")
                            {{$purchase->received_date}}
                            @endif
                            </td>
                            <td>{{ $purchase->pur_total_amount }}</td>
                            <td>
                                Alibaba Chr : {{ $purchase->alibaba_charges }}
                                <br>
                                Ship Chr : {{ $purchase->shipping_charges }}
                                <br>
                                Misc Chr : {{ $purchase->miscellaneous_charges }}
                                <br>
                                @php
                                $total_charges = $purchase->alibaba_charges + $purchase->shipping_charges +
                                $purchase->miscellaneous_charges

                                @endphp
                                Total Chr : {{$total_charges}}
                            </td>
                            <td>
                                @php
                                $total_amount = $total_charges + $purchase->pur_total_amount;
                                @endphp
                                {{ $total_amount }}</td>
                            <td>
                            @can('EditPurchaseOrder')
                                <a href="{{route('purchase.edit',$purchase->pur_id)}}"><i
                                        class="fadeIn animated bx bx-pencil bx-sm"></i></a>
                            @endcan
                            @can('DeletePurchaseOrder')
                                <a href="#" class="fadeIn animated bx bx-trash bx-sm"
                                    onclick="confirm_modal('{{route("purchase.delete", ["id" => $purchase->pur_id])}}');">
                                </a>
                            @endcan
                            @can('ViewPurchaseOrder')
                                <a href="{{route('purchase.show',$purchase->pur_id)}}" target="_blank"><i
                                        class="fadeIn animated lni lni-eye" style="font-size: x-large;"></i></a>
                            @endcan
                            @can('PrintPurchaseOrder')
                                <a href="{{route('purchase.print',$purchase->pur_id)}}" target="_blank"><i
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
    $('#supply_id').on('change', function() {
        var supply_id = $(this).val();
        var html = '';
        $.ajax({
            url: "{{route('filter')}}",
            type: "GET",
            data: {
                'supply_id': supply_id
            },
            success: function(data) {
                console.log(data);
                var purchases = data.purchases;
                if (purchases.length > 0) {
                    for (let i = 0; i < purchases.length; i++) {
                        html += '<tr>\
                        <td> ' + (i + 1) + '</td>\
                        <td> ' + purchases[i]['pur_refrence_no'] + '</td>\
                        <td> ' + purchases[i]['vend_id'] + '</td>\
                        <td> ' + purchases[i]['pur_date'] + '</td>\
                        <td> ' + purchases[i]['pur_document'] + '</td>\
                        <td> ' + purchases[i]['pur_status'] + '</td>\
                        <td> ' + purchases[i]['pur_total_amount'] + '</td>\
                        <td> ' + purchases[i]['miscellaneous_charges'] + '</td>\
                        <td> ' + purchases[i]['shipping_charges'] + '</td>\
                        </tr>';
                    }
                }

                $("#tbody1").html(html);

            }

        });
    })
});
</script>
@endsection
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
        <div class="breadcrumb-title pe-3">Purchases</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Purchase</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Purchase</h5>
            <hr />

            <div class="form-body mt-4">

                <form action="{{ route('purchase.update',$purchase->pur_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <div class="border border-3 p-4 rounded">
                            <div class="row">
                                <div class="col-md-3 mt-4">
                                    <label for="pur_refrence_no" class="form-label">Refrence No</label>

                                    <input type="text" name="pur_refrence_no" class="form-control" id="pur_refrence_no" placeholder="Refrence No" value="{{$purchase->pur_refrence_no}}" readonly>
                                    @if ($errors->has('pur_refrence_no'))
                                    <span class="text-danger">{{ $errors->first('pur_refrence_no') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-3 mt-4">
                                    <label for="vend_id" class="form-label">Supplier</label> <span class="text-danger">*</span>
                                    <select name="vend_id" id="vend_id" class="single-select  form-control" aria-label="Default select example" required>
                                        {!! vendor_dropdown($purchase->vend_id) !!}
                                    </select>
                                    @if ($errors->has('vend_id'))
                                    <span class="text-danger">{{ $errors->first('vend_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-3 mt-4">
                                    <label for="pur_date" class="form-label">Purchase Date</label> <span class="text-danger">*</span>
                                    <input type="date" name="pur_date" class="form-control date-input" id="pur_date" placeholder="Purchase Date" value="{{$purchase->pur_date}}" required>
                                    @if ($errors->has('pur_date'))
                                    <span class="text-danger">{{ $errors->first('pur_date') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-3 mt-4">
                                <label for="pur_status" class="form-label">Purchase Status</label>
                                <span class="text-danger">*</span>
                                {!! purchase_status_dropdown("$purchase->pur_status", "pur_status", "pur_status", ["id" => "status-select", "class" => "status-select"]) !!}
                                @if ($errors->has('pur_status'))
                                <span class="text-danger">{{ $errors->first('pur_status') }}</span>
                                @endif
                                </div>

                                <div class="col-md-3 mt-4">
                                <label for="transit_date" class="form-label">Transit Date</label>
                                <input type="date" class="form-control date-input" name="transit_date" id="transit_date">
                                </div>

                                <div class="col-md-3 mt-4">
                                <label for="received_date" class="form-label">Received Date</label>
                                <input type="date" class="form-control date-input" name="received_date" id="received_date">
                                </div>

                                <div class="col-md-3 mt-4">
                                    <label for="pur_document" class="form-label">Purchase Document</label>
                                    <input type="file" name="pur_document[]" class="form-control" id="pur_document" placeholder="Purchase Document" multiple="multiple">
                                    @php
                                    $purchase_documents = get_purchase_documents($purchase->pur_id);
                                    @endphp
                                    @if($purchase_documents != "")
                                    OLD DOCUMENTS : 
                                    @foreach($purchase_documents as $doc => $d)
                                    <a target="_blank" href="{{ url($d->pur_document) }}"> <i class="lni lni-download">
                                        </i></a>
                                    @endforeach
                                    @endif
                                    <!-- <input type="hidden" name="pur_doc_old" value="{{-- $purchase->pur_document --}}"> -->
                                </div>
                               
                                
                                <div class="mb-3 col-lg-12 mt-4">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea name="remarks" class="form-control" id="remarks" placeholder="Remarks" rows="5">{{$purchase->remarks}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-4 mb-2 variants">
                        <div class="border border-3 p-4 rounded">
                            <div class="row g-3">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed" id="myTable">
                                        <tr>
                                            <td><label>Item</label></td>
                                            <td style="width: 150px;"><label>Pur Price</label></td>
                                            <td style="width: 150px;"><label>Units/Carton</label></td>
                                            <td style="width: 150px;"><label>Pur QTY</label></td>
                                            <td style="width: 150px;"><label>Cartons QTY</label></td>
                                            <td style="width: 150px;"><label>Sub Total</label></td>
                                            <td style="width: 50px;"></td>
                                            <td style="width: 50px;"></td>
                                        </tr>
                                        @foreach($purchase_detail as $row)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="pur_detail_id" value="{{$row->pur_detail_id}}" class="form-control">
                                                <select name="item_id[]" id="item_id" onchange="get_item_details(this)" class="single-select mb-3 form-control example" aria-label="Default select example" required>
                                                    {!! items_dropdown($row->item_id) !!}
                                                </select>
                                            </td>
                                            <td>
                                                <input type="any" name="item_pur_price[]" class="form-control" id="item_pur_price" value="{{$row->item_purchase_price}}" required>
                                            </td>
                                            <td>
                                                <input type="text" name="units_in_carton[]" class="form-control" id="units_in_carton" value="{{$row->units_in_carton}}" required>
                                            </td>
                                            <td>
                                                <input type="text" name="pur_item_qty[]" onkeyup="calculate_sub_total_carton(this)" class="form-control" id="pur_item_qty" value="{{$row->pur_item_qty}}" required>
                                            </td>
                                            <td>
                                                <input type="any" name="carton_qty[]" class="form-control" id="carton_qty" value="{{$row->carton_qty}}" required>
                                            </td>
                                            <td>
                                                <input type="any" name="sub_total_amount[]" class="form-control" id="sub_total_amount" value="{{$row->sub_total_amount}}" required>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" id="add_row"><i class="lni lni-circle-plus"></i></button>
                                            </td>
                                            <td>
                                                <button type="button" class='btn btn-danger btn-sm pull-left' name='btnRemove[]' id='btnRemove_' onclick='remove_row(this)'><i class='lni lni-cross-circle'></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="mt-4 col-lg-8">
                            <div class="row mb-3">
                                <label for="alibaba_charges" class="col-sm-3 col-form-label">Alibaba Charges <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="any" name="alibaba_charges" class="form-control" id="alibaba_charges" placeholder="Alibaba Charges" value="{{$purchase->alibaba_charges}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="shipping_charges" class="col-sm-3 col-form-label">Shipping Charges (inside
                                    China) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="any" name="shipping_charges" class="form-control" id="shipping_charges" placeholder="Shipping Charges" value="{{$purchase->shipping_charges}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="miscellaneous_charges" class="col-sm-3 col-form-label">Miscellaneous
                                    Charges <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="any" name="miscellaneous_charges" class="form-control" id="miscellaneous_charges" placeholder="Miscellaneous Charges" value="{{$purchase->miscellaneous_charges}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pur_total_amount" class="col-sm-3 col-form-label">Purchase Total Amount <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="any" name="pur_total_amount" class="form-control" id="pur_total_amount" placeholder="Purchase Total Amount" value="{{$purchase->pur_total_amount}}" required>
                                    @if ($errors->has('pur_total_amount'))
                                    <span class="text-danger">{{ $errors->first('pur_total_amount') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="pur_grand_total" class="col-sm-3 col-form-label">Purchase Grand Total <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="any" name="pur_grand_total" class="form-control" id="pur_grand_total" value="" placeholder="Purchase Grand Total" required>
                                    @if ($errors->has('pur_grand_total'))
                                    <span class="text-danger">{{ $errors->first('pur_grand_total') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    <div class="mt-4 col-lg-12">
                        <button type="submit" class="btn btn-primary float-end">update</button>
                    </div>
                </form>

                <!--end row-->
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
    // Hide the date inputs initially
    $('#transit_date, #received_date').hide();

    // Bind an event listener to the change event of the dropdown
    $('select[name="pur_status"]').on('change', function() {
        var selectedValue = $(this).val();
        if (selectedValue == 3) { // If "In Transit" is selected
            $('#transit_date').show(); // Show the transit date input
            $('#received_date').hide(); // Hide the received date input
        } else if (selectedValue == 4) { // If "Received" is selected
            $('#received_date').show(); // Show the received date input
            $('#transit_date').hide(); // Hide the transit date input
        } else { // If any other status is selected
            $('#transit_date, #received_date').hide(); // Hide both inputs
        }
    });
});
</script>

<script>
    
    // Wait for the page to load
    $(document).ready(function() {
    // Get the input fields
    var alibaba_charges = $("#alibaba_charges");
    var shipping_charges = $("#shipping_charges");
    var miscellaneous_charges = $("#miscellaneous_charges");
    var pur_total_amount = $("#pur_total_amount");
    var pur_grand_total = $("#pur_grand_total");

    // Calculate the grand total on page load
    calculateTotal();

    // Add event listeners to the input fields
    alibaba_charges.on("input", calculateTotal);
    shipping_charges.on("input", calculateTotal);
    miscellaneous_charges.on("input", calculateTotal);
    pur_total_amount.on("input", calculateTotal);

    // Function to calculate the total and display it in the grand total field
    function calculateTotal() {
        var total = 0.00;
        // Add the values of the input fields
        if (alibaba_charges.val() != "") {
            total += parseFloat(alibaba_charges.val());
        }
        if (shipping_charges.val() != "") {
            total += parseFloat(shipping_charges.val());
        }
        if (miscellaneous_charges.val() != "") {
            total += parseFloat(miscellaneous_charges.val());
        }
        if (pur_total_amount.val() != "") {
            total += parseFloat(pur_total_amount.val());
        }
        // Display the total in the grand total field
        if (total == 0.00) {
            pur_grand_total.val("0.00");
        } else {
            pur_grand_total.val(total.toFixed(2));
        }
    }
});


    function get_item_details(select) {
        var id = select.id;
        var item_id = select.value;
        var gettingIdNumber = id.substring(7);
        $.ajax({
            type: "POST",
            url: "{{ route('get_item_details') }}",
            data: ({
                "_token": "{{ csrf_token() }}",
                item_id: item_id
            }),
            dataType: "html",
            success: function(respose) {
                var parsedData = JSON.parse(respose);
                var item_pur_price = parsedData[0]['item_pur_price'];
                var p_units_in_carton = parsedData[0]['p_units_in_carton'];
                $("#item_pur_price" + gettingIdNumber).val(item_pur_price);
                $("#units_in_carton" + gettingIdNumber).val(p_units_in_carton);
                $("#carton_qty" + gettingIdNumber).val();

                $("#pur_item_qty" + gettingIdNumber).focus();
            }
        });
    }

    function calculate_sub_total_carton(pur_item_qty) {
        var id = pur_item_qty.id;
        var pur_item_qty = pur_item_qty.value;
        var gettingIdNumber = id.substring(12);


        var p_units_in_carton = $('#units_in_carton' + gettingIdNumber).val();
        if (pur_item_qty > 0) {
            var cartons = (parseInt(pur_item_qty)) / (parseInt(p_units_in_carton))
            $("#carton_qty" + gettingIdNumber).val(cartons.toFixed(2));
        } else {
            $("#carton_qty" + gettingIdNumber).val(0);
        }

        if (pur_item_qty > 0) {
            var item_pur_price = $('#item_pur_price' + gettingIdNumber).val();
            var p_total_price = (parseFloat(item_pur_price)) * (parseInt(pur_item_qty));
            $("#sub_total_amount" + gettingIdNumber).val(parseFloat(p_total_price).toFixed(2));
        } else {
            $("#sub_total_amount" + gettingIdNumber).val(0);
        }



        mychangeEvent();
    }
    $('#add_row').click(function(event) {
        event.preventDefault()
        add_row();
    });
    var x = 1;

    function add_row() {
        var table = document.getElementById('myTable');
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var cell1 = row.insertCell(0);
        x++;

        cell1.innerHTML = cell1.innerHTML + "<td><select name='item_id[]' id='item_id" + x +
            "' class='single-select mb-3 form-control'aria-label='Default select example' onchange='get_item_details(this)' required> {!! items_dropdown() !!} </select></td>";
        $("#item_id" + x).select2();

        var cell2 = row.insertCell(1);
        cell2.innerHTML = cell2.innerHTML +
            "<input type='any'  name='item_pur_price[]' class='form-control' id='item_pur_price" + x +
            "' placeholder='Purchase Price' required >";

        var cell3 = row.insertCell(2);
        cell3.innerHTML = cell3.innerHTML +
            "<input type='text' name='units_in_carton[]' class='form-control'id='units_in_carton" +
            x +
            "' placeholder='Purchase Qty' required>";

        var cell4 = row.insertCell(3);
        cell4.innerHTML = cell4.innerHTML + "<input id='pur_item_qty" + x +
            "' class='form-control' type='number'  onkeyup='calculate_sub_total_carton(this)'  name='pur_item_qty[]' placeholder='Total Amount' required />";

        var cell5 = row.insertCell(4);
        cell5.innerHTML = cell5.innerHTML + "<input id='carton_qty" + x +
            "' class='form-control' type='any'  name='carton_qty[]' placeholder='Total Amount' required />";

        var cell6 = row.insertCell(5);
        cell6.innerHTML = cell6.innerHTML + "<input id='sub_total_amount" + x +
            "' class='form-control' type='any'  name='sub_total_amount[]' placeholder='Total Amount' required />";

        var cell7 = row.insertCell(6);
        cell7.innerHTML = cell7.innerHTML + "<td><button type='button' class='btn btn-primary btn-sm' id='add_row_" + x +
            "'onclick='new_row()' ><i class='lni lni-circle-plus'></i></button></td>";

        var cell8 = row.insertCell(7);
        cell8.innerHTML = cell8.innerHTML +
            "<td><button class='btn btn-danger btn-sm pull-left' name='btnRemove[]' id='btnRemove_" + x +
            "'onclick='remove_row(this)'><i class='lni lni-cross-circle'></button></td>";
        return x;
    }

    function new_row() {
        add_row();
    }

    function remove_row(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        mychangeEvent();
    }

    function mychangeEvent() {
        var table = document.getElementById("myTable");
        var txtTotalPrice = 0.0;
        for (i = 1; i < table.rows.length; i++) {
            txtTotalPrice += parseFloat(document.getElementById("myTable").rows[i].cells[5].children[0].value);
        }
        document.getElementById("pur_total_amount").value = txtTotalPrice.toFixed(2);
    }

    $(document).ready(function() {

        $(document).keyup(function(e) {
            var keycode = e.keyCode;
            if (keycode == 27) {
                var a = add_row();
            }
        });
    });
</script>


@endsection
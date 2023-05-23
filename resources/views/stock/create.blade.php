@extends('layouts.app')

@section('content')

<!--sidebar wrapper -->
@include('partials.sidebar')
<!--end sidebar wrapper -->

<!--start header -->
@include('partials.topbar')
<!--end header -->

<div class="page-content" style="padding: 0.5rem !important;">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Stock</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Stock</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-2">
            <h5 class="card-title">Add Stock</h5>
            <hr />
            <div class="form-body mt-4" id="stocK_add">
                <form action="{{ route('add_stock.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <div class="border border-3 p-2 rounded">
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label for="stock_entry_date" class="form-label">Date</label><span class="text-danger"> * </span>
                                    <input type="date" name="stock_entry_date" class="form-control date-input"
                                        id="stock_entry_date" placeholder="Stock Date" required>
                                    @if ($errors->has('stock_entry_date'))
                                    <span class="text-danger">{{ $errors->first('stock_entry_date') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="wh_id" class="form-label">Warehouse</label> <span class="text-danger"> * </span>
                                    <select name="wh_id" id="wh_id" class="single-select  form-control"
                                        aria-label="Default select example" required>
                                        {!! warehouse_dropdown() !!}
                                    </select>
                                    @if ($errors->has('wh_id'))
                                    <span class="text-danger">{{ $errors->first('wh_id') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="cbm_charges" class="form-label">CBM Charges <sup class="text-danger">m</sup></label> <span class="text-danger"> * </span>
                                    <input type="any" name="cbm_charges" class="form-control"
                                        id="cbm_charges" placeholder="CBM Charges" required>
                                    @if ($errors->has('cbm_charges'))
                                    <span class="text-danger">{{ $errors->first('cbm_charges') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4 mb-2">
                        <div class="border border-3 p-2 rounded">
                            <div class="row g-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed" id="myTable">
                                        <tr>
                                            <td><label>Item</label><span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">QTY <sup class="text-danger">m</sup><span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">Carton<span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">Price/China <sup class="text-danger">m</sup><span class="text-danger"> * </span></td>
                                            <!-- <td style="width: 200px;">Shiping China</td>
                                            <td style="width: 200px;">Alibaba Fee</td> -->
                                            <td style="width: 150px;">CBM <sup class="text-danger">m</sup><span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">Shiping UAE<span class="text-danger"> * </span></td>
                                            <!-- <td style="width: 200px;">CBM Cost/Unit</td> -->
                                            <td style="width: 150px;">Cost/Unit<span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">Amazon Fee <sup class="text-danger">m</sup><span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">Sale Price <sup class="text-danger">m</sup><span class="text-danger"> * </span></td>
                                            <td style="width: 50px;"></td>
                                            <td style="width: 50px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="item_id[]" id="item_id"
                                                    class="single-select mb-3 form-control"
                                                    aria-label="Default select example"
                                                    onchange='get_item_details(this)' required>
                                                    {!! items_dropdown() !!}
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="stock_qty[]" class="form-control"
                                                    id="stock_qty" placeholder="QTY" onkeyup='calculate_cartons(this);'
                                                    required>
                                            </td>
                                            <td>
                                                <input type="text" name="stock_carton[]" class="form-control"
                                                    id="stock_carton" placeholder="Carton" required>
                                                <input type="hidden" id="p_units_in_carton" />
                                            </td>
                                            <td>
                                                <input type="text" name="item_pur_price[]" class="form-control"
                                                    id="item_pur_price" placeholder="Price/China" required>
                                            </td>
                                            <!-- <td>
                                                <input type="text" name="shiping_china[]" class="form-control" id="shiping_china" placeholder="Shiping China" required>
                                            </td>
                                            <td>
                                                <input type="text" name="ali_baba_fee[]" class="form-control" id="ali_baba_fee" placeholder="Ali Baba Fee" required>
                                            </td> -->
                                            <td>
                                                <input type="text" name="cbm[]" class="form-control" id="cbm"
                                                    placeholder="CBM" onkeyup="calculate_shiping_uae(this);" required>
                                            </td>
                                            <td>
                                                <input type="text" name="shiping_uae[]" class="form-control"
                                                    id="shiping_uae" placeholder="Shiping UAE" required>
                                            </td>
                                            <!-- <td>
                                                <input type="text" name="cbm_cost_per_unit[]" class="form-control" id="cbm_cost_per_unit" placeholder="CBM Cost/Unit" required>
                                            </td> -->
                                            <td>
                                                <input type="text" name="cost_per_unit[]" class="form-control"
                                                    id="cost_per_unit" placeholder="Cost/Unit" required>
                                            </td>
                                            <td>
                                                <input type="text" name="amazon_fee[]" class="form-control"
                                                    id="amazon_fee" placeholder="Amazon Fee" required>
                                            </td>
                                            <td>
                                                <input type="text" name="item_sale_price[]" class="form-control"
                                                    id="item_sale_price" placeholder="Sale Price" required>
                                            </td>

                                            <td>
                                                <button class="btn btn-primary btn-sm" id="add_row"><i
                                                        class="lni lni-circle-plus"></i></button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 col-lg-12">
                        <button type="submit" class="btn btn-primary float-end">Add Stock</button>
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
$('#add_row').click(function(event) {
    event.preventDefault();
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
        "<td><input type='text' name='stock_qty[]' class='form-control'id='stock_qty" + x +
        "' placeholder='QTY' onkeyup='calculate_cartons(this);' required></td>";

    var cell3 = row.insertCell(2);
    cell3.innerHTML = cell3.innerHTML +
        "<td><input type='text' name='stock_carton[]' class='form-control'id='stock_carton" + x +
        "' placeholder='Carton' required><input type='hidden' id='p_units_in_carton" + x + "' /></td>";



    var cell4 = row.insertCell(3);
    cell4.innerHTML = cell4.innerHTML +
        "<td><input type='text' name='item_pur_price[]' class='form-control' id='item_pur_price" + x +
        "' placeholder='Price/China' required></td>";

    // var cell4 = row.insertCell(3);
    // cell4.innerHTML = cell4.innerHTML +
    //     "<td><input type='text' name='shiping_china[]' class='form-control' id='shiping_china" + x +
    //     "' placeholder='Shiping China ' required></td>";

    // var cell5 = row.insertCell(4);
    // cell5.innerHTML = cell5.innerHTML +
    //     "<td><input type='text' name='ali_baba_fee[]' class='form-control' id='ali_baba_fee" + x +
    //     "' placeholder='Ali Baba fee' required></td>";

    var cell5 = row.insertCell(4);
    cell5.innerHTML = cell5.innerHTML +
        "<td><input type='text' name='cbm[]' class='form-control' id='cbm" + x +
        "' placeholder='CBM' onkeyup='calculate_shiping_uae(this);' required></td>";

    var cell6 = row.insertCell(5);
    cell6.innerHTML = cell6.innerHTML +
        "<td><input type='text' name='shiping_uae[]' class='form-control' id='shiping_uae" + x +
        "' placeholder='Shiping UAE' required></td>";

    // var cell8 = row.insertCell(7);
    // cell8.innerHTML = cell8.innerHTML +
    //     "<td><input type='text' name='cbm_cost_per_unit[]' class='form-control' id='cbm_cost_per_unit" + x +
    //     "' placeholder='CBM Cost Per Unit' required></td>";

    var cell7 = row.insertCell(6);
    cell7.innerHTML = cell7.innerHTML +
        "<td><input type='text' name='cost_per_unit[]' class='form-control' id='cost_per_unit" + x +
        "' placeholder='Cost Unit' required></td>";

    var cell8 = row.insertCell(7);
    cell8.innerHTML = cell8.innerHTML +
        "<td><input type='text' name='amazon_fee[]' class='form-control' id='amazon_fee" + x +
        "' placeholder='Amazon Fee' required></td>";


    var cell9 = row.insertCell(8);
    cell9.innerHTML = cell9.innerHTML +
        "<td><input type='text' name='item_sale_price[]' class='form-control' id='item_sale_price" + x +
        "' placeholder='Sale Price' required></td>";


    var cell10 = row.insertCell(9);
    cell10.innerHTML = cell10.innerHTML + "<td><button class='btn btn-primary btn-sm' id='add_row" + x +
        "'onclick='new_row()' ><i class='lni lni-circle-plus'></i></td>";

    var cell11 = row.insertCell(10);
    cell11.innerHTML = cell11.innerHTML +
        "<td><button class='btn btn-danger btn-sm pull-left' name='btnRemove[]' id='btnRemove" + x +
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
}

$(document).ready(function() {
    $(document).keydown(function(e) {
        var keycode = e.keyCode;
        if (keycode == 27) {
            var a = add_row();
        }
    });
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
            var p_units_in_carton = parsedData[0]['p_units_in_carton'];
            $("#p_units_in_carton" + gettingIdNumber).val(p_units_in_carton);
            $("#stock_qty" + gettingIdNumber).focus();
        }
    });
}

function calculate_cartons(input) {
    var id = input.id;
    var stock_qty = input.value;
    var gettingIdNumber = id.substring(9);

    var item_id = $("#item_id" + gettingIdNumber).val();
    if (item_id != "") {
        if (stock_qty != "") {
            var p_units_in_carton = $("#p_units_in_carton" + gettingIdNumber).val();
            var stock_carton = parseInt(stock_qty) / parseInt(p_units_in_carton);
            $("#stock_carton" + gettingIdNumber).val(stock_carton.toFixed(2));
        } else {
            $("#stock_carton" + gettingIdNumber).val(0);
        }
    } else {
        alert("please select Item First");
        $("#stock_qty" + gettingIdNumber).val(0);
    }
}

// function calculate_alibaba_fee(input) {
//     debugger;
//     var id = input.id;
//     var item_pur_price = input.value;
//     if (item_pur_price != "") {
//         var gettingIdNumber = id.substring(15);
//         var stock_qty = $('#stock_qty' + gettingIdNumber).val();
//         var percent = ((parseInt(stock_qty) * item_pur_price) / 100) * 3;
//         var percentage = parseInt(percent).toFixed(1)
//         $('#ali_baba_fee' + gettingIdNumber).val(percentage);
//     }
// }

function calculate_shiping_uae(input) {
    var id = input.id;
    var cbm = input.value;
    if (cbm != "") {
        var gettingIdNumber = id.substring(3);
        var cbm_charges = $('#cbm_charges').val();
        if (cbm_charges != "") {
            var result = (cbm * cbm_charges)
            var shiping_uae = parseInt(result);
            $('#shiping_uae' + gettingIdNumber).val(shiping_uae);

            var stock_qty = $('#stock_qty' + gettingIdNumber).val();
            var item_pur_price = $('#item_pur_price' + gettingIdNumber).val();
            var shiping_uae = $('#shiping_uae' + gettingIdNumber).val();

            //calculate cbm cost/unit
            // var stock_qty = $('#stock_qty' + gettingIdNumber).val();
            // if (stock_qty != "") {
            //     var cbm_cost_on_unit = shiping_uae / stock_qty;
            //     var cbm_cost_on_unit = parseInt(cbm_cost_on_unit).toFixed(2)
            //     $('#cbm_cost_per_unit' + gettingIdNumber).val(cbm_cost_on_unit);
            // }

            //calculate cost before shipping
            // formula  = (purchase_price * qty ) + shiping_china + ali_baba_fee
            // var item_pur_price = $('#item_pur_price' + gettingIdNumber).val();
            // var shiping_china = $('#shiping_china' + gettingIdNumber).val();
            // var ali_baba_fee = $('#ali_baba_fee' + gettingIdNumber).val();

            // var aa = item_pur_price * stock_qty;
            // var bb = parseInt(shiping_china) + parseInt(ali_baba_fee);
            // var cost_before_shiping = aa + bb;

            //calculate cost after shipping
            //var shiping_uae = $('#shiping_uae' + gettingIdNumber).val();
            //var cost_after_shiping = parseInt(cost_before_shiping) + parseInt(shiping_uae);

            // calculate cost per unit
            // var cost_per_unit = parseInt(cost_after_shiping) / parseInt(stock_qty);
            // $('#cost_per_unit' + gettingIdNumber).val(parseInt(cost_per_unit));

            var aa = item_pur_price * stock_qty;
            var bb = shiping_uae;
            var cc = parseInt(aa) + parseInt(bb);
            var cost_per_unit = parseInt(cc) / parseInt(stock_qty);
            $('#cost_per_unit' + gettingIdNumber).val(parseInt(cost_per_unit));


        } else {
            $('#shiping_uae' + gettingIdNumber).val(0);
            alert('Please Enter CBM Charges');
        }


    }
}
</script>

@endsection
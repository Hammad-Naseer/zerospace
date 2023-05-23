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
        <div class="breadcrumb-title pe-3">Sales</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Sale</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add New Sale</h5>
            <hr />

            <div class="form-body mt-4">
                <form action="{{ route('sale.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 mt-4 mb-2">
                            <label for="wh_id" class="form-label">Select Warehouse</label> <span class="text-danger"> *
                            </span>
                            <select name="wh_id" id="wh_id" class="single-select mb-3 form-control"
                                aria-label="Default select example" required>
                                {!! warehouse_dropdown() !!}
                            </select>
                        </div>

                        <div class="col-lg-4 mt-4 mb-2">
                            <label for="sales_date" class="form-label">Sales Date</label> <span class="text-danger"> *
                            </span>
                            <input type="date" name="sales_date" id="sales_date" class="form-control date-input" required />
                        </div>

                    </div>

                    <div class="col-lg-12 mt-4 mb-2">
                        <div class="border rounded">
                            <div class="row g-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed" id="myTable">
                                        <tr>
                                            <td>Items<span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">InHand Qty<span class="text-danger"> * </span>
                                            </td>
                                            <td style="width: 150px;">Sale Price<span class="text-danger"> * </span>
                                            </td>
                                            <td style="width: 200px;">Sale Qty<span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">Sub Total<span class="text-danger"> * </span></td>
                                            <td style="width: 50px;"></td>
                                            <td style="width: 50px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="item_id[]" id="item_id"
                                                    class="single-select mb-3 form-control"
                                                    aria-label="Default select example"
                                                    onchange="get_item_stock_details(this);" required>
                                                    {!! items_dropdown() !!}
                                                </select>
                                            </td>
                                            <td>

                                                <input type="hidden" name="cost_per_unit[]" class="form-control"
                                                    id="cost_per_unit">
                                                <input type="text" name="inhand_qty[]" class="form-control"
                                                    id="inhand_qty" placeholder="In Hand Qty" required readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="sale_price[]" class="form-control"
                                                    id="sale_price" placeholder="Sale Price" required>
                                            </td>
                                            <td>
                                                <input type="text" name="sale_qty[]" class="form-control" id="sale_qty"
                                                    placeholder="Enter Sale Qty" oninput="calculate_subtotal(this);"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="text" name="sub_total[]" class="form-control"
                                                    id="sub_total" placeholder="Sub Total" required>
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

                    <div class="mt-4 row">
                        <div class="col-lg-4">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea name="remarks" id="remarks" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <label for="total_sales_amount" class="form-label">Total Sales Amount</label> <span
                                class="text-danger"> *
                            </span>
                            <input type="text" name="total_sales_amount" id="total_sales_amount" class="form-control"
                                placeholder="Total Sales Amount" required />
                        </div>
                    </div>
            </div>

            <div class="mt-4 col-lg-12">
                <button type="submit" class="btn btn-primary float-end">Save Sale</button>
            </div>
            </form>
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
function get_item_stock_details(select) {
    var id = select.id;
    var item_id = select.value;
    var gettingIdNumber = id.substring(7);
    var wh_id = $('#wh_id').val();

    if (wh_id != "") {
        $.ajax({
            type: "POST",
            url: "{{ route('get_item_stock_details') }}",
            data: ({
                "_token": "{{ csrf_token() }}",
                item_id: item_id,
                wh_id: wh_id
            }),
            dataType: "html",
            success: function(respose) {
                var aa = typeof(respose);
                var parsedData = JSON.parse(respose);
                if (parsedData != null) {
                    var sale_price = parsedData['item_sale_price'];
                    var stock_qty = parsedData['stock_qty'];
                    var cost_per_unit = parsedData['cost_per_unit'];

                    $("#inhand_qty" + gettingIdNumber).val(stock_qty);
                    $("#sale_price" + gettingIdNumber).val(sale_price);
                    $("#cost_per_unit" + gettingIdNumber).val(cost_per_unit);

                    $("#sale_qty" + gettingIdNumber).focus();
                } else {
                    $("#inhand_qty" + gettingIdNumber).val(0);
                    $("#sale_price" + gettingIdNumber).val(0);
                    $("#cost_per_unit" + gettingIdNumber).val(0);
                }

            }
        });
    } else {
        alert('Please select warehous');
    }


}

function calculate_subtotal(input) {
    var id = input.id;
    var sale_qty = input.value;
    var gettingIdNumber = id.substring(8);

    var inhand_qty = $("#inhand_qty" + gettingIdNumber).val();

    if (sale_qty != "") {

        if (parseInt(sale_qty) > parseInt(inhand_qty)) {
            alert("Sale Qty Should be Less then in hand Qty");
            $("#sale_qty" + gettingIdNumber).val(0);
            $("#sub_total" + gettingIdNumber).val(0);
            mychangeEvent();
        } else {
            var sale_price = $("#sale_price" + gettingIdNumber).val();
            var sub_total = parseFloat(sale_price) * parseFloat(sale_qty);
            $("#sub_total" + gettingIdNumber).val(parseFloat(sub_total).toFixed(2));
            mychangeEvent();
        }

    } else {
        $("#sub_total" + gettingIdNumber).val(0);
        mychangeEvent();
    }


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
        "' class='single-select mb-3 country form-control'aria-label='Default select example' onchange='get_item_stock_details(this);' required>{!! items_dropdown() !!}</select></td>";
    $("#item_id" + x).select2();

    var cell2 = row.insertCell(1);
    cell2.innerHTML = cell2.innerHTML + "<td><input id='cost_per_unit" + x +
        "' class='form-control' type='hidden' name='cost_per_unit[]' /></td>";
    cell2.innerHTML = cell2.innerHTML + "<td><input id='inhand_qty" + x +
        "' class='form-control' type='text' name='inhand_qty[]' placeholder='In Hand Qty' required readonly /></td>";
    var cell3 = row.insertCell(2);
    cell3.innerHTML = cell3.innerHTML +
        "<td><input type='text' name='sale_price[]' class='form-control' id='sale_price" +
        x + "' placeholder='Sale Price' required></td>";
    var cell4 = row.insertCell(3);
    cell4.innerHTML = cell4.innerHTML +
        "<td><input type='text' name='sale_qty[]' class='form-control' id='sale_qty" + x +
        "' placeholder='Enter Sale Qty' oninput='calculate_subtotal(this);' required></td>";
    var cell5 = row.insertCell(4);
    cell5.innerHTML = cell5.innerHTML + "<td><input id='sub_total" + x +
        "'  class='form-control' type='text'  name='sub_total[]' placeholder='Sub Total' required /></td>";

    var cell6 = row.insertCell(5);
    cell6.innerHTML = cell6.innerHTML + "<td><button class='btn btn-primary btn-sm' id='add_row" + x +
        "'onclick='new_row()' ><i class='lni lni-circle-plus'></i></td>";
    var cell7 = row.insertCell(6);
    cell7.innerHTML = cell7.innerHTML +
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
    var txtTotalPrice = 0.0;
    for (i = 1; i < table.rows.length; i++) {
        var aa = parseFloat(document.getElementById("myTable").rows[i].cells[4].children[0].value);
        if(aa > 0){
            txtTotalPrice += aa;
        }
        
    }
    document.getElementById("total_sales_amount").value = parseFloat(txtTotalPrice).toFixed(2);
}

$(document).ready(function() {
    $(document).keydown(function(e) {
        var keycode = e.keyCode;
        if (keycode == 27) {
            var a = add_row();
        }
    });
});
</script>
@endsection
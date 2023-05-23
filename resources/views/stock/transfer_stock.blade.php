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
        <div class="breadcrumb-title pe-3">Transfer Stock</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Transfer Stock</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Transfer Stock</h5>
            <hr />



            <div class="form-body mt-4" id="stock_transfer">
                <form action="{{ route('transfer_stock.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12" id="stock_transfer">
                        <div class="border border-3 p-4 rounded">
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
                                    <label for="wh_id_from" class="form-label">WareHouse(From)</label> <span class="text-danger"> * </span>
                                    <select name="wh_id_from" id="wh_id_from" class="single-select  form-control"
                                        aria-label="Default select example" required>
                                        {!! warehouse_dropdown() !!}
                                    </select>
                                    @if ($errors->has('wh_id_from'))
                                    <span class="text-danger">{{ $errors->first('wh_id_from') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label for="wh_id_to" class="form-label">WareHouse(To)</label> <span class="text-danger"> * </span>
                                    <select name="wh_id_to" id="wh_id_to" onchange="check_warehouse(this)"
                                        class="single-select  form-control" aria-label="Default select example" required>
                                        {!! warehouse_dropdown() !!}
                                    </select>
                                    @if ($errors->has('wh_id_to'))
                                    <span class="text-danger">{{ $errors->first('wh_id_to') }}</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4 mb-2">
                        <div class="border border-3 p-4 rounded">
                            <div class="row g-3">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed" id="myTable">
                                        <tr>
                                            <td><label>Item</label><span class="text-danger"> * </span></td>
                                            <td style="width: 300px;"><label>Inhand QTY</label><span class="text-danger"> * </span></td>
                                            <td style="width: 300px;"><label>QTY</label><span class="text-danger"> * </span></td>
                                            <td style="width: 300px;"><label>Cartons</label><span class="text-danger"> * </span></td>
                                            <td style="width: 50px;"></td>
                                            <td style="width: 50px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="item_id[]" id="item_id"
                                                    class="single-select mb-3 form-control"
                                                    aria-label="Default select example"
                                                    onchange='get_item_quantity(this)' required>
                                                    {!! items_dropdown() !!}
                                                    @if ($errors->has('item_id'))
                                                    <span class="text-danger">{{ $errors->first('item_id') }}</span>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="inhand_qty[]" class="form-control"
                                                    id="inhand_qty" placeholder="inhand QTY" required>
                                                <input type="hidden" name="p_units_in_carton[]" id="p_units_in_carton" />
                                            </td>
                                            <td>
                                                <input type="text" name="stock_qty[]" class="form-control"
                                                    id="stock_qty" onInput="check_stock(this)" placeholder="QTY"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="text" name="carton_qty[]" class="form-control"
                                                    id="carton_qty" onInput="" placeholder="Carton QTY" required>
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
                        <button type="submit" class="btn btn-primary float-end">Transfer Stock</button>
                    </div>
                </form>
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
function get_item_quantity(select) {
    var id = select.id;
    var item_id = select.value;
    var wh_id = $('#wh_id_from').val();
    var gettingIdNumber = id.substring(7);

    if (wh_id != "") {
        $.ajax({
            type: "POST",
            url: "{{ route('get_item_quantity') }}",
            data: ({
                "_token": "{{ csrf_token() }}",
                item_id: item_id,
                wh_id: wh_id
            }),
            dataType: "html",
            success: function(respose) {
                if (respose != "null") {
                    var parsedData = JSON.parse(respose);
                    var stock_qty = parsedData['stock_qty'];
                    var p_units_in_carton = parsedData['p_units_in_carton'];

                    $("#inhand_qty" + gettingIdNumber).val(stock_qty);
                    $("#p_units_in_carton" + gettingIdNumber).val(p_units_in_carton);
                    $("#stock_qty" + gettingIdNumber).focus();
                } else {
                    $("#inhand_qty" + gettingIdNumber).val(0);
                    $("#p_units_in_carton" + gettingIdNumber).val(0);
                    $("#stock_qty" + gettingIdNumber).focus();
                }

            }
        });
    } else {
        alert('plese select wharehouse first');
    }
}

function check_stock(input) {
    var id = input.id;
    var stock_qty = input.value;
    var gettingIdNumber = id.substring(9);
    var inhand_qty = $('#inhand_qty' + gettingIdNumber).val();

    

    if (stock_qty != "") {
        var p_units_in_carton = $("#p_units_in_carton" + gettingIdNumber).val();
        var stock_carton = parseInt(stock_qty) / parseInt(p_units_in_carton);
        $("#carton_qty" + gettingIdNumber).val(stock_carton.toFixed(2));
    } else {
        $("#carton_qty" + gettingIdNumber).val(0);
    }
    if (parseInt(stock_qty) > parseInt(inhand_qty)) {
        alert('Quantity should be less then available quantaty');
        $("#stock_qty" + gettingIdNumber).val(0);
        $("#carton_qty" + gettingIdNumber).val(0);
    }
}

function check_warehouse(input) {
    var id = input.id;
    var wh_id_to = input.value;
    var wh_id_from = $('#wh_id_from').val();

    if (wh_id_from != "") {
        if (wh_id_to == wh_id_from) {
            alert('Both Warehouses are same');
            // $('#wh_id_from').find('option[value=""]').attr('selected', 'selected');
            // ('#wh_id_from').
        }
    } else {
        alert('Please select Warehouses From');

    }
}


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
        "' class='single-select mb-3 form-control' aria-label='Default select example' onchange='get_item_quantity(this)' required> {!! items_dropdown() !!} </select></td>";
    $("#item_id" + x).select2();

    var cell2 = row.insertCell(1);
    cell2.innerHTML = cell2.innerHTML +
        "<td><input type='text' name='inhand_qty[]' class='form-control'id='inhand_qty" + x +
        "' placeholder='QTY' required> <input type='hidden' name='p_units_in_carton[]' id='p_units_in_carton" + x +
        "' /></td>";

    var cell3 = row.insertCell(2);
    cell3.innerHTML = cell3.innerHTML +
        "<td><input type='text' name='stock_qty[]' class='form-control'id='stock_qty" + x +
        "' placeholder='QTY' onInput='check_stock(this)' required></td>";

    var cell4 = row.insertCell(3);
    cell4.innerHTML = cell4.innerHTML +
        "<td><input type='text' name='carton_qty[]' class='form-control'id='carton_qty" + x +
        "' placeholder='Carton QTY' required></td>";

    var cell5 = row.insertCell(4);
    cell5.innerHTML = cell5.innerHTML + "<td><button type='button' class='btn btn-primary btn-sm' id='add_row" + x +
        "'onclick='new_row()' ><i class='lni lni-circle-plus'></i> </button></td>";

    var cell6 = row.insertCell(5);
    cell6.innerHTML = cell6.innerHTML +
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
</script>

@endsection
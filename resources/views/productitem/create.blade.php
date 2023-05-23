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
        <div class="breadcrumb-title pe-3">Items</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Item</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add New Item</h5>
            <hr />

            <div class="form-body mt-4">
                <form action="{{ route('productitem.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-6 mt-4 mb-2">
                        <label for="p_id" class="form-label">Select Product</label> <span class="text-danger"> * </span>
                        <select name="p_id" id="p_id" class="single-select mb-3 form-control" aria-label="Default select example" required>
                            {!! product_dropdown($p_id) !!}
                        </select>
                    </div>

                    <div class="col-lg-12 mt-4 mb-2">
                        <div class="border rounded">
                            <div class="row g-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed" id="myTable">
                                        <tr>
                                            <td>Variat<span class="text-danger"> * </span></td>
                                            <!-- <td>Barcode<span class="text-danger"> * </span></td> -->
                                            <td style="width: 200px;">Barcode Image<span class="text-danger"> * </span>
                                            </td>
                                            <td style="width: 150px;">SKU<span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">ASIN<span class="text-danger"> * </span></td>
                                            <td style="width: 200px;">Image<span class="text-danger"> * </span></td>
                                            <td style="width: 150px;">Pur price<span class="text-danger"> * </span></td>
                                            <td style="width: 50px;"></td>
                                            <td style="width: 50px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="var_id[]" id="var_id" class="single-select mb-3 form-control" aria-label="Default select example" required>
                                                    {!! variant_dropdown() !!}
                                                </select>
                                                @if ($errors->has('var_id'))
                                                <span class="text-danger">{{ $errors->first('var_id') }}</span>
                                                @endif
                                            </td>
                                            <!-- <td>
                                                <input type="text" name="item_barcode[]" class="form-control"
                                                    id="item_barcode" placeholder="Item Barcode" required>
                                            </td> -->
                                            <td>
                                                <input id="item_barcode_img" class="form-control file-input" type="file" name="item_barcode_img[]" placeholder="Barcode Image" required />
                                                @if ($errors->has('item_barcode_img'))
                                                <span class="text-danger">{{ $errors->first('item_barcode_img') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="item_sku[]" class="form-control" id="item_sku" placeholder="Enter Item SKU" required>
                                            </td>
                                            <td>
                                                <input type="text" name="item_asin[]" class="form-control" id="item_asin" placeholder="Enter Item ASIN" required>
                                                @if ($errors->has('item_asin'))
                                                <span class="text-danger">{{ $errors->first('item_asin') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input id="item_img" class="form-control file-input" type="file" name="item_img[]" placeholder="Item Image" required />
                                                @if ($errors->has('item_img'))
                                                <span class="text-danger">{{ $errors->first('item_img') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="item_pur_price[]" class="form-control" id="item_pur_price" placeholder="Enter Pur Price" required>
                                                @if ($errors->has('item_pur_price'))
                                                <span class="text-danger">{{ $errors->first('item_pur_price') }}</span>
                                                @endif
                                            </td>
                                            <!-- <td>
                                                <input type="text" name="item_selling_price[]" class="form-control"
                                                    id="item_selling_price" placeholder="Enter Sell Price" required>
                                            </td> -->
                                            <td>
                                                <button class="btn btn-primary btn-sm" id="add_row"><i class="lni lni-circle-plus"></i></button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 col-lg-12">
                        <button type="submit" class="btn btn-primary float-end">Save Item</button>
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
        // function focus_input(select) {
        //     var id = select.id;
        //     var var_id = select.value;
        //     var gettingIdNumber = id.substring(6);
        //     document.getElementById("item_barcode" + gettingIdNumber).focus();

        // }
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

            cell1.innerHTML = cell1.innerHTML + "<td><select name='var_id[]' id='var_id" + x +
                "' class='single-select mb-3 country form-control'aria-label='Default select example' required>{!! variant_dropdown() !!}</select></td>";
            $("#var_id" + x).select2();
            var cell2 = row.insertCell(1);
            cell2.innerHTML = cell2.innerHTML + "<input id='item_barcode_img" + x +
                "' class='form-control file-input' type='file' name='item_barcode_img[]' placeholder='Barcode Image' required />";
            var cell3 = row.insertCell(2);
            cell3.innerHTML = cell3.innerHTML +
                "<td><input type='text' name='item_sku[]' class='form-control' id='item_sku" +
                x + "' placeholder='Enter Item SKU' required></td>";

            var cell4 = row.insertCell(3);
            cell4.innerHTML = cell4.innerHTML +
                "<td><input type='text' name='item_asin[]' class='form-control' id='item_asin" + x +
                "' placeholder='Enter Item ASIN' required></td>";
            var cell5 = row.insertCell(4);
            cell5.innerHTML = cell5.innerHTML + "<td><input id='item_img" + x +
                "'  class='form-control file-input' type='file'  name='item_img[]' placeholder='Item Image' required /></td>";

            var cell6 = row.insertCell(5);
            cell6.innerHTML = cell6.innerHTML +
                "<input type='text' name='item_pur_price[]' class='form-control' id='item_pur_price" + x +
                "' placeholder='Enter Pur Price' required></td>";

            var cell7 = row.insertCell(6);
            cell7.innerHTML = cell7.innerHTML + "<td><button type='button' class='btn btn-primary btn-sm' id='add_row" + x +
                "'onclick='new_row()' ><i class='lni lni-circle-plus'></i> </button></td>";
            var cell8 = row.insertCell(7);
            cell8.innerHTML = cell8.innerHTML +
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

            // var cus_total_balance = $('#cus_total_balance').val();
            // var grand_total = $('#grand_total').val();
            // var total_balance_now = (parseFloat(cus_total_balance)) + (parseFloat(grand_total));
            // $("#total_balance_amount").val(total_balance_now.toFixed(2));
        }

        function mychangeEvent() {
            var table = document.getElementById("myTable");
            // for (i = 1; i < table.rows.length; i++) {
            //     var txtTotalPrice = document.getElementById("myTable").rows[i].cells[6].children[0].value;
            // }
            // document.getElementById("retail").value = total_product_price_retail.toFixed(2);
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
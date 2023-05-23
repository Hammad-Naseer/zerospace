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
                                <div class="col-md-4">
                                    <label for="pur_refrence_no" class="form-label">Refrence No</label>
                                    
                                    <input type="text" name="pur_refrence_no" class="form-control" id="pur_refrence_no"
                                        placeholder="Refrence No" value="{{$purchase->pur_refrence_no}}">
                                    @if ($errors->has('pur_refrence_no'))
                                    <span class="text-danger">{{ $errors->first('pur_refrence_no') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="vend_id" class="form-label">Supplier</label>
                                    <select name="vend_id" id="vend_id" class="single-select  form-control"
                                        aria-label="Default select example">
                                        {!! vendor_dropdown($purchase->vend_id) !!}
                                    </select>
                                    @if ($errors->has('vend_id'))
                                        <span class="text-danger">{{ $errors->first('vend_id') }}</span>
                                        @endif
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="pur_date" class="form-label">Purchase Date</label>
                                    <input type="date" name="pur_date" class="form-control" id="pur_date"
                                        placeholder="Purchase Date" value="{{$purchase->pur_date}}">
                                    @if ($errors->has('pur_date'))
                                    <span class="text-danger">{{ $errors->first('pur_date') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="pur_status" class="form-label">Purchase Status</label>
                                    {!! purchase_status_dropdown("$purchase->pur_status" ,"pur_status" ,"pur_status") !!}
                                    @if ($errors->has('pur_status'))
                                    <span class="text-danger">{{ $errors->first('pur_status') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="pur_document" class="form-label">Purchase Document</label>
                                    <input type="file" name="pur_document" class="form-control" id="pur_document"
                                        placeholder="Purchase Document" value="{{$purchase->pur_document}}">
                                        @if(!empty($purchase->pur_document))
                                        <a target="_blank"  href="{{url($purchase->pur_document)}}">Old Document Exists <i class="lni lni-download"> </i></a>
                                        @endif
                                        <input type="hidden" name="pur_doc_old" value="{{$purchase->pur_document}}">
                                    @if ($errors->has('pur_document'))
                                    <span class="text-danger">{{ $errors->first('pur_document') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="pur_total_amount" class="form-label">Purchase Amount</label>
                                    <input type="number" name="pur_total_amount" class="form-control"
                                        id="pur_total_amount" placeholder="Purchase Amount" value="{{$purchase->pur_total_amount}}">
                                    @if ($errors->has('pur_total_amount'))
                                    <span class="text-danger">{{ $errors->first('pur_total_amount') }}</span>
                                    @endif
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
                                            <td style="width: 300px;"><label>Pur QTY</label></td>
                                            <td style="width: 300px;"><label>Total Amount</label></td>
                                            <td style="width: 50px;"></td>
                                            <td style="width: 50px;"></td>
                                        </tr>
                                        @foreach($purchase_detail as $row)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="pur_detail_id" value="{{$row->pur_detail_id}}" class="form-control">
                                                <select name="item_id[]" id="item_id"
                                                    class="single-select mb-3 form-control"
                                                    aria-label="Default select example" required>
                                                    {!! items_dropdown($row->item_id) !!}
                                                    @if ($errors->has('item_id'))
                                                    <span class="text-danger">{{ $errors->first('item_id') }}</span>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="pur_detail_qty[]" class="form-control"
                                                    id="pur_detail_qty" value="{{$row->pur_detail_qty}}">
                                                @if ($errors->has('pur_detail_qty'))
                                                <span class="text-danger">{{ $errors->first('pur_detail_qty') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="number" name="pur_detail_amount[]" class="form-control"
                                                    id="pur_detail_amount" value="{{$row->pur_detail_amount}}">
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" id="add_row"><i
                                                        class="lni lni-circle-plus"></i></button>
                                            </td>
                                            <td>
                                            <button class='btn btn-danger btn-sm pull-left' name='btnRemove[]' id='btnRemove_" + x +
                                            "'onclick='remove_row(this)'><i class="lni lni-cross-circle"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
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
$('#add_row').click(function(event) {
    event.preventDefault();
    debugger;
    add_row();
});
var x = 1;

function add_row() {
    var table = document.getElementById('myTable');
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var cell1 = row.insertCell(0);
    x++;

    cell1.innerHTML = cell1.innerHTML + "<td><select name='item_id[]' id='item_id_" + x +
        "' class='single-select mb-3 form-control'aria-label='Default select example' required> {!! items_dropdown() !!} </select></td>";
    $("#item_id_" + x).select2();

    var cell2 = row.insertCell(1);
    cell2.innerHTML = cell2.innerHTML +
        "<input type='text' name='pur_detail_qty[]' class='form-control'id='pur_detail_qty_" + x +
        "' placeholder='Purchase Qty'>";
    var cell3 = row.insertCell(2);
    cell3.innerHTML = cell3.innerHTML + "<input id='pur_detail_amount_" + x +
        "' class='form-control' type='number' multiple placeholder='Total Amount' name='pur_detail_amount[]' />";

    var cell4 = row.insertCell(3);
    cell4.innerHTML = cell4.innerHTML + "<td><button class='btn btn-primary btn-sm' id='add_row_" + x +
        "'onclick='new_row()' ><i class='lni lni-circle-plus'></i></td>";
    var cell5 = row.insertCell(4);
    cell5.innerHTML = cell5.innerHTML +
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
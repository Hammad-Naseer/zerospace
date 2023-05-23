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
        <div class="breadcrumb-title pe-3">Items</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Items</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

            <a href="{{route("productitem.create")}}" target="_blank" class="btn btn-primary px-5 radius-30">
                <i class="bx bx-plus mr-1">
                </i>Add
                Item
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Items</h6>
    <hr />

    <form action="" method="GET">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-3">
                <label for="p_id" class="form-label">Select Product</label> <span class="text-danger"> * </span>
                <select name="p_id" id="p_id" class="single-select mb-3 form-control"
                    aria-label="Default select example">
                    {!! product_dropdown() !!}
                </select>
            </div>

            <div class="col-md-6 mt-4">
                <button class="btn btn-primary btn-sm">Filter</button>
                @if($filter == 1)
                <a href="{{URL::to('product_item')}}" class="btn btn-danger btn-sm">Remove Filter</a>
                @endif
            </div>
        </div>
    </form>

    <br>

    <div class="card">
        <div class="card-body">
            <div style="text-align:center;">
                Toggle column:
                <a class="toggle-vis btn btn-sm btn-primary" data-column="0">Sr.</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Details</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Barcode</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="3">Identity</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="4">Weight</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="5">Size</a>
                <a class="toggle-vis btn btn-sm btn-primary" data-column="6">Price</a>
            </div>
            <div class="table-responsive">

                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Item Sr.No</th>
                            <th>Details</th>
                            <th>Barcode</th>
                            <th>Identity</th>
                            <th>Weight</th>
                            <th>Size</th>
                            <th>Prices</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productitems as $row)
                        <tr>
                            <td>{{ $row->item_serial_no }}</td>
                            <td>

                                <div class="d-flex align-items-center">
                                    <div class="product-img">
                                        <img src="{{ asset('public/' .$row->item_img) }}" class="card-img-top" alt="...">
                                    </div>
                                    <div class="ms-2">
                                        <p class="mb-0">{{ $row->p_name }}</p>
                                        <p class="mb-0">{{$row->var_color}}</p>
                                        <p class="mb-0">{{$row->var_size}}</p>
                                        <p class="mb-0">{{$row->var_material}}</p>
                                        <p class="mb-0">{{$row->var_weight}}</p>
                                    </div>
                                </div>
                            </td>
                            <td> <img src="{{ asset('public/' .$row->item_barcode_img) }}" class="card-img-top" alt="..."
                                    style="width:200px;"></td>
                            <td>
                                <div class="ms-2">
                                    <p class="mb-0"> <strong>ASIN:</strong> {{ $row->item_asin }} </p>
                                    <p class="mb-0"> <strong>SKU :</strong> {{$row->item_sku}}</p>
                                </div>
                            </td>
                            <td>
                                <div class="ms-2">
                                    <p class="mb-0"> <strong>U/C :</strong> {{ $row->p_units_in_carton }} </p>
                                    <p class="mb-0"> <strong>N-W :</strong> {{$row->p_net_weight}}</p>
                                    <p class="mb-0"> <strong>G-W :</strong> {{$row->p_gross_weight}}</p>
                                </div>
                            </td>
                            <td>
                                <div class="ms-2">
                                    <p class="mb-0"> <strong> Box Size :</strong>
                                        {{ $row->p_box_size_length }}x{{ $row->p_box_size_width }}x{{$row->p_box_size_height }}
                                        {{$row->p_box_size_unit }}
                                    </p>
                                    <p class="mb-0"> <strong>Carton Size :</strong>
                                        {{$row->p_carton_size_length }}x{{ $row->p_carton_size_width }}x{{ $row->p_carton_size_height }}
                                        {{ $row->p_carton_size_unit }}
                                    </p>
                                </div>

                            </td>
                            <td>
                                <strong>Sup Pur Price: </strong>{{$row->item_pur_price}} <br>
                                <strong>Cost Per Unit: </strong>{{$row->cost_per_unit}}<br>
                                <strong>Sale Price: </strong>{{$row->item_sale_price}}

                            </td>
                            <td>
                            @can('EditProductitem')
                                <a href="{{route("product_item.edit", ["id" => $row->item_id])}}"
                                    class="fadeIn animated bx bx-pencil bx-sm">
                                </a>
                                @endcan
                                @can('DeleteProductitem')
                                <a href="#" class="fadeIn animated bx bx-trash bx-sm"
                                    onclick="confirm_modal('{{route("product_item.delete", ["id" => $row->item_id])}}');">
                                </a>
                                @endcan
                                @can('UpdateItemSalePrice')
                                <a href="#" class="fadeIn animated bx bx-money bx-sm"
                                    onclick="showAjaxModal('{{route("productitem.price", ["id" => $row->item_id])}}');">
                                </a>
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
    var table = $('#example').DataTable({
        lengthChange: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        dom: 'lBfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $('a.toggle-vis').on('click', function(e) {
        $(this).toggleClass("btn-primary");
        e.preventDefault();
        var column = table.column($(this).attr('data-column'));
        column.visible(!column.visible());
    });
});
</script>
@endsection
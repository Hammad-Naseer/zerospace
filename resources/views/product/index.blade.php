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
        <div class="breadcrumb-title pe-3">Products Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Products Profile</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

            <a href="{{route('create_product')}}" class="btn btn-primary px-5 radius-30">
                <i class="bx bx-plus mr-1">
                </i>Add
                Product Profile
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Products</h6>
    <hr />
    <form action="" method="GET">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-3">
                <label class="form-label">Account</label><span class="text-danger"> * </span>
                <select class="form-control" name="acc_id" id="acc_id">
                    {!! account_dropdown() !!}
                </select>
            </div>
            <div class="col-md-3">
                <label for="brand_id" class="form-label">Select Brand</label><span class="text-danger"> * </span>
                <select class="form-control" name="brand_id" id="brand_id">
                    <!-- {!! brand_dropdown() !!} -->
                </select>
            </div>
            <div class="col-lg-3">
                <label for="cat_id" class="form-label">Category</label><span class="text-danger"> * </span>
                <select name="cat_id" id="cat_id" class="single-select  form-control"
                    aria-label="Default select example">
                    <!-- {!! category_dropdown() !!} -->
                </select>
            </div>

            <div class="col-md-3 mt-4">
                <button class="btn btn-primary btn-sm">Filter</button>
                @if($filter == 1)
                <a href="{{URL::to('products')}}" class="btn btn-danger btn-sm">Remove Filter</a>
                @endif

            </div>

        </div>

    </form>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div style="text-align:center;">
                    Toggle column:
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="0">Sr.</a>
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Details</a>
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Units in Carton</a>
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="3">Net Weight</a>
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="4">Gross Weight</a>
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="5">Status</a>
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="6">Sizes</a>
                    <!-- <a class="toggle-vis btn btn-sm btn-primary" data-column="7">Owner</a> -->
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="7">Serials</a>
                    <a class="toggle-vis btn btn-sm btn-primary" data-column="8">Alert Qty</a>
                </div>
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Details</th>
                            <th>Units in Carton</th>
                            <th>Net Weight</th>
                            <th>Gross Weight</th>
                            <th>Status</th>
                            <th>Sizes</th>
                            <th>Serials</th>
                            <th>Alet Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong> Name : </strong>{{ $product->p_name }} </br>
                                <strong> Account : </strong>{{ $product->acc_title }} </br>
                                <strong> Brand : </strong>{{ $product->brand_title }} </br>
                                <strong> Category : </strong>{{ $product->cat_title }} </br>
                            </td>
                            <td>{{ $product->p_units_in_carton }} </td>
                            <td>{{ $product->p_net_weight }}</td>
                            <td>{{ $product->p_gross_weight }}</td>
                            <td>{!! status($product->p_status) !!}</td>
                            <td>
                                @if(!empty($product->p_box_size_length))
                                <strong> Box Size :
                                </strong>({{ $product->p_box_size_length.'x'.$product->p_box_size_width.'x'.$product->p_box_size_height }})
                                {{ $product->p_box_size_unit }}
                                @endif
                                <br>
                                @if(!empty($product->p_carton_size_length))
                                <strong> Carton Size :
                                </strong>({{ $product->p_carton_size_length.'x'.$product->p_carton_size_width.'x'.$product->p_carton_size_height }})
                                {{ $product->p_carton_size_unit }}
                                @endif

                            </td>
                            <td>
                                Start From : {{ $product->p_serial_starts_from }}
                                <br />
                                Current Serial : {{ $product->p_serial_current }}
                            </td>
                            <td>{{ $product->p_alert_qty }}</td>
                            <td>
                            @can('EditProductProfile')
                                <a href="{{route('product.edit', $product->p_id)}}"
                                    class="fadeIn animated bx bx-pencil bx-sm">
                                </a>
                            @endcan
                            @can('DeleteProductProfile')
                                <a href="#" class="fadeIn animated bx bx-trash bx-sm"
                                    onclick="confirm_modal('{{route("product.delete", ["id" => $product->p_id])}}');">
                                </a>
                                @endcan
                                <!-- <a href="#" class="fadeIn animated bx bx-plus bx-sm"
                                    onclick="showAjaxModal('{{-- route("productitem.create", ["id" => $product->p_id]) --}}');">
                                </a> -->
                                @can('CreateProductitem')
                                <a href='{{route("productitem.create", ["id" => $product->p_id])}} '
                                    class="fadeIn animated bx bx-plus bx-sm" target="_blank">
                                </a>
                                @endcan
                                @can('ViewProductitem')
                                <a class="fadeIn animated lni lni-eye" style="font-size: x-large;"
                                    href="{{route('productitem.index')}}" target="_blank"></a>
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
$('#acc_id').change(function() {
    var acc_id = $(this).val();
    var _token = $("input[name='_token']").val();
    if (acc_id != '') {
        $.ajax({
            type: "POST",
            url: 'get_account_brands',
            url: "{{ route('get_account_brands') }}",
            data: ({
                _token: _token,
                acc_id: acc_id
            }),
            dataType: "html",
            success: function(response) {
                $("#brand_id").html(response);
            }
        });
    }
});

$('#brand_id').change(function() {
    var brand_id = $(this).val();
    var _token = $("input[name='_token']").val();
    if (brand_id != '') {
        $.ajax({
            type: "POST",
            url: 'get_brand_categories',
            url: "{{ route('get_brand_categories') }}",
            data: ({
                _token: _token,
                brand_id: brand_id
            }),
            dataType: "html",
            success: function(response) {
                $("#cat_id").html(response);
            }
        });
    }
});



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
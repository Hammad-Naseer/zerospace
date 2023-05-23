@extends('layouts.app')

@section('content')

<!--sidebar wrapper -->
@include('partials.sidebar')
<!--end sidebar wrapper -->

<!--start header -->
@include('partials.topbar')
<!--end header -->

<div class="page-content">
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Product Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">Product Profile Registration</h5>
                    </div>
                    <hr>
                    <form action="{{ route('create_product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="mt-4 col-lg-4">
                                    <label for="acc_id" class="form-label">Select Account</label> <span
                                        class="text-danger"> *
                                    </span>
                                    <select class="form-control" name="acc_id" id="acc_id" required>
                                        {!! account_dropdown() !!}
                                    </select>
                                    @if ($errors->has('acc_id'))
                                    <span class="text-danger">{{ $errors->first('acc_id') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4 col-lg-4">
                                    <label for="brand_id" class="form-label">Select Brand</label> <span
                                        class="text-danger"> *
                                    </span>
                                    <select class="form-control" name="brand_id" id="brand_id" required>
                                        <!-- {!! brand_dropdown() !!} -->
                                    </select>
                                    @if ($errors->has('brand_id'))
                                    <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4 col-lg-4">
                                    <label for="cat_id" class="form-label">Category</label> <span class="text-danger"> *
                                    </span>
                                    <select name="cat_id" id="cat_id" class="single-select  form-control"
                                        aria-label="Default select example" required>
                                        <!-- {!! category_dropdown() !!} -->
                                    </select>
                                    @if ($errors->has('cat_id'))
                                    <span class="text-danger">{{ $errors->first('cat_id') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4 col-lg-6">
                                    <label for="p_name" class="form-label">Product Title</label> <span
                                        class="text-danger"> *
                                    </span>
                                    <input type="text" name="p_name" class="form-control" id="p_name"
                                        placeholder="Enter product title" required>
                                    @if ($errors->has('p_name'))
                                    <span class="text-danger">{{ $errors->first('p_name') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4 col-lg-6">
                                    <label for="inputProductDescription" class="form-label">Product Status</label> <span
                                        class="text-danger"> * </span>
                                    {!! status_dropdown("" ,"p_status" ,"p_status") !!}
                                    @if ($errors->has('p_status'))
                                    <span class="text-danger">{{ $errors->first('p_status') }}</span>
                                    @endif
                                </div>

                                <div class="mt-4 col-lg-12">
                                    <label for="p_description" class="form-label">Description</label>
                                    <textarea class="form-control" name="p_description" id="p_description"
                                        rows="3"></textarea>
                                    @if ($errors->has('p_description'))
                                    <span class="text-danger">{{ $errors->first('p_description') }}</span>
                                    @endif
                                </div>
                                <div class="row mt-4">
                                    <label for="p_box_size_length" class="form-label">Box Size</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="p_box_size_length" class="form-control"
                                            id="p_box_size_length" placeholder="Enter Box Size Length">
                                        @if ($errors->has('p_box_size_length'))
                                        <span class="text-danger">{{ $errors->first('p_box_size_length') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="p_box_size_width" class="form-control"
                                            id="p_box_size_width" placeholder="Enter Box Size Width">
                                        @if ($errors->has('p_box_size_width'))
                                        <span class="text-danger">{{ $errors->first('p_box_size_width') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="p_box_size_height" class="form-control"
                                            id="p_box_size_height" placeholder="Enter Box Size Height">
                                        @if ($errors->has('p_box_size_height'))
                                        <span class="text-danger">{{ $errors->first('p_box_size_height') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        <select name="p_box_size_unit" id="p_box_size_unit"
                                            class="single-select  form-control" aria-label="Default select example">
                                            <option value="">Select Unit</option>
                                            <option value="mm">MM</option>
                                            <option value="cm">CM</option>
                                            <option value="inch">Inches</option>
                                            <option value="feet">Feet</option>
                                            @if ($errors->has('p_box_size_unit'))
                                            <span class="text-danger">{{ $errors->first('p_box_size_unit') }}</span>
                                            @endif
                                        </select>
                                        @if ($errors->has('p_box_size_unit'))
                                        <span class="text-danger">{{ $errors->first('p_box_size_unit') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label for="p_carton_size_length" class="form-label">Carton Size</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="p_carton_size_length" class="form-control"
                                            id="p_carton_size_length" placeholder="Enter Carton Size Length">
                                        @if ($errors->has('p_carton_size_length'))
                                        <span class="text-danger">{{ $errors->first('p_carton_size_length') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="p_carton_size_width" class="form-control"
                                            id="p_carton_size_width" placeholder="Enter Carton Size Width">
                                        @if ($errors->has('p_carton_size_width'))
                                        <span class="text-danger">{{ $errors->first('p_carton_size_width') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="p_carton_size_height" class="form-control"
                                            id="p_carton_size_height" placeholder="Enter Carton Size Height">
                                        @if ($errors->has('p_carton_size_height'))
                                        <span class="text-danger">{{ $errors->first('p_carton_size_height') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        <select name="p_carton_size_unit" id="p_carton_size_unit"
                                            class="single-select form-control" aria-label="Default select example">
                                            <option value="">Select Unit</option>
                                            <option value="mm">MM</option>
                                            <option value="cm">CM</option>
                                            <option value="inch">Inches</option>
                                            <option value="feet">Feet</option>
                                            @if ($errors->has('p_carton_size_unit'))
                                            <span class="text-danger">{{ $errors->first('p_carton_size_unit') }}</span>
                                            @endif
                                        </select>
                                        @if ($errors->has('p_carton_size_unit'))
                                        <span class="text-danger">{{ $errors->first('p_carton_size_unit') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4 col-lg-4">
                                    <label for="p_units_in_carton" class="form-label">Units In Carton</label>
                                    <input type="number" name="p_units_in_carton" class="form-control"
                                        id="p_units_in_carton" placeholder="Enter Units In Carton">
                                    @if ($errors->has('p_units_in_carton'))
                                    <span class="text-danger">{{ $errors->first('p_units_in_carton') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4 col-lg-4">
                                    <label for="p_net_weight" class="form-label">Product Net Weight</label>
                                    <input type="text" name="p_net_weight" class="form-control" id="p_net_weight"
                                        placeholder="Enter product Net Weight">
                                    @if ($errors->has('p_net_weight'))
                                    <span class="text-danger">{{ $errors->first('p_net_weight') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4 col-lg-4">
                                    <label for="p_gross_weight" class="form-label">Product Gross Weight</label>
                                    <input type="text" name="p_gross_weight" class="form-control" id="p_gross_weight"
                                        placeholder="Enter product Gross Weight">
                                    @if ($errors->has('p_gross_weight'))
                                    <span class="text-danger">{{ $errors->first('p_gross_weight') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4 col-lg-4">
                                    <label for="p_serial_starts_from" class="form-label">Product Serial Initial</label>
                                    <span class="text-danger"> * </span>
                                    <input type="text" name="p_serial_starts_from" class="form-control"
                                        id="p_serial_starts_from" placeholder="Enter Product Serial Initial eg.B-0" required>
                                    @if ($errors->has('p_serial_starts_from'))
                                    <span class="text-danger">{{ $errors->first('p_serial_starts_from') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4 col-lg-4">
                                    <label for="p_alert_qty" class="form-label">Alert Qty</label>
                                    <span class="text-danger"> * </span>
                                    <input type="text" name="p_alert_qty" class="form-control" id="p_alert_qty"
                                        placeholder="Enter Alert Qty" required>
                                    @if ($errors->has('p_alert_qty'))
                                    <span class="text-danger">{{ $errors->first('p_alert_qty') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="mt-4 col-lg-4">
                                    <label for="p_listing_owner" class="form-label">Listing Owner</label>
                                    <select name="p_listing_owner" id="p_listing_owner"
                                        class="single-select  form-control" aria-label="Default select example">
                                        {!! listingowners_dropdown() !!}
                                    </select>
                                   
                                </div> -->

                                <div class="mt-4 col-lg-12">
                                    <button type="submit" class="btn btn-primary float-end">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
</script>

<!--start page footer -->
@include('partials.footer')
<!--start page footer -->

<!--start switcher-->
@include('partials.theme_customizer')
<!--end switcher-->
@endsection
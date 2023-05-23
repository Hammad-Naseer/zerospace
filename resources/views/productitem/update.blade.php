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
                    <li class="breadcrumb-item active" aria-current="page">Update Item</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Update Item</h5>
            <hr />

            <div class="form-body mt-4">
                <form action="{{ route('product_item.update' ,$items->item_id)}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="mt-4 col-lg-3">
                                <label for="item_serial_no" class="form-label">Item Serial No</label> <span class="text-danger"> *
                                </span>
                                <input type="text" name="item_serial_no" class="form-control" id="item_serial_no"
                                    value="{{ $items->item_serial_no }}" placeholder="Item Barcode" readonly>

                            </div>

                            <div class="mt-4 col-lg-3">
                                <label for="p_id" class="form-label">Select Product</label> <span class="text-danger"> *
                                </span>
                                <select class="form-control" name="p_id" id="p_id">
                                    {!! product_dropdown($items->p_id) !!}
                                </select>
                                @if ($errors->has('p_id'))
                                <span class="text-danger">{{ $errors->first('p_id') }}</span>
                                @endif
                            </div>

                            <div class="mt-4 col-lg-3">
                                <label for="p_name" class="form-label">Select Variant</label> <span class="text-danger">
                                    * </span>
                                <select name="var_id" id="var_id" onchange='focus_input(this)'
                                    class="single-select mb-3 form-control" aria-label="Default select example"
                                    required>
                                    {!! variant_dropdown($items->var_id) !!}
                                </select>
                                @if ($errors->has('var_id'))
                                <span class="text-danger">{{ $errors->first('var_id') }}</span>
                                @endif
                            </div>

                            <!-- <div class="mt-4 col-lg-3">
                                <label for="p_name" class="form-label">Item Barcode</label>  <span class="text-danger"> * </span>
                                <input type="text" name="item_barcode" class="form-control" id="item_barcode" value="{{ $items->item_barcode }}" placeholder="Item Barcode" required>
                               
                            </div> -->
                            <div class="mt-4 col-lg-3">
                                <label for="p_name" class="form-label">SKU</label> <span class="text-danger"> * </span>
                                <input type="text" name="item_sku" class="form-control" id="item_sku"
                                    value="{{ $items->item_sku }}" placeholder="Enter Item SKU" required>
                                @if ($errors->has('item_sku'))
                                <span class="text-danger">{{ $errors->first('item_sku') }}</span>
                                @endif
                            </div>

                            <div class="mt-4 col-lg-3">
                                <label for="p_name" class="form-label">ASIN</label> <span class="text-danger"> * </span>
                                <input type="text" name="item_asin" class="form-control" id="item_asin"
                                    value="{{ $items->item_asin }}" placeholder="Enter Item ASIN" required>
                                @if ($errors->has('item_asin'))
                                <span class="text-danger">{{ $errors->first('item_asin') }}</span>
                                @endif
                            </div>

                            <div class="mt-4 col-lg-3">
                                <label for="p_name" class="form-label">Barcode Image</label> <span class="text-danger">
                                    * </span>

                                <input id="item_barcode_img" class="form-control file-input" type="file" name="item_barcode_img"
                                    value="{{ $items->item_barcode_img }}" placeholder="Barcode Image" />
                                @if ($errors->has('item_barcode_img'))
                                <span class="text-danger">{{ $errors->first('item_barcode_img') }}</span>
                                @endif
                            </div>

                            <div class="product-img mt-5 col-lg-3">
                                <img src="{{ asset('public/' .$items->item_barcode_img )}}" class="card-img-top" alt="...">
                                <!-- <a target="_blank" href="{{url($items->item_barcode_img)}}"><i class="lni lni-download"> </i></a>&nbsp -->
                                <input type="hidden" name="item_barcode_img_old" value="{{$items->item_barcode_img}}">
                            </div>

                            

                            <div class="mt-4 col-lg-3">
                                <label for="p_name" class="form-label">Item Image</label> <span class="text-danger"> *
                                </span>
                                <input id="item_img" class="form-control file-input" type="file" name="item_img"
                                    value="{{ $items->item_img }}" placeholder="Item Image" />
                                @if ($errors->has('item_img'))
                                <span class="text-danger">{{ $errors->first('item_img') }}</span>
                                @endif
                            </div>

                            <div class="product-img mt-5 col-lg-3">
                                <img src="{{ asset('public/' .$items->item_img)}}" class="card-img-top" alt="...">&nbsp
                                <!-- <a target="_blank" href="{{url($items->item_img)}}"><i class="lni lni-download"> </i></a> -->
                                <input type="hidden" name="item_img_old" value="{{$items->item_img}}">
                            </div>

                            <div class="mt-4 col-lg-3">
                                <label for="p_name" class="form-label">Purchase Price</label> <span class="text-danger">
                                    * </span>
                                <input type="text" name="item_pur_price" class="form-control"
                                    id="item_pur_price" value="{{ $items->item_pur_price }}"
                                    placeholder="Enter Pur Price" required>
                                @if ($errors->has('item_pur_price'))
                                <span class="text-danger">{{ $errors->first('item_pur_price') }}</span>
                                @endif
                            </div>

                            <div class="mt-4 col-lg-12">
                                <button type="submit" class="btn btn-primary float-end">Update</button>
                            </div>
                        </div>
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
    $(document).ready(function() {
        $("#p_id").prop("disabled", true);
        $("#var_id").prop("disabled", true);
    })
    </script>
    @endsection
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
        <div class="breadcrumb-title pe-3">Categories</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Categories</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <h6 class="mb-0 text-uppercase">Update Categories</h6>
            <hr />
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">Category Update</h5>
                    </div>
                    <hr>
                    <form action="{{route('category.update',$category->cat_id)}}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="acc_id" class="form-label">Select Account</label> <span class="text-danger">*</span>
                            <select class="form-control" name="acc_id" id="acc_id" required>
                                {!! account_dropdown($category->acc_id) !!}
                            </select>
                            @if ($errors->has('acc_id'))
                            <span class="text-danger">{{ $errors->first('acc_id') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="brand_id" class="form-label">Select Brand</label> <span class="text-danger">*</span>
                            <select class="form-control" name="brand_id" id="brand_id" required>
                                {!! brand_dropdown($category->brand_id) !!}
                            </select>
                            @if ($errors->has('brand_id'))
                            <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="cat_title" class="form-label">Category Title</label> <span class="text-danger">*</span>
                            <input type="text" name="cat_title" class="form-control" value="{{ $category->cat_title }}"
                                id="cat_title" required>
                            @if ($errors->has('cat_title'))
                            <span class="text-danger">{{ $errors->first('cat_title') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="cat_status" class="form-label">Category Status</label> <span class="text-danger">*</span>
                            {!! status_dropdown($category->cat_status ,"cat_status" ,"cat_status") !!}
                            @if ($errors->has('cat_status'))
                            <span class="text-danger">{{ $errors->first('cat_status') }}</span>
                            @endif
                        </div>

                        <div class="mt-4 col-lg-12">
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>

<!--start page footer -->
@include('partials.footer')
<!--start page footer -->
<!--start switcher-->
@include('partials.theme_customizer')
<!--end switcher-->
@endsection
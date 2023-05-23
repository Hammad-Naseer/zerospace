<!-- {{$categories}} -->
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
        <div class="breadcrumb-title pe-3">Categories</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Categories</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

            <a href="#" class="btn btn-primary px-5 radius-30"
                onclick="showAjaxModal('{{route("open_popup", ["page_name" => "category.create"])}}');">
                <i class="bx bx-plus mr-1">
                </i>Add
                Category
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">ALL CATEGORIES</h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Category</th>
                            <th>Account</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$category->cat_title}}</td>
                            <td>{!! get_account_details($category->acc_id)->acc_title !!}</td>
                            <td>{!! get_brand_details($category->brand_id)->brand_title !!}</td>
                            <td>{!! status($category->cat_status) !!}</td>

                            <td>
                            @can('EditCategory')
                                <a href="{{route('category.edit',$category->cat_id)}}"><i
                                        class="fadeIn animated bx bx-pencil bx-sm"></i></a>
                                        @endcan
                                @can('DeleteCategory')
                                <form method="post" action="{{route('category.destroy',$category->cat_id)}}"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" href="{{route('category.destroy',$category->cat_id)}}">
                                        <i class="fadeIn animated bx bx-trash bx-sm"></i>
                                    </button>
                                </form>
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
@endsection
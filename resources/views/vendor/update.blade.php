<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Supplier Update</h5>
        </div>
        <hr>
        <form action="{{ route('vendor.update',$vendor->vend_id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 mt-4">
                    <label for="vend_name" class="form-label">Supplier Title</label> <span class="text-danger"> * </span>
                    <input type="text" name="vend_name" class="form-control" value="{{ $vendor->vend_name }}"
                        id="vend_name" placeholder="Enter Supplier title" required>
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="vend_city" class="form-label">Supplier City</label> <span class="text-danger"> * </span>
                    <input type="text" name="vend_city" class="form-control" id="vend_city"
                        value="{{ $vendor->vend_city }}" placeholder="Enter Supplier title" required>
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="image" class="form-label">Supplier Mobile</label>
                    <input type="number" name="vend_mobile" class="form-control" id="vend_mobile"
                        value="{{ $vendor->vend_mobile }}" placeholder="Enter Supplier City">
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="vend_status" class="form-label">Supplier Status</label> <span class="text-danger"> * </span>
                    {!! status_dropdown($vendor->vend_status,"vend_status" ,"vend_status") !!}
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="vend_profile" class="form-label">Supplier Profile</label>
                    <input type="text" name="vend_profile" class="form-control" value="{{ $vendor->vend_profile }}"
                        id="vend_profile" placeholder="Enter Supplier Profile">
                </div>
                <div class="col-lg-6 mt-4 mb-2">
                    <label for="p_id" class="form-label">Select Product</label>
                    <select name="p_id" id="p_id" class="single-select mb-3 form-control"
                        aria-label="Default select example">
                        {!! product_dropdown($vendor->p_id) !!}
                    </select>
                </div>

                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Update</button>
        </form>
    </div>
</div>
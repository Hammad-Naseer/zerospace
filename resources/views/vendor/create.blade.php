<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Supplier Registration</h5>
        </div>
        <hr>
        <form action="{{ route('create_vendor.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 mt-4">
                    <label for="vend_name" class="form-label">Supplier Name</label> <span class="text-danger"> * </span>
                    <input type="text" name="vend_name" class="form-control" id="vend_name"
                        placeholder="Enter Supplier Name" value="{{old('vend_name')}}" required>
                    @if ($errors->has('vend_name'))
                    <span class="text-danger">{{ $errors->first('vend_name') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="vend_city" class="form-label">Supplier City</label> <span class="text-danger"> * </span>
                    <input type="text" name="vend_city" class="form-control" id="vend_city"
                        placeholder="Enter Supplier City" value="{{old('vend_city')}}" required>
                    @if ($errors->has('vend_city'))
                    <span class=" text-danger">{{ $errors->first('vend_city') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="vend_mobile" class="form-label">Supplier Mobile</label> 
                    <input type="number" name="vend_mobile" class="form-control" id="vend_mobile"
                        placeholder="Enter Supplier Mobile" value="{{old('vend_mobile')}}">
                    @if ($errors->has('vend_mobile'))
                    <span class=" text-danger">{{ $errors->first('vend_mobile') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="vend_status" class="form-label">Supplier Status</label> <span class="text-danger"> * </span>
                    {!! status_dropdown("" ,"vend_status" ,"vend_status") !!}
                    @if ($errors->has('vend_status'))
                    <span class="text-danger">{{ $errors->first('vend_status') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="vend_profile" class="form-label">Supplier Profile</label> 
                    <input type="text" name="vend_profile" class="form-control" id="vend_profile"
                        placeholder="Enter Supplier Profile" value="{{old('vend_profile')}}">
                    @if ($errors->has('vend_profile'))
                    <span class=" text-danger">{{ $errors->first('vend_profile') }}</span>
                    @endif
                </div>

                <div class="col-lg-6 mt-4 mb-2">
                    <label for="p_id" class="form-label">Select Product</label>
                    <select name="p_id" id="p_id" class="single-select mb-3 form-control"
                        aria-label="Default select example">
                        {!! product_dropdown() !!}
                    </select>
                </div>
                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>


</div>
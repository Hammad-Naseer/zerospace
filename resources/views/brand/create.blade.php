<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Brand Registration</h5>
        </div>
        <hr>
        <form action="{{ route('create_brand.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <label for="acc_id" class="form-label">Select Account</label> <span class="text-danger">*</span>
                    <select class="form-control" name="acc_id" id="acc_id" required>
                        {!! account_dropdown() !!}
                    </select>
                    @if ($errors->has('acc_id'))
                    <span class="text-danger">{{ $errors->first('acc_id') }}</span>
                    @endif
                </div>
                <div class="col-lg-6">
                    <label for="brand_title" class="form-label">Brand Title </label> <span class="text-danger">*</span>
                    <input type="text" name="brand_title" class="form-control" id="brand_title"
                        value="{{old('brand_title')}}" placeholder="Enter Brand Name" required>
                    @if ($errors->has('brand_title'))
                    <span class="text-danger">{{ $errors->first('brand_title') }}</span>
                    @endif
                </div>
                <div class="col-lg-6">
                    <label for="brand_status" class="form-label">Brand Status</label> <span class="text-danger">*</span>
                    {!! status_dropdown("" ,"brand_status" ,"brand_status") !!}
                    @if ($errors->has('brand_status'))
                    <span class="text-danger">{{ $errors->first('brand_status') }}</span>
                    @endif
                </div>
                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Listing Owner Registration</h5>
        </div>
        <hr>
        <form action="{{ route('create_listing_owner.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <label for="list_owner_name" class="form-label">Owner Title </label><span class="text-danger">*</span>
                    <input type="text" name="list_owner_name" class="form-control" id="list_owner_name" value="{{old('list_owner_name')}}"
                        placeholder="Enter Account Name">
                    @if ($errors->has('list_owner_name'))
                    <span class="text-danger">{{ $errors->first('list_owner_name') }}</span>
                    @endif
                </div>
                <div class="col-lg-6">
                    <label for="list_owner_status" class="form-label">Owner Status</label><span class="text-danger">*</span>
                    {!! status_dropdown("" ,"list_owner_status" ,"list_owner_status") !!}
                    @if ($errors->has('list_owner_status'))
                    <span class="text-danger">{{ $errors->first('list_owner_status') }}</span>
                    @endif
                </div>
                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
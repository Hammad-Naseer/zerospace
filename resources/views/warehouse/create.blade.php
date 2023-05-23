<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Warehouse Registration</h5>
        </div>
        <hr>
        <form action="{{ route('create_warehouse.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 mt-4">
                    <label for="wh_title" class="form-label">Warehouse Title</label> <span class="text-danger"> * </span>
                    <input type="text" name="wh_title" class="form-control" id="wh_title"
                        placeholder="Enter WareHouse Title" value="{{old('wh_title')}}" required>
                    @if ($errors->has('wh_title'))
                    <span class="text-danger">{{ $errors->first('wh_title') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="wh_contactperson" class="form-label">Contact Person</label>
                    <input type="text" name="wh_contactperson" class="form-control" id="wh_contactperson"
                        placeholder="Enter WareHouse Contact Person" value="{{old('wh_contactperson')}}">
                    @if ($errors->has('wh_contactperson'))
                    <span class=" text-danger">{{ $errors->first('wh_contactperson') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="wh_contactnumber" class="form-label">Contact #</label> 
                    <input type="number" name="wh_contactnumber" class="form-control" id="wh_contactnumber"
                        placeholder="Enter WareHouse Mobile" value="{{old('wh_contactnumber')}}">
                    @if ($errors->has('wh_contactnumber'))
                    <span class=" text-danger">{{ $errors->first('wh_contactnumber') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="wh_location" class="form-label">Loaction</label> <span class="text-danger"> * </span>
                    <input type="text" name="wh_location" class="form-control" id="wh_location"
                        placeholder="Enter WareHouse Address" value="{{old('wh_location')}}" required>
                    @if ($errors->has('wh_location'))
                    <span class=" text-danger">{{ $errors->first('wh_location') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="wh_status" class="form-label">Status</label> <span class="text-danger"> * </span>
                    {!! status_dropdown("" ,"wh_status" ,"wh_status") !!}
                    @if ($errors->has('wh_status'))
                    <span class="text-danger">{{ $errors->first('wh_status') }}</span>
                    @endif
                </div>
                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
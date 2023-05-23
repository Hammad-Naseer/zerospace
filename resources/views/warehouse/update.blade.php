<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">WareHouse Update</h5>
        </div>
        <hr>
        <form action="{{ route('warehouse.update',$warehouse->wh_id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 mt-4">
                    <label for="wh_title" class="form-label">WareHouse Title</label> <span class="text-danger"> * </span>
                    <input type="text" name="wh_title" class="form-control" value="{{ $warehouse->wh_title }}"
                        id="wh_title" placeholder="Enter WareHouse title" required>
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="wh_contactperson" class="form-label">WareHouse Contact
                        Person</label> 
                    <input type="text" name="wh_contactperson" class="form-control" id="wh_contactperson"
                        value="{{ $warehouse->wh_contactperson }}" placeholder="Enter Contact Person">
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="wh_contactnumber" class="form-label">WareHouse Contact
                        Number</label>
                    <input type="number" name="wh_contactnumber" class="form-control" id="wh_contactnumber"
                        value="{{ $warehouse->wh_contactnumber }}" placeholder="Enter Contact Number">
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="wh_location" class="form-label">WareHouse Location</label> <span class="text-danger"> * </span>
                    <input type="text" name="wh_location" class="form-control" value="{{ $warehouse->wh_location }}"
                        id="wh_location" placeholder="Enter WareHouse Location" required>
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="wh_status" class="form-label">WareHouse Status</label> <span class="text-danger"> * </span>
                    {!! status_dropdown($warehouse->wh_status,"wh_status" ,"wh_status") !!}
                </div>
                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
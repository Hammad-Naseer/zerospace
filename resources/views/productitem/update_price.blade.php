<div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Update Item Sale Price</h5>
            <hr />

            <div class="form-body mt-4">
                <form action="{{ route('productitem.update_price' ,$item_price->item_id)}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="mt-4 col-lg-12">
                                <label for="item_sale_price" class="form-label">Item Sale Price</label> <span class="text-danger"> *
                                </span>
                                <input type="text" name="item_sale_price" class="form-control" id="item_sale_price"
                                    value="{{ $item_price->item_sale_price }}" >

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
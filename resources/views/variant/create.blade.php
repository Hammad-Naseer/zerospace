<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Variation Registration</h5>
        </div>
        <hr>

        <form action="{{ route('create_variant.store') }}" method="post">
            @csrf
            <div class="row">

                <div class="col-lg-6 mt-4">
                    <label for="var_color" class="form-label">Variation Color </label>
                    <input type="text" name="var_color" class="form-control" id="var_color" value="{{old('var_color')}}"
                        placeholder="Enter Variation Color">
                    @if ($errors->has('var_color'))
                    <span class="text-danger">{{ $errors->first('var_color') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="var_size" class="form-label">Variation Size </label>
                    <input type="text" name="var_size" class="form-control" id="var_size" value="{{old('var_size')}}"
                        placeholder="Enter Variation Size">
                    @if ($errors->has('var_size'))
                    <span class="text-danger">{{ $errors->first('var_size') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="var_material" class="form-label">Variation Material </label>
                    <input type="text" name="var_material" class="form-control" id="var_material"
                        value="{{old('var_material')}}" placeholder="Enter Variation Material">
                    @if ($errors->has('var_material'))
                    <span class="text-danger">{{ $errors->first('var_material') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="var_weight" class="form-label">Variation Weight </label>
                    <input type="text" name="var_weight" class="form-control" id="var_weight"
                        value="{{old('var_weight')}}" placeholder="Enter Variation Weight">
                    @if ($errors->has('var_weight'))
                    <span class="text-danger">{{ $errors->first('var_weight') }}</span>
                    @endif
                </div>
            </div>
            <div class="mt-4 col-lg-12">
                <button type="submit" class="btn btn-primary float-end">Save</button>
            </div>
        </form>
    </div>
</div>
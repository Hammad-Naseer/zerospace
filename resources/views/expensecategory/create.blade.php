<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Expense Category Registration</h5>
        </div>
        <hr>
        <form action="{{ route('expensecategories.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <label for="exp_cat_title" class="form-label">Category Title </label><span class="text-danger">*</span>
                    <input type="text" name="exp_cat_title" class="form-control" id="exp_cat_title"
                        value="{{old('exp_cat_title')}}" placeholder="Category Title" required>
                    @if ($errors->has('exp_cat_title'))
                    <span class="text-danger">{{ $errors->first('exp_cat_title') }}</span>
                    @endif
                </div>
                <div class="col-lg-6">
                    <label for="exp_cat_code" class="form-label">Category Code </label>
                    <input type="text" name="exp_cat_code" class="form-control" id="exp_cat_code"  placeholder="Category Code">

                </div>
                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
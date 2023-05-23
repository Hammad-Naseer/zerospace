<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Expense Registration</h5>
        </div>
        <hr>
        <form action="{{ route('expense.store') }}" method="post">
            @csrf
            <div class="row">

                <div class="col-lg-6 mt-4">
                    <label for="exp_cat_id" class="form-label">Expense </label> <span
                        class="text-danger">*</span>
                    <select class="form-control " name="exp_cat_id"  id="exp_cat_id" required>
                        {!! expense_category_dropdown() !!}
                    </select>
                    @if ($errors->has('exp_cat_id'))
                    <span class="text-danger">{{ $errors->first('exp_cat_id') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="exp_date" class="form-label">Expense Date </label> <span
                        class="text-danger">*</span>
                    <input type="date" name="exp_date" class="form-control" id="exp_date" required>
                    @if ($errors->has('exp_date'))
                    <span class="text-danger">{{ $errors->first('exp_date') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="exp_amount" class="form-label">Expense Amount </label> <span
                        class="text-danger">*</span>
                    <input type="text" name="exp_amount" class="form-control" id="exp_amount"
                        placeholder="Expense Amount" required>
                    @if ($errors->has('exp_amount'))
                    <span class="text-danger">{{ $errors->first('exp_amount') }}</span>
                    @endif
                </div>
                <div class="col-lg-12 mt-4">
                    <label for="exp_details" class="form-label">Expense Details </label> <span
                        class="text-danger">*</span>
                    <textarea name="exp_details" class="form-control" id="exp_details"
                        placeholder="Expense Details" rows="5" required></textarea>
                    @if ($errors->has('exp_details'))
                    <span class="text-danger">{{ $errors->first('exp_details') }}</span>
                    @endif
                </div>
                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
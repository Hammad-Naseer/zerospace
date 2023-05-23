<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Amazon Account Update</h5>
        </div>
        <hr>
        <form action="{{ route('account.update',$account->acc_id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <label for="acc_title" class="form-label">Account Title</label><span class="text-danger">*</span>
                    <input type="text" name="acc_title" class="form-control" value="{{ $account->acc_title }}"
                        id="acc_title" placeholder="Enter Account title" required>
                    @if ($errors->has('acc_title'))
                    <span class="text-danger">{{ $errors->first('acc_title') }}</span>
                    @endif
                </div>
                <div class="col-lg-6">
                    <label for="inputProductDescription" class="form-label">Account Status</label><span class="text-danger">*</span>
                    {!! status_dropdown($account->acc_status,"acc_status" ,"acc_status") !!}
                    @if ($errors->has('acc_status'))
                    <span class="text-danger">{{ $errors->first('acc_status') }}</span>
                    @endif
                </div>
                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Update</button>
                </div>
            </div>

        </form>
    </div>

</div>
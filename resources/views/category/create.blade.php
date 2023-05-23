<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Category Registration</h5>
        </div>
        <hr>
        <form action="{{route('category.store')}}" method="POST" class="row g-3">
            @csrf
            <div class="row">
                <div class="col-lg-6 mt-4">
                    <label for="acc_id" class="form-label">Select Account</label> <span class="text-danger">*</span>
                    <select class="form-control" name="acc_id" id="acc_id" required>
                        {!! account_dropdown() !!}
                    </select>
                    @if ($errors->has('acc_id'))
                    <span class="text-danger">{{ $errors->first('acc_id') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="brand_id" class="form-label">Select Brand</label> <span class="text-danger">*</span>
                    <select class="form-control" name="brand_id" id="brand_id" required>
                        <!-- {!! brand_dropdown() !!} -->
                    </select>
                    @if ($errors->has('brand_id'))
                    <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="cat_title" class="form-label">Category Title</label> <span class="text-danger">*</span>
                    <input type="text" name="cat_title" class="form-control" id="cat_title" required placeholder="Enter Category Title" value="{{old('cat_title')}}">
                    @if ($errors->has('cat_title'))
                    <span class="text-danger">{{ $errors->first('cat_title') }}</span>
                    @endif
                </div>
                <div class="col-lg-6 mt-4">
                    <label for="cat_status" class="form-label">Category Status</label> <span class="text-danger">*</span>
                    {!! status_dropdown("" ,"cat_status" ,"cat_status") !!}
                    @if ($errors->has('cat_status'))
                    <span class="text-danger">{{ $errors->first('cat_status') }}</span>
                    @endif
                </div>
                <div class="mt-4 col-lg-12">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#acc_id').change(function() {
        var acc_id = $(this).val();
        var _token = $("input[name='_token']").val();
        if (acc_id != '') {
            $.ajax({
                type: "POST",
                url: 'get_account_brands',
                url: "{{ route('get_account_brands') }}",
                data: ({
                    _token: _token,
                    acc_id: acc_id
                }),
                dataType: "html",
                success: function(response) {
                    $("#brand_id").html(response);
                }
            });
        }
    });
</script>
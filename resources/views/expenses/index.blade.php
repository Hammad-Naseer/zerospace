@extends('layouts.app')

@section('content')

<!--sidebar wrapper -->
@include('partials.sidebar')
<!--end sidebar wrapper -->

<!--start header -->
@include('partials.topbar')
<!--end header -->

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Expense</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Expense</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="#" class="btn btn-primary px-5 radius-30"
                onclick="showAjaxModal('{{route("open_popup", ["page_name" => "expenses.create"])}}');">
                <i class="bx bx-plus mr-1">
                </i>Add
                Expense</a>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('partials.errors')
    <h6 class="mb-0 text-uppercase">All Expense</h6>
    <hr />
    <form action="" method="GET" id="myForm">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-3">
                <label class="form-label">Expense Category</label>
                <select class="form-control" name="exp_cat_id" id="exp_cat_id">
                    {!! expense_category_dropdown($exp_cat_id) !!}
                </select>
            </div>

            <div class="col-lg-3">
                <label for="start_date" class="form-label">Start Date </label>
                <input type="date" name="start_date" class="form-control" id="start_date" value="{{$start_date}}">
            </div>
            <div class="col-lg-3">
                <label for="end_date" class="form-label">End Date </label>
                <input type="date" name="end_date" class="form-control" id="end_date" value="{{$end_date}}">
            </div>

            <div class="col-md-3 mt-4">
                <button class="btn btn-primary btn-sm">Filter</button>
                @if($filter == 1)
                <a href="{{URL::to('view_expenses')}}" class="btn btn-danger btn-sm">Remove Filter</a>
                    <input type="button" id="printButton"  class="btn btn-primary btn-sm" value="Print"/>
                @endif

            </div>

        </div>

    </form>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Expense Category (code)</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_expense = 0;
                        @endphp
                        @foreach ($expenses as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ get_expense_category_details($row->exp_cat_id)->exp_cat_title }}
                                ({{get_expense_category_details($row->exp_cat_id)->exp_cat_code}})</td>
                            <td>{{ date_view($row->exp_date) }}</td>
                            <td>{{ $row->exp_amount }} @php $total_expense += $row->exp_amount @endphp</td>
                            <td>{{ $row->exp_details }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align: right;" colspan="3">Total Expenses : </th>
                            <th>{{$total_expense }}</th>
                            <th></th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
</div>

<script>

    const printButton = document.getElementById('printButton');
    const myForm = document.getElementById('myForm');
    printButton.addEventListener('click', () => {
        myForm.action = '/print_expenses'; // set the action to the print endpoint
        myForm.method = 'POST'; // set the method to POST
        myForm.submit(); // submit the form
    });
</script>
<!--start page footer -->
@include('partials.footer')
<!--start page footer -->

<!--start switcher-->
@include('partials.theme_customizer')
<!--end switcher-->
@endsection
<style>
    #main {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid black;
        font-size: 14px;
        margin-top: 10px;
    }

    td {
        height: 30px;
    }

    #main td:nth-child(even) {
        background: #f0f0f0;
    }

    #main td:nth-child(odd) {
        background: #FFF;
    }

    th {
        font-weight: bold;
    }

    @page {
        margin: 10px 10px 30px 10px
    }

    hr {
        margin: 0px;
        padding: 0px;
        display: block;
        height: 1px;
        background: transparent;
        width: 100%;
        border: none;
        border-top: solid 1px #000;
    }

    textarea {
        margin-top: 10px;
        margin-left: 50px;
        width: 500px;
        height: 100px;
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        background: none repeat scroll 0 0 rgba(0, 0, 0, 0.07);
        border-color: -moz-use-text-color #FFFFFF #FFFFFF -moz-use-text-color;
        border-image: none;
        border-radius: 6px 6px 6px 6px;
        border-style: none solid solid none;
        border-width: medium 1px 1px medium;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.12) inset;
        color: #555555;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 1em;
        line-height: 1.4em;
        padding: 5px 8px;
        transition: background-color 0.2s ease 0s;
    }

    textarea:focus {
        background: none repeat scroll 0 0 #FFFFFF;
        outline-width: 0;
    }
</style>
<div style="padding: 30px; font-family: 'Exo' !important;">
    <div style="margin-top: 0px; margin-left: 4px; clear: both;">
        <div style="float: left;">
            <span style="font-size: 20px; letter-spacing: 2px; color:#9f1d1d;"><strong>StandOut FZE
                    LLC</strong></span><br>
            <span style="font-size: 14px;">Business Center, Sharjah Publishing</span><br>
            <span style="font-size: 14px;"> City Free Zone, Sharjah, UAE</span><br>
            <span style="font-size: 14px;">Email: khurram1988@outlook.com</span><br>
            <span style="font-size: 14px;">Mobile: +971 56 561 7640</span><br><br>
        </div>

        <div style="float: right; clear: both;">
            <span style="font-size: 20px; letter-spacing: 2px; color:#9f1d1d; text-decoration: underline;"><strong>Expense Details</strong></span><br>
            @if($start_date != "")
            <span style="font-size: 14px; float:right;">FROM: {{date_view($start_date) }}</span><br>
            @endif

            @if($start_date != "")
            <span style="font-size: 14px;float:right;">TO : {{ date_view($end_date) }}</span><br>
            @endif
        </div>
    </div>
    <!-- info row -->



    <table border="1" id="main" style="clear: both;">
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
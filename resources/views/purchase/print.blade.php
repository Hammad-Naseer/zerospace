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
    <div style="margin-top: 0px; margin-left: 4px;">
        <div style="float: left;">
            <span style="font-size: 20px; letter-spacing: 2px; color:#9f1d1d;"><strong>StandOut FZE
                    LLC</strong></span><br>
            <span style="font-size: 14px;">Business Center, Sharjah Publishing</span><br>
            <span style="font-size: 14px;"> City Free Zone, Sharjah, UAE</span><br>
            <span style="font-size: 14px;">Email: khurram1988@outlook.com</span><br>
            <span style="font-size: 14px;">Mobile: +971 56 561 7640</span><br><br>
        </div>

        <div style="float: right; clear: both;">
            <span style="font-size: 20px; letter-spacing: 2px; color:#9f1d1d; text-decoration: underline;"><strong>Purchase
                    Order</strong></span><br>
            <span style="font-size: 14px; float:right;">Purchase Ref #: {{ $purchase[0]->pur_refrence_no }}</span><br>
            <span style="font-size: 14px; float:right;">Date: {{ date_view($purchase[0]->pur_date) }}</span><br> <br>
        </div>
    </div>
    <!-- info row -->
    <div style="margin-top: 0px; margin-left: 4px; clear: both;">
        <div style="width: 100%;border: 1px solid #0a0a0a;margin-top: 15px;border-radius: 5px;">
            <span style="font-size: 20px; letter-spacing: 2px; color:#9f1d1d; margin-left:15px;">
                <strong>SupplierInfo</strong></span><br>
            <span
                style="font-size: 14px;padding-left: 15px;">{{ get_vendor_details($purchase[0]->vend_id)->vend_name }}</span><br>
            <span style="font-size: 14px;padding-left: 15px;">{{ get_vendor_details($purchase[0]->vend_id)->vend_city }}
            </span><br>
            <span
                style="font-size: 14px;padding-left: 15px;">{{ get_vendor_details($purchase[0]->vend_id)->vend_mobile }}</span><br>
        </div>
    </div>


    <table border="1" id="main">
        <thead>
            <tr style="background-color: #9f1d1d; color: white;">
                <th>Sr.</th>
                <th>Img</th>
                <th>Item</th>
                <th>Barcode</th>
                <th style="width: 200px;">Pur QTY</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total_qty = 0;
            $total_carton = 0;
            @endphp
            @foreach($purchase_detail as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img src="{{ $row->item_img }}" class="card-img-top" alt="..." style="width: 80px; height: 80px">
                </td>
                <td>
                    @if($row->item_id !="")
                    Item: {!! get_item_details($row->item_id)->p_name !!}</br>
                    @endif

                    @if($row->var_color !="")
                    Color: {{$row->var_color}}</br>
                    @endif

                    @if($row->var_size !="")
                    Size: {{$row->var_size}}</br>
                    @endif

                    @if($row->var_material !="")
                    Material: {{$row->var_material}}</br>
                    @endif

                    @if($row->var_weight !="")
                    Weight: {{$row->var_weight}}</br>
                    @endif
                </td>
                <td><img src="{{ $row->item_barcode_img }}" class="card-img-top" alt="..."
                        style="width: 250px; height: 100px"> </td>
                <td>
                    {{ $row->pur_item_qty }} @php $total_qty +=$row->pur_item_qty @endphp
                </td>
            </tr>
            @endforeach
        </tbody>
        <tr>
            <td colspan="5"> </td>
        </tr>
        <tr>
            <td colspan="4"> <strong style="float:right;"> Total : </strong> </td>
            <td>{{ $total_qty }}</td>
        </tr>
    </table>

    <div style="margin-top: 15px;  float: right;">
        <strong>Total : </strong>
        <strong>{{$purchase[0]->pur_total_amount}}</strong>
    </div>
    <div style="margin-top: 15px;">
        @if($purchase[0]->remarks != "")
        <textarea placeholder="Remarks" rows="20" id="comment_text" cols="40" class="ui-autocomplete-input"
            autocomplete="off" role="textbox" aria-autocomplete="list"
            aria-haspopup="true">{{$purchase[0]->remarks}}</textarea>
        @endif
    </div>
</div>
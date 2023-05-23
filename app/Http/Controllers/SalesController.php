<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Salesdetail;
use App\Models\Stocktransferhistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Sales';

        $acc_id = Session::get('acc_id');
        $data['wh_id'] = $request->query('wh_id');
        $data['start_date'] = $request->query('start_date');
        $data['end_date'] = $request->query('end_date');

        $data['sales'] = DB::table('sales')
            ->when($request->wh_id != null, function ($q) use ($request) {
                return $q->where('sales.wh_id', $request->wh_id);
            })
            ->when($request->start_date != null && $request->end_date != null, function ($q) use ($request) {
                return $q->whereBetween('sales.sales_date', [$request->start_date, $request->end_date]);
            })
            ->where("acc_id", "=", $acc_id)
            ->get();
            

        $data['filter'] = ($request->wh_id || $request->start_date) ? 1 : 0;
        return view('sale.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sale.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sales_date' => 'required',
            'wh_id' => 'required',
            'total_sales_amount' => 'required',
        ], [
            'sales_date.required' => 'Date is required',
            'wh_id.required' => 'Warehouse is required',
            'total_sales_amount.required' => 'Total Sales Amount is required',
        ]);

        DB::beginTransaction();
        try {
            $acc_id = Session::get('acc_id');
            $info = array(
                'sales_invoice_no' => sales_invoice_no(),
                'sales_date' => $request->input('sales_date'),
                'wh_id' => $request->input('wh_id'),
                'total_sales_amount' => $request->input('total_sales_amount'),
                'total_profit' => 0,
                'remarks' => $request->input('remarks'),
                'acc_id' => $acc_id
            );
            $sale = Sale::create($info);
            $lastInsertID = $sale->id;

            $wh_id = $request->input('wh_id');
            $sales_invoice_no =  $lastInsertID;
            $item_id  = $request->input('item_id');
            $sale_price  = $request->input('sale_price');
            $cost_per_unit  = $request->input('cost_per_unit');
            $sale_qty  = $request->input('sale_qty');
            $sub_total  = $request->input('sub_total');

            $counter = count($item_id);
            $data1 = array();
            $stocktransferhistorys_array = array();
            $total_profit = 0;
            for ($i = 0; $i < $counter; $i++) {

                //calculate the sale_item_profit and total_profit 
                $sale_item_profit = calculate_item_profit_onsale($item_id[$i], $cost_per_unit[$i], $sale_price[$i]);
                $total_profit += $sale_item_profit * $sale_qty[$i];

                // less the $sale_qty[$i]  of $item_id[$i] from wh_id  and update total cost
                $data = DB::table('stockdetails')
                    ->leftjoin('itemdetails', 'itemdetails.item_id', '=', 'stockdetails.item_id')
                    ->select('stockdetails.*', 'itemdetails.cost_per_unit')
                    ->where('stockdetails.item_id', '=', $item_id[$i])
                    ->Where('stockdetails.wh_id', '=', $wh_id)
                    ->first();
                $old_qty = $data->stock_qty;
                $inhand_qty     = $old_qty - $sale_qty[$i];
                DB::table('stockdetails')
                    ->where('wh_id', $wh_id)
                    ->where('item_id', $item_id[$i])
                    ->update(
                        array(
                            'stock_qty' => $inhand_qty,
                            'total_cost' => $inhand_qty * $cost_per_unit[$i],
                            'updated_at' => date('Y-m-d H:i:s')
                        )
                    );

                //make a transection history for warehouse in/out

                $stocktransferhistorys_array = array(
                    'stock_id' => 0,
                    'item_id' => $item_id[$i],
                    'wh_id_from' => $wh_id,
                    'wh_id_to' => "",
                    'stock_transfer_qty' => $sale_qty[$i],
                    'type' => 3,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                Stocktransferhistory::insert($stocktransferhistorys_array);

                //add in saledetails table
                $data1 = array(
                    'sales_invoice_no' => $sales_invoice_no,
                    'item_id' => $item_id[$i],
                    'sale_price' => $sale_price[$i],
                    'sale_qty' => $sale_qty[$i],
                    'sale_item_profit' => $sale_item_profit * $sale_qty[$i],
                    'sub_total' => $sub_total[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s')
                );
                Salesdetail::insert($data1);
            }

            Sale::where('sales_invoice_no', '=', $sales_invoice_no)->update([
                'total_profit' => $total_profit,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            $data = $e->getMessage();

            echo "<pre>";
            print_r($data);
            exit;
        }
        return redirect(route('sale.index'))->with('message', 'Sale has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['sales'] = DB::table('sales')
            ->leftjoin('salesdetails', 'salesdetails.sales_invoice_no', '=', 'sales.sales_invoice_no')
            ->leftjoin('itemdetails', 'itemdetails.item_id', '=', 'salesdetails.item_id')
            ->leftjoin('productitems', 'productitems.item_id', '=', 'itemdetails.item_id')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
            ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'productitems.p_id')
            ->leftjoin('product_serials', 'product_serials.p_id', '=', 'productitems.p_id')
            ->where('sales.sales_id', '=', $id)
            ->select('sales.*', 'salesdetails.*', 'itemdetails.*', 'products.*', 'productitems.*', 'variants.*', 'product_sizes.*', 'product_serials.*')
            ->get();

        // echo "<pre>";
        // print_r($data['sales']);
        // exit;
        return view('sale.sale_show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function print($id)
    {
        $data['sales'] = DB::table('sales')
            ->leftjoin('salesdetails', 'salesdetails.sales_invoice_no', '=', 'sales.sales_invoice_no')
            ->leftjoin('itemdetails', 'itemdetails.item_id', '=', 'salesdetails.item_id')
            ->leftjoin('productitems', 'productitems.item_id', '=', 'itemdetails.item_id')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
            // ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'productitems.p_id')
            // ->leftjoin('product_serials', 'product_serials.p_id', '=', 'productitems.p_id')
            ->where('sales.sales_id', '=', $id)
            ->select('sales.*', 'salesdetails.*', 'itemdetails.*', 'products.*', 'productitems.*', 'variants.*')
            ->get();

        $pdf = PDF::loadView('sale.print', $data);
        return $pdf->download('sale.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
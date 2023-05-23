<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Models\Stockdetail;
use App\Models\Itemdetail;
use App\Models\Stockchargesdetail;
use App\Models\Stocktransferhistory;
//use App\Models\Itemprice;
use PDF;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Stock Transfer Invoice';
        $acc_id = Session::get('acc_id');
        $data['stock'] = DB::table('stocks')
            ->leftjoin('stocktransferhistories', 'stocks.stock_id', '=', 'stocktransferhistories.stock_id')
            ->groupby('stocks.stock_id')
            ->where("stocks.acc_id", "=", $acc_id)
            ->select('stocks.*', 'stocktransferhistories.wh_id_to', 'stocktransferhistories.wh_id_from')
            ->get();
        return view('stock.index', $data);
    }
    public function stocktransfer_invoice($id)
    {
        $data['stock'] = DB::table('stocks')
            ->join('stocktransferhistories', 'stocks.stock_id', '=', 'stocktransferhistories.stock_id')
            ->join('itemdetails', 'itemdetails.item_id', '=', 'stocktransferhistories.item_id')
            ->leftjoin('productitems', 'productitems.item_id', '=', 'stocktransferhistories.item_id')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
            ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'productitems.p_id')
            ->leftjoin('product_serials', 'product_serials.p_id', '=', 'productitems.p_id')
            ->where('stocks.stock_id', '=', $id)
            ->select('stocks.*', 'stocktransferhistories.*', 'products.*', 'productitems.*', 'variants.*', 'product_sizes.*', 'product_serials.*', 'itemdetails.*')
            ->get();
        return view('stock.stock_transfer_view', $data);
    }

    public function all_stock_list(Request $request)
    {
        $data['p_id'] = $request->input('p_id');
        $data['wh_id'] = $request->input('wh_id');
        $data['item_id'] = $request->input('item_id');

        // $data['stock'] = DB::table('stocks')
        //     ->join('stockdetails', 'stocks.stock_id', '=', 'stockdetails.stock_id')
        //     ->when($request->wh_id != null, function ($q) use ($request) {
        //         return $q->where('stockdetails.wh_id', $request->wh_id);
        //     })
        //     ->join('itemdetails', 'itemdetails.item_id', '=', 'stockdetails.item_id')
        //     ->leftjoin('productitems', 'productitems.item_id', '=', 'stockdetails.item_id')
        //     ->when($request->item_id != null, function ($q) use ($request) {
        //         return $q->where('productitems.item_id', $request->item_id);
        //     })
        //     ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
        //     ->when($request->p_id != null, function ($q) use ($request) {
        //         return $q->where('products.p_id', $request->p_id);
        //     })
        //     ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
        //     ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'productitems.p_id')
        //     ->leftjoin('product_serials', 'product_serials.p_id', '=', 'productitems.p_id')
        //     ->select('stocks.*', 'stockdetails.*', 'products.*', 'productitems.*', 'variants.*', 'product_sizes.*', 'product_serials.*', 'itemdetails.*')
        //     ->get();



        // $data['stock'] = DB::table('stocks')
        // ->join('stockdetails', 'stocks.stock_id', '=', 'stockdetails.stock_id')
        // ->when($request->wh_id != null, function ($q) use ($request) {
        //     return $q->where('stockdetails.wh_id', $request->wh_id);
        // })
        // ->leftjoin('itemdetails', 'itemdetails.item_id', '=', 'stockdetails.item_id')
        // ->leftjoin('stockchargesdetails', 'stockchargesdetails.item_id', '=', 'stockdetails.item_id')
        // ->leftjoin('productitems', 'productitems.item_id', '=', 'stockdetails.item_id')
        // ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
        // ->when($request->p_id != null, function ($q) use ($request) {
        //     return $q->where('products.p_id', $request->p_id);
        // })
        // ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
        // ->when($request->item_id != null, function ($q) use ($request) {
        //     return $q->where('productitems.item_id', $request->item_id);
        // })
        // ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'productitems.p_id')
        // ->leftjoin('product_serials', 'product_serials.p_id', '=', 'productitems.p_id')
        // ->select('stocks.*', 'stockdetails.*', 'products.*', 'productitems.*', 'variants.*', 'product_sizes.*', 'product_serials.*', 'itemdetails.*' ,'stockchargesdetails.*')
        // ->get();

        $acc_id = Session::get('acc_id');
        $data['stock'] = DB::table('stockdetails as sd')
            ->when($request->wh_id != null, function ($q) use ($request) {
                return $q->where('sd.wh_id', $request->wh_id);
            })
            ->leftJoin('stocks as s', 's.stock_id', '=', 'sd.stock_id')
            ->leftJoin('itemdetails as id', 'id.item_id', '=', 'sd.item_id')
            ->leftJoin('productitems as pi', 'pi.item_id', '=', 'sd.item_id')
            ->when($request->item_id != null, function ($q) use ($request) {
                return $q->where('pi.item_id', $request->item_id);
            })
            ->leftJoin('products as p', 'p.p_id', '=', 'pi.p_id')
            ->when($request->p_id != null, function ($q) use ($request) {
                return $q->where('p.p_id', $request->p_id);
            })
            ->leftJoin('variants as v', 'v.var_id', '=', 'pi.var_id')
            ->leftJoin('product_sizes as ps', 'ps.p_id', '=', 'pi.p_id')
            ->leftJoin('product_serials as pser', 'pser.p_id', '=', 'pi.p_id')
            ->where("sd.acc_id", "=", $acc_id)
            ->select('sd.*', 's.*', 'id.*', 'pi.*', 'p.*', 'v.*', 'ps.*', 'pser.*')
            ->get();
        $data['filter'] = ($request->wh_id || $request->item_id || $request->p_id) ? 1 : 0;
        return view('stock.all_stock_list', $data);
    }

    public function stocktransfer_print($id)
    {
        $data['title'] = 'Show Stock';
        $data['stock'] = DB::table('stocks')
            ->join('stocktransferhistories', 'stocks.stock_id', '=', 'stocktransferhistories.stock_id')
            ->join('itemdetails', 'itemdetails.item_id', '=', 'stocktransferhistories.item_id')
            ->leftjoin('productitems', 'productitems.item_id', '=', 'stocktransferhistories.item_id')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
            ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'productitems.p_id')
            ->leftjoin('product_serials', 'product_serials.p_id', '=', 'productitems.p_id')
            ->where('stocks.stock_id', '=', $id)
            ->select('stocks.*', 'stocktransferhistories.*', 'products.*', 'productitems.*', 'variants.*', 'product_sizes.*', 'product_serials.*', 'itemdetails.*')
            ->get();
        $stock_refrence_no = $data['stock'][0]->stock_refrence_no;
        $pdf = PDF::loadView('stock.print', $data);
        return $pdf->download('Stock Transfer Invoice ' . $stock_refrence_no . ' .pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock.create');
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
            'stock_entry_date' => 'required',
            'wh_id' => 'required'
        ], [
            'stock_entry_date.required' => 'Date is required',
            'wh_id.required' => 'WareHouse is required',
        ]);

        DB::beginTransaction();
        try {

            //*******stocks Entry ********************/
            $acc_id = Session::get('acc_id');
            $info = array(
                'stock_refrence_no'  =>  stock_refrence_no(),
                'stock_entry_date'  => $request->input('stock_entry_date'),
                'acc_id'  => $acc_id,
            );
            $stock = Stock::create($info);
            $stock_id = $stock->id;

            //*******stockdetails Entry *****************/
            $stock_id =  $stock_id;
            $wh_id = $request->input('wh_id');
            $item_id = $request->input('item_id');
            $stock_qty = $request->input('stock_qty');

            //*******itemdetails Entry *****************/
            $cost_per_unit = $request->input('cost_per_unit');
            $item_pur_price = $request->input('item_pur_price');
            $item_sale_price = $request->input('item_sale_price');

            //*******stockchargesdetails Entry *****************/
            $cbm_charges = $request->input('cbm_charges');
            $cbm = $request->input('cbm');
            $shiping_uae = $request->input('shiping_uae');
            $amazon_fee = $request->input('amazon_fee');

            //*******stocktransferhistorys Entry *****************/
            $counter = count($item_id);
            $itemdetails_array = array();
            $stockchargesdetails_array = array();
            $stocktransferhistorys_array = array();
            for ($i = 0; $i < $counter; $i++) {

                //check the item in stockdetails if exists then update the qty and cost else insert into stockdetails
                $res = DB::table('stockdetails')
                    ->where('stockdetails.item_id', '=', $item_id[$i])
                    ->Where('stockdetails.wh_id', '=', $wh_id)
                    ->Where('stockdetails.acc_id', '=', $acc_id)
                    ->count();
                if ($res > 0) {
                    Stockdetail::where('item_id', $item_id[$i])
                        ->where('wh_id', $wh_id)
                        ->update([
                            'stock_qty' => DB::raw("stock_qty + {$stock_qty[$i]}"),
                            'total_cost' => DB::raw("total_cost + ({$stock_qty[$i]} * {$cost_per_unit[$i]})"),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                } else {
                    $stockdetails_array = array(
                        'stock_id' => $stock_id,
                        'wh_id' => $wh_id,
                        'item_id' => $item_id[$i],
                        'stock_qty' => $stock_qty[$i],
                        'total_cost' => $stock_qty[$i] * $cost_per_unit[$i],
                        'acc_id' => $acc_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    Stockdetail::insert($stockdetails_array);
                }

                //check the item in itemdetails if exists then update the cost ,pur ,sale price else insert into itemdetails
                $res1 = DB::table('itemdetails')
                    ->where('itemdetails.item_id', '=', $item_id[$i])
                    ->count();

                if ($res1 > 0) {
                    Itemdetail::where('item_id', $item_id[$i])
                        ->update([
                            'cost_per_unit' => $cost_per_unit[$i],
                            'item_pur_price' => $item_pur_price[$i],
                            'item_sale_price' => $item_sale_price[$i],
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                } else {
                    $itemdetails_array = array(
                        'item_id' => $item_id[$i],
                        'cost_per_unit' => $cost_per_unit[$i],
                        'item_pur_price' => $item_pur_price[$i],
                        'item_sale_price' => $item_sale_price[$i],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    Itemdetail::insert($itemdetails_array);
                }

                $stockchargesdetails_array[] =
                    array(
                        'stock_id' => $stock_id,
                        'item_id' => $item_id[$i],
                        'cbm_charges' => $cbm_charges,
                        'cbm' => $cbm[$i],
                        'shiping_uae' => $shiping_uae[$i],
                        'amazon_fee' => $amazon_fee[$i],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                $stocktransferhistorys_array[] =
                    array(
                        'stock_id' => $stock_id,
                        'item_id' => $item_id[$i],
                        'wh_id_from' => "",
                        'wh_id_to' => $wh_id,
                        'stock_transfer_qty' => $stock_qty[$i],
                        'type' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
            }
            Stockchargesdetail::insert($stockchargesdetails_array);
            Stocktransferhistory::insert($stocktransferhistorys_array);

            DB::commit();
        } catch (\Exception $e) {
            $data = $e->getMessage();
        }
        return redirect(route('stock.index'))->with('message', "Stock has been Added Successfull ");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function transferstock()
    {
        return view('stock.transfer_stock');
    }

    public function transfer_stock(Request $request)
    {
        $validatedData = $request->validate([
            'stock_entry_date' => 'required',
            'wh_id_from' => 'required',
            'wh_id_to' => 'required',
        ], [
            'stock_entry_date.required' => 'Date is required',
            'wh_id_from.required' => 'WareHouse From is required',
            'wh_id_to.required' => 'WareHouse To is required',
        ]);
        DB::beginTransaction();
        try {
            $acc_id = Session::get('acc_id');
            $info = array(
                'stock_refrence_no'  =>  stock_refrence_no(),
                'stock_entry_date'  => $request->input('stock_entry_date'),
                'acc_id'  => $acc_id,
            );
            $stock = Stock::create($info);

            $stock_id = $stock->id;
            $wh_id_from = $request->input('wh_id_from');
            $wh_id_to = $request->input('wh_id_to');
            $item_id = $request->input('item_id');
            $stock_qty = $request->input('stock_qty');

            $counter = count($item_id);
            $stocktransferhistorys_array = array();
            for ($i = 0; $i < $counter; $i++) {

                $data = DB::table('stockdetails')
                    ->where('stockdetails.item_id', '=', $item_id[$i])
                    ->Where('stockdetails.wh_id', '=', $wh_id_to)
                    ->Where('stockdetails.acc_id', '=', $acc_id)
                    ->count();
                if ($data > 0) {
                    $cost_per_unit = transfer_stock_from_warehousefrom_warehouseto($wh_id_from, $wh_id_to, $item_id[$i], $stock_qty[$i]);
                    Stockdetail::where('item_id', $item_id[$i])
                        ->where('wh_id', $wh_id_to)
                        ->where('acc_id', $acc_id)
                        ->update([
                            'stock_qty' => DB::raw("stock_qty + {$stock_qty[$i]}"),
                            'total_cost' => DB::raw("total_cost + ({$stock_qty[$i]} * {$cost_per_unit})"),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                } else {
                    $cost_per_unit = transfer_stock_from_warehousefrom_warehouseto($wh_id_from, $wh_id_to, $item_id[$i], $stock_qty[$i]);
                    $data2 = array(
                        'stock_id' => $stock_id,
                        'wh_id' => $wh_id_to,
                        'item_id' => $item_id[$i],
                        'stock_qty' => $stock_qty[$i],
                        'total_cost' => $stock_qty[$i] * $cost_per_unit,
                        'acc_id' => $acc_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    Stockdetail::insert($data2);
                }
                $stocktransferhistorys_array[] =
                    array(
                        'stock_id' => $stock_id,
                        'item_id' => $item_id[$i],
                        'wh_id_from' => $wh_id_from,
                        'wh_id_to' => $wh_id_to,
                        'stock_transfer_qty' => $stock_qty[$i],
                        'type' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
            }
            Stocktransferhistory::insert($stocktransferhistorys_array);
            DB::commit();
        } catch (\Exception $e) {
            $data3 = $e->getMessage();
        }

        return redirect(route('stock.index'))->with('message', "Stock has been Added Successfull ");
    }
}

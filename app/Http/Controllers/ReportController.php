<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
// use App\Models\Stock;
// use App\Models\Stockdetail;
// use App\Models\Itemdetail;
// use App\Models\Stockchargesdetail;
// use App\Models\Stocktransferhistory;
//use App\Models\Itemprice;
// use PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function stock_transfer_history(Request $request)
    {
        if ($request->wh_id != null) {
            $acc_id = Session::get('acc_id');
            $data['stock_history'] = DB::table('stocktransferhistories')
                ->leftjoin('productitems', 'productitems.item_id', '=', 'stocktransferhistories.item_id')
                ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
                ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
                ->where("products.acc_id", "=", $acc_id)
                ->select('stocktransferhistories.*', 'productitems.*', 'products.p_name', 'variants.*');


            if ($request->wh_id != null) {
                $data['stock_history']->where(function ($q) use ($request) {
                    $q->where('stocktransferhistories.wh_id_from', $request->wh_id)
                        ->orWhere('stocktransferhistories.wh_id_to', $request->wh_id);
                });
            }
            $data['stock_history'] = $data['stock_history']->get();
        } else {
            $data['stock_history'] = array();
        }
        $data['filter'] = ($request->wh_id) ? 1 : 0;
        return view('report.stock_transfer_history', $data);
    }

    public function stock_price_detail(Request $request)
    {
        $acc_id = Session::get('acc_id');
        $data['stock_price_detail'] = DB::table('stockdetails as sd')
            ->leftjoin('productitems', 'productitems.item_id', '=', 'sd.item_id')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
            ->where("products.acc_id", "=", $acc_id)
            ->select(
                'sd.item_id',
                'sd.wh_id',
                DB::raw('sum(total_cost) as total_cost'),
                DB::raw('sum(id.cost_per_unit * sd.stock_qty) as total_investment'),
                DB::raw('sum(id.item_pur_price * sd.stock_qty) as total_purchase_price'),
                DB::raw('sum(id.item_sale_price * sd.stock_qty) as total_sale_price'),
                'sd.*',
                'productitems.*',
                'products.p_name',
                'variants.*'
            )
            ->join('itemdetails as id', 'id.item_id', '=', 'sd.item_id')
            ->groupBy('sd.item_id', 'sd.wh_id')
            ->when($request->wh_id != null, function ($q) use ($request) {
                return $q->where('sd.wh_id', $request->wh_id);
            })
            ->get();

        $data['filter'] = ($request->wh_id) ? 1 : 0;
        return view('report.stock_price_detail', $data);
    }

    public function item_metrics_report()
    {
        $acc_id = Session::get('acc_id');
        $data['item_stats_inwarehosue'] = DB::table('stockdetails as sd')
            ->select('sd.wh_id', 'sd.item_id', 'p.p_name', 'w.wh_title', 'pi.item_serial_no', 'pi.item_img', 'v.*')
            ->selectRaw('SUM(id.item_pur_price * sd.stock_qty) as total_purchase_price')
            ->selectRaw('SUM(id.cost_per_unit * sd.stock_qty) as total_investment')
            ->selectRaw('SUM(id.item_sale_price * sd.stock_qty) as total_sale_price')
            ->join('itemdetails as id', 'id.item_id', '=', 'sd.item_id')
            ->leftJoin('productitems as pi', 'pi.item_id', '=', 'id.item_id')
            ->leftJoin('variants as v', 'v.var_id', '=', 'pi.var_id')
            ->join('products as p', 'p.p_id', '=', 'pi.p_id')
            ->join('warehouses as w', 'w.wh_id', '=', 'sd.wh_id')
            ->where("sd.acc_id", "=", $acc_id)
            ->groupBy('sd.wh_id', 'sd.item_id')
            ->orderBy('sd.item_id')
            ->get();
        return view('report.item_metrics', $data);
    }

    public function low_stock_items()
    {
        $acc_id = Session::get('acc_id');
        $data['low_stock'] = DB::table('products as p')
            ->select(
                'pi.item_id',
                'pi.item_serial_no',
                'p.p_name',
                'p.p_alert_qty',
                'pi.item_serial_no',
                'pi.item_img',
                'v.*',
                DB::raw('SUM(sd.stock_qty) as available_stock')
            )
            ->join('productitems as pi', 'p.p_id', '=', 'pi.p_id')
            ->leftJoin('variants as v', 'v.var_id', '=', 'pi.var_id')
            ->join('stockdetails as sd', 'sd.item_id', '=', 'pi.item_id')
            ->where('p.acc_id', '=', $acc_id)
            ->groupBy('pi.item_id')
            ->havingRaw('SUM(sd.stock_qty) < p.p_alert_qty')
            ->get();

        return view('report.low_stock_items', $data);
    }

    public function outof_stock_items()
    {
        $acc_id = Session::get('acc_id');
        $data['outof_stock_items'] = DB::table('products as p')
            ->select(
                'pi.item_id',
                'pi.item_serial_no',
                'p.p_name',
                'p.p_alert_qty',
                'pi.item_serial_no',
                'pi.item_img',
                'v.*',
                DB::raw('SUM(sd.stock_qty) as available_stock')
            )
            ->join('productitems as pi', 'p.p_id', '=', 'pi.p_id')
            ->leftJoin('variants as v', 'v.var_id', '=', 'pi.var_id')
            ->join('stockdetails as sd', 'sd.item_id', '=', 'pi.item_id')
            ->where('p.acc_id', '=', $acc_id)
            ->groupBy('pi.item_id')
            ->havingRaw('SUM(sd.stock_qty) = 0')
            ->get();

        //       echo "<pre>";
        // print_r($data['outof_stock_items'] );
        // exit;

        return view('report.outof_stock_items', $data);
    }

    public function expected_report(Request $request)
    {

        
        // $acc_id = Session::get('acc_id');
        // $data['expected_data'] = DB::table('stockdetails as sd')
        //     ->leftjoin('productitems', 'productitems.item_id', '=', 'sd.item_id')
        //     ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
        //     ->where("products.acc_id", "=", $acc_id)
        //     ->select(
        //         'sd.item_id',
        //         DB::raw('sum(id.item_pur_price * sd.stock_qty) as total_purchase_price'),
        //         DB::raw('sum(id.cost_per_unit * sd.stock_qty) as total_investment'),
        //         DB::raw('sum(id.item_sale_price * sd.stock_qty) as total_sale_price'),
        //         'sd.*',
        //         'productitems.item_id',
        //         'products.p_name',
        //     )
        //     ->join('itemdetails as id', 'id.item_id', '=', 'sd.item_id')
        //     ->groupBy('sd.item_id')
           
        //     ->get();

        //     echo "<pre>";
        //     print_r($data['expected_data']);

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
            
            ->where("sd.acc_id", "=", $acc_id)
           
            ->select('sd.*', 's.*', 'id.*', 'pi.item_serial_no', 'pi.item_id', 'pi.item_img', 'p.p_name', 'v.*')
            ->get();
        $data['filter'] = ($request->wh_id || $request->item_id || $request->p_id) ? 1 : 0;

        // echo "<pre>";
        // print_r($data['stock']);
        // exit;

        return view('report.expected_report', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
